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
use Laravel\Scout\Searchable;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Wildside\Userstamps\Userstamps;

class Subscription extends Model implements HasMedia
{
    use HasChildren;
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;
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

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return match ($this?->proxy->enabled) {
                    true => $this->proxy->prefix.$attributes['url'],
                    false => $attributes['url'],
                    null => $attributes['url'],
                };
            },
        );
    }

    public function searchableAs(): string
    {
        return 'subscription_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'vendor' => $this->vendor?->name,
            'description' => $this->description,
            'url' => $this->full_url,
            'keywords' => $this->tags->pluck('name')->toArray(),
            'created_at' => $this->created_at->timestamp,
        ];
    }

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('alternate_names')
                        ->label('Alternate Names'),
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
                        ->required(),
                    Tabs::make()
                        ->tabs([
                            Tabs\Tab::make('Description')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Description')
                                        ->required(),
                                ]),
                            Tabs\Tab::make('Authenticated Description')
                                ->schema([
                                    RichEditor::make('authenticated_description')
                                        ->label('Authenticated Description'),
                                ]),
                            Tabs\Tab::make('Internal Notes')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Internal Notes'),
                                ]),
                        ]),
                    SelectTree::make('subjects')
                        ->enableBranchNode()
                        ->withCount()
                        ->searchable()
                        ->relationship('subjects', 'name', 'parent_id'),
                    SpatieMediaLibraryFileUpload::make('thumbnail'),
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
