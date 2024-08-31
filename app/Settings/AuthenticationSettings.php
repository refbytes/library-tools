<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AuthenticationSettings extends Settings
{
    public ?string $sso_provider = null;

    public ?array $options = null;

    public static function group(): string
    {
        return 'authentication';
    }

    public static function encrypted(): array
    {
        return [
            'options',
        ];
    }
}
