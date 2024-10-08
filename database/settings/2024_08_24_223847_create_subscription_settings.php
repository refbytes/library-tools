<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('subscriptions.theme', 'default');
        $this->migrator->add('subscriptions.corners', 'square');
        $this->migrator->add('subscriptions.resource_layout', 'default');
        $this->migrator->add('subscriptions.custom_resource_layout', '');
        $this->migrator->add('subscriptions.filter_order', 1);
    }
};
