<?php

namespace App\Models\Subscriptions;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    use Userstamps;

    protected $guarded = ['id'];

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Subject::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'parent_id');
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
                    Select::make('parent_id')
                        ->label('Parent')
                        ->relationship('parent', 'name', ignoreRecord: true),
                ]),
        ];
    }
}
