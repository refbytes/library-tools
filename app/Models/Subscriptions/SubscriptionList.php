<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Wildside\Userstamps\Userstamps;

class SubscriptionList extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'list_subscription');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
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
                ]),
            Section::make()
                ->schema([
                    CheckboxList::make('subscriptions')
                        ->label('Subscriptions')
                        ->relationship('subscriptions', 'name')
                        ->columns(2),
                ]),
        ];
    }
}
