<?php

namespace App\Filament\Subscriptions\Resources\ListResource\Pages;

use App\Filament\Subscriptions\Resources\SubscriptionListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscriptionLists extends ListRecords
{
    protected static string $resource = SubscriptionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
