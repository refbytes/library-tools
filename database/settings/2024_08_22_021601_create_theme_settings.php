<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('theme.css', '');
        $this->migrator->add('theme.header', '');
        $this->migrator->add('theme.footer', '');
        $this->migrator->add('theme.js', '');
        $this->migrator->add('theme.primary_color', '');
        $this->migrator->add('theme.secondary_color', '');
        $this->migrator->add('theme.primary_button_color', '');
        $this->migrator->add('theme.primary_inverse_button_color', '');
        $this->migrator->add('theme.secondary_button_color', '');
        $this->migrator->add('theme.secondary_inverse_button_color', '');
        $this->migrator->add('theme.primary_link_color', '');
        $this->migrator->add('theme.secondary_link_color', '');
        $this->migrator->add('theme.page_background_color', '');
        $this->migrator->add('theme.box_background_color', '');
        $this->migrator->add('theme.border_color', '');
    }
};
