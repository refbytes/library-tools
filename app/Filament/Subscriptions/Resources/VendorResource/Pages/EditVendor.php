<?php

namespace App\Filament\Subscriptions\Resources\VendorResource\Pages;

use App\Filament\Subscriptions\Resources\VendorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
