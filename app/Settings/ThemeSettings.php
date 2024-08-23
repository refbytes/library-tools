<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{
    public ?string $css;

    public ?string $header;

    public ?string $footer;

    public ?string $js;

    public static function group(): string
    {
        return 'theme';
    }
}
