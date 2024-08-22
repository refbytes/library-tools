<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('theme.meta', '');
        $this->migrator->add('theme.css', '');
        $this->migrator->add('theme.header', '');
        $this->migrator->add('theme.footer', '');
        $this->migrator->add('theme.js', '');
    }
};
