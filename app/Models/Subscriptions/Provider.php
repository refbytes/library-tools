<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Provider extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                ]),
        ];
    }
}
