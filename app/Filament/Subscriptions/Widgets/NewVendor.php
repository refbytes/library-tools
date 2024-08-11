<?php

namespace App\Filament\Subscriptions\Widgets;

use Filament\Widgets\Widget;

class NewVendor extends Widget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    /**
     * @var view-string
     */
    protected static string $view = 'components.filament.widgets.new-vendor';
}
