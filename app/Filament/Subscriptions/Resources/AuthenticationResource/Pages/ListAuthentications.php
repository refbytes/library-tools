<?php

namespace App\Filament\Subscriptions\Resources\AuthenticationResource\Pages;

use App\Filament\Subscriptions\Resources\AuthenticationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuthentications extends ListRecords
{
    protected static string $resource = AuthenticationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
