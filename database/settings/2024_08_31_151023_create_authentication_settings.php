<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('authentication.sso_provider', null);
        $this->migrator->addEncrypted('authentication.options', null);
    }
};
