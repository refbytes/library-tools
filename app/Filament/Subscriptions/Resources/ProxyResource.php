<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\ProxyResource\Pages;
use App\Models\Subscriptions\Proxy;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class ProxyResource extends Resource
{
    protected static ?string $model = Proxy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...Proxy::form(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_enabled')
                    ->label('Enabled'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),
                Tables\Columns\TextColumn::make('prefix')
                    ->label('Prefix'),
                Tables\Columns\TextColumn::make('subscriptions_count')
                    ->label('Usages')
                    ->counts('subscriptions')
                    ->formatStateUsing(function ($state) {
                        return Number::format($state);
                    }),
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
            'index' => Pages\ListProxies::route('/'),
            'create' => Pages\CreateProxy::route('/create'),
            'edit' => Pages\EditProxy::route('/{record}/edit'),
        ];
    }
}
