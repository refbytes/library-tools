<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function authentications()
    {
        return $this->morphMany(Authentication::class, 'authenticatable');
    }

    public static function form()
    {
        return [
            TextInput::make('name')
                ->label('Name')
                ->unique(ignoreRecord: true)
                ->required(),
        ];
    }
}
