<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\ContactResource\Pages;
use App\Models\Subscriptions\Contact;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $navigationParentItem = 'Vendors';

    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-up-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...Contact::form(),
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
            ->groups([
                'vendor.name',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor.name')
                    ->label('Vendor')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendor', 'name'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
