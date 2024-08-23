<?php

namespace App\Filament\Subscriptions\Resources\SubscriptionResource\Pages;

use App\Filament\Exports\Subscriptions\SubscriptionExporter;
use App\Filament\Imports\Subscriptions\SubscriptionImporter;
use App\Filament\Subscriptions\Resources\SubscriptionResource;
use App\Models\Subscriptions\Subscription;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ActionGroup::make([
                Actions\ImportAction::make()
                    ->importer(SubscriptionImporter::class),
                Actions\ExportAction::make('Export')
                    ->exporter(SubscriptionExporter::class),
            ]),
        ];
    }

    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        if (filled($search = $this->getTableSearch())) {
            $query->whereIn('id', Subscription::search($search)->keys());
        }

        return $query;
    }
}
