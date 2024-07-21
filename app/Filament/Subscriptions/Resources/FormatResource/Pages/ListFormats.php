<?php

namespace App\Filament\Subscriptions\Resources\FormatResource\Pages;

use App\Filament\Subscriptions\Resources\FormatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormats extends ListRecords
{
    protected static string $resource = FormatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
