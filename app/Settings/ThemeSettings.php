<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ThemeSettings extends Settings
{
    public ?string $css;

    public ?string $header;

    public ?string $footer;

    public ?string $js;

    public ?string $primary_color;

    public ?string $secondary_color;

    public ?string $primary_button_color;

    public ?string $primary_inverse_button_color;

    public ?string $secondary_button_color;

    public ?string $secondary_inverse_button_color;

    public ?string $primary_link_color;

    public ?string $secondary_link_color;

    public ?string $page_background_color;

    public ?string $box_background_color;

    public ?string $border_color;

    public static function group(): string
    {
        return 'theme';
    }
}
