<?php

namespace App\Filament\Subscriptions\Resources;

use App\Filament\Subscriptions\Resources\SubscriptionResource\Pages;
use App\Models\Subscriptions\Subscription;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required(),
                        TextInput::make('alternate_names')
                            ->label('Alternate Names'),
                        Select::make('vendor_id')
                            ->label('Vendor')
                            ->relationship('vendor', 'name')
                            ->required(),
                        Select::make('proxy_id')
                            ->label('Proxy')
                            ->relationship('proxy', 'name'),
                        TextInput::make('url')
                            ->label('URL')
                            ->required(),
                        Tabs::make()
                            ->tabs([
                                Tabs\Tab::make('Description')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->label('Description')
                                            ->required(),
                                    ]),
                                Tabs\Tab::make('Authenticated Description')
                                    ->schema([
                                        RichEditor::make('authenticated_description')
                                            ->label('Authenticated Description'),
                                    ]),
                                Tabs\Tab::make('Internal Notes')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->label('Internal Notes'),
                                    ]),
                            ]),
                        SpatieMediaLibraryFileUpload::make('thumbnail'),
                        Select::make('formats')
                            ->label('Formats')
                            ->multiple()
                            ->preload()
                            ->relationship('formats', 'name'),
                        SpatieTagsInput::make('tags')
                            ->type('keywords'),
                        Fieldset::make()
                            ->columns(4)
                            ->schema([
                                Toggle::make('is_public')
                                    ->label('Enabled'),
                                Toggle::make('is_featured')
                                    ->label('Featured'),
                                DatePicker::make('new_until')
                                    ->label('New Until')
                                    ->inlineLabel(),
                                DatePicker::make('trial_until')
                                    ->label('Trial Until')
                                    ->inlineLabel(),
                            ]),
                    ]),
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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('vendor')
                    ->label('Vendor')
                    ->relationship('vendor', 'name'),
                Tables\Filters\SelectFilter::make('formats')
                    ->label('Format')
                    ->multiple()
                    ->relationship('formats', 'name'),
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
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
