<?php

namespace App\Filament\Subscriptions\Resources;

use App\Enums\SubscriptionType;
use App\Filament\Subscriptions\Resources\SubscriptionResource\Pages;
use App\Filament\Subscriptions\Resources\SubscriptionResource\RelationManagers\AuthenticationsRelationManager;
use App\Models\Subscriptions\Subscription;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...Subscription::form(),
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
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->date()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Types')
                    ->multiple()
                    ->preload()
                    ->options(SubscriptionType::class),
                Tables\Filters\SelectFilter::make('vendor')
                    ->label('Vendors')
                    ->multiple()
                    ->preload()
                    ->relationship('vendor', 'name'),
                Tables\Filters\SelectFilter::make('provider')
                    ->label('Providers')
                    ->multiple()
                    ->preload()
                    ->relationship('providers', 'name'),
                Tables\Filters\SelectFilter::make('formats')
                    ->label('Formats')
                    ->multiple()
                    ->preload()
                    ->relationship('formats', 'name'),
                Tables\Filters\SelectFilter::make('subjects')
                    ->label('Subjects')
                    ->multiple()
                    ->preload()
                    ->relationship('subjects', 'name'),
                TernaryFilter::make('public')
                    ->label('Public')
                    ->attribute('is_public')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_public', true),
                        false: fn (Builder $query) => $query->where('is_public', false),
                        blank: fn (Builder $query) => $query,
                    ),
                TernaryFilter::make('featured')
                    ->label('Featured')
                    ->attribute('is_featured')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_featured', true),
                        false: fn (Builder $query) => $query->where('is_featured', false),
                        blank: fn (Builder $query) => $query,
                    ),
                QueryBuilder::make()
                    ->constraints([
                        QueryBuilder\Constraints\TextConstraint::make('name'),
                        QueryBuilder\Constraints\TextConstraint::make('alternate_names'),
                        QueryBuilder\Constraints\TextConstraint::make('description'),
                        QueryBuilder\Constraints\TextConstraint::make('authenticated_description'),
                        QueryBuilder\Constraints\TextConstraint::make('internal_notes'),
                        QueryBuilder\Constraints\TextConstraint::make('url'),
                        BooleanConstraint::make('is_public')
                            ->label('Public'),
                        BooleanConstraint::make('is_featured')
                            ->label('Featured'),
                    ]),
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
            AuthenticationsRelationManager::class,
            AuditsRelationManager::class,
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
