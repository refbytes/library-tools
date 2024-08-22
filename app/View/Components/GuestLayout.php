<?php

namespace App\View\Components;

use App\Settings\SiteSettings;
use App\Settings\ThemeSettings;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    public SiteSettings $site;

    public ThemeSettings $theme;

    public function __construct(SiteSettings $site, ThemeSettings $theme)
    {
        $this->site = $site;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
