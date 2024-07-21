<?php

namespace App\Filament\Subscriptions\Resources\ListResource\Pages;

use App\Filament\Subscriptions\Resources\SubscriptionListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscriptionList extends EditRecord
{
    protected static string $resource = SubscriptionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
