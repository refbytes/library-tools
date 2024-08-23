<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public ?string $name;

    public ?string $meta;

    public static function group(): string
    {
        return 'site';
    }
}
