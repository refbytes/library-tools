<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $navigationParentItem = 'Users';

    protected static ?string $model = \Spatie\Permission\Models\Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Hidden::make('guard_name')
                            ->default('web'),

                        ...collect(['subscriptions'])
                            ->map(fn ($panel) => Section::make(str($panel)->title().' Permissions')
                                ->schema([
                                    CheckboxList::make('permissions')
                                        ->label('Permissions')
                                        ->hiddenLabel()
                                        ->relationship('permissions', 'name')
                                        ->options(
                                            \Spatie\Permission\Models\Permission::query()
                                                ->where('name', 'LIKE', "$panel:%")
                                                ->pluck('name', 'id')
                                                ->all()
                                        )
                                        ->columns(5),
                                ])
                            )
                            ->all(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
