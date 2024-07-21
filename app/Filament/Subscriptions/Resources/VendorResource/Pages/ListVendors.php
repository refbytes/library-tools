<?php

namespace App\Filament\Subscriptions\Resources\VendorResource\Pages;

use App\Filament\Subscriptions\Resources\VendorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
