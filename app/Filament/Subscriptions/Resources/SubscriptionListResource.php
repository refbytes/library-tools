<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\SubscriptionListResource\Pages;
use App\Models\Subscriptions\SubscriptionList;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionListResource extends Resource
{
    protected static ?string $model = SubscriptionList::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...SubscriptionList::form(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label('Filters');
            })
            ->persistSearchInSession()
            ->persistColumnSearchesInSession()
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
            'index' => Pages\ListSubscriptionLists::route('/'),
            'create' => Pages\CreateSubscriptionList::route('/create'),
            'edit' => Pages\EditSubscriptionList::route('/{record}/edit'),
        ];
    }
}
