<?php

namespace App\Models\Subscriptions;

use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Wildside\Userstamps\Userstamps;

class Subscription extends Model implements Auditable, HasMedia
{
    use HasChildren;
    use HasFactory;
    use HasSlug;
    use HasTags;
    use InteractsWithMedia;
    use \OwenIt\Auditing\Auditable;
    use Searchable;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    protected $childTypes = [
        'database' => Database::class,
        'software' => Software::class,
    ];

    public function proxy(): BelongsTo
    {
        return $this->belongsTo(Proxy::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class);
    }

    public function authentications()
    {
        return $this->morphMany(Authentication::class, 'authenticatable');
    }

    public function lists()
    {
        return $this->belongsToMany(SubscriptionList::class, 'list_subscription');
    }

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return match ($this->proxy?->is_enabled) {
                    true, 1 => $this->proxy?->prefix.$attributes['url'],
                    false, 0 => $attributes['url'],
                    null => $attributes['url'],
                };
            },
        );
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return empty($this->custom_slug)
            ? SlugOptions::create()
                ->generateSlugsFrom('name')
                ->saveSlugsTo('slug')
            : SlugOptions::create()
                ->generateSlugsFrom('custom_slug')
                ->saveSlugsTo('slug');
    }

    public function searchableAs(): string
    {
        return 'subscription_index';
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->load([
            'formats',
            'proxy',
            'subjects',
            'tags',
            'vendor',
        ]);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'type' => $this->type,
            'is_public' => $this->is_public,
            'is_featured' => $this->is_featured,
            'name' => $this->name,
            'alpha' => str($this->name)->take(1),
            'alternate_names' => $this->alternate_names,
            'vendor' => $this->vendor?->name,
            'description' => $this->description,
            'url' => $this->full_url,
            'keywords' => $this->tags->pluck('name')->toArray(),
            'subjects' => $this->subjects()->pluck('name')->toArray(),
            'formats' => $this->formats()->pluck('name')->toArray(),
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,
        ];
    }

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('alternate_names')
                        ->label('Alternate Names')
                        ->maxLength(255),
                    TextInput::make('custom_slug')
                        ->label('Custom URL Path')
                        ->placeholder(fn ($record) => ! empty($record->slug) ? $record->slug : 'Leave blank to auto-generate')
                        ->prefix(url('/resources').'/')
                        ->maxLength(255),
                    Select::make('vendor_id')
                        ->label('Vendor')
                        ->relationship('vendor', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm(Vendor::form())
                        ->createOptionUsing(function (array $data): int {
                            return Vendor::create($data)->getKey();
                        })
                        ->required(),
                    Select::make('provider_id')
                        ->label('Provider(s)')
                        ->relationship('providers', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->createOptionForm(Provider::form())
                        ->createOptionUsing(function (array $data): int {
                            return Provider::create($data)->getKey();
                        }),
                    Select::make('proxy_id')
                        ->label('Proxy')
                        ->relationship('proxy', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm(Proxy::form())
                        ->createOptionUsing(function (array $data): int {
                            return Proxy::create($data)->getKey();
                        }),
                    TextInput::make('url')
                        ->label('URL')
                        ->required()
                        ->maxLength(2048),
                    Tabs::make()
                        ->tabs([
                            Tabs\Tab::make('Description')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Description')
                                        ->required()
                                        ->maxLength(65535),
                                ]),
                            Tabs\Tab::make('Authenticated Description')
                                ->schema([
                                    RichEditor::make('authenticated_description')
                                        ->label('Authenticated Description')
                                        ->maxLength(65535),
                                ]),
                            Tabs\Tab::make('Internal Notes')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Internal Notes')
                                        ->maxLength(65535),
                                ]),
                        ]),
                    SelectTree::make('subjects')
                        ->enableBranchNode()
                        ->withCount()
                        ->searchable()
                        ->relationship('subjects', 'name', 'parent_id'),
                    SpatieMediaLibraryFileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->collection('thumbnail')
                        ->image()
                        ->maxSize(2048),
                    Select::make('formats')
                        ->label('Formats')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->createOptionForm(Format::form())
                        ->createOptionUsing(function (array $data): int {
                            return Format::create($data)->getKey();
                        })
                        ->relationship('formats', 'name'),
                    SpatieTagsInput::make('tags')
                        ->type('keywords'),
                    Fieldset::make()
                        ->columns(4)
                        ->schema([
                            Toggle::make('is_public')
                                ->label('Enabled'),
                            Toggle::make('is_featured')
                                ->label('Featured'),
                            DatePicker::make('new_until')
                                ->label('New Until')
                                ->inlineLabel(),
                            DatePicker::make('trial_until')
                                ->label('Trial Until')
                                ->inlineLabel(),
                        ]),
                ]),
        ];
    }
}
