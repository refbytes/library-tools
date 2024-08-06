<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\AuthenticationResource\Pages;
use App\Models\Subscriptions\Authentication;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AuthenticationResource extends Resource
{
    protected static ?string $model = Authentication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...Authentication::form(),
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
            'index' => Pages\ListAuthentications::route('/'),
            'create' => Pages\CreateAuthentication::route('/create'),
            'edit' => Pages\EditAuthentication::route('/{record}/edit'),
        ];
    }
}
