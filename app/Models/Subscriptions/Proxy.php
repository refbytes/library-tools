<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proxy extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('prefix')
                        ->label('Prefix'),
                ]),
        ];
    }
}
