<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class IntegrationSettings extends Settings
{
    public ?array $options = null;

    public static function group(): string
    {
        return 'integrations';
    }

    public static function encrypted(): array
    {
        return [
            'options',
        ];
    }
}
