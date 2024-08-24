<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SubscriptionSettings extends Settings
{
    public ?string $theme;

    public ?string $resource_layout;

    public static function group(): string
    {
        return 'subscriptions';
    }
}
