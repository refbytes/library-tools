<?php

namespace App\Models\Subscriptions;

use App\Enums\ContactType;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public static function form()
    {
        return [
            Section::make()
                ->schema([
                    Select::make('vendor_id')
                        ->label('Vendor')
                        ->relationship('vendor', 'name')
                        ->required(),
                    Select::make('type')
                        ->label('Type')
                        ->options(ContactType::class)
                        ->required(),
                    TextInput::make('name')
                        ->label('Name'),
                    TextInput::make('email')
                        ->label('Email'),
                    TextInput::make('phone')
                        ->label('Phone'),
                    TextInput::make('url')
                        ->label('Url'),
                ]),
        ];
    }
}
