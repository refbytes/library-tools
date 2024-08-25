<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SubscriptionSettings extends Settings
{
    public ?string $theme;

    public ?string $corners;

    public ?string $resource_layout;

    public ?int $filter_order;

    public ?string $custom_resource_layout;

    public static function group(): string
    {
        return 'subscriptions';
    }
}
