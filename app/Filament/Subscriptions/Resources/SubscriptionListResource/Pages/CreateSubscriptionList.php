<?php

namespace App\Filament\Subscriptions\Resources\ListResource\Pages;

use App\Filament\Subscriptions\Resources\SubscriptionListResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscriptionList extends CreateRecord
{
    protected static string $resource = SubscriptionListResource::class;
}
