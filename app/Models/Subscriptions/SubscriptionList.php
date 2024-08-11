<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class SubscriptionList extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'list_subscription');
    }

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
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
