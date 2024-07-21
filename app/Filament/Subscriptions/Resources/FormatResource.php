<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\FormatResource\Pages;
use App\Models\Subscriptions\Format;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormatResource extends Resource
{
    protected static ?string $model = Format::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormats::route('/'),
            'create' => Pages\CreateFormat::route('/create'),
            'edit' => Pages\EditFormat::route('/{record}/edit'),
        ];
    }
}
