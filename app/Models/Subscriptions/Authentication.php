<?php

namespace App\Models\Subscriptions;

use App\Enums\AuthenticationType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authentication extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'username' => 'encrypted',
            'password' => 'encrypted',
        ];
    }

    public function authenticatable()
    {
        return $this->morphTo();
    }

    public static function form()
    {
        return [
            Select::make('type')
                ->label('Type')
                ->options(AuthenticationType::class)
                ->required(),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('url')
                ->columnSpan(2)
                ->maxLength(2048),
            TextInput::make('username')
                ->required()
                ->maxLength(255),
            TextInput::make('password')
                ->required()
                ->maxLength(255),
        ];
    }
}
