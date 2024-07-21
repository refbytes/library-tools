<?php

namespace App\Filament\Subscriptions\Resources\ProviderResource\Pages;

use App\Filament\Subscriptions\Resources\ProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProviders extends ListRecords
{
    protected static string $resource = ProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
