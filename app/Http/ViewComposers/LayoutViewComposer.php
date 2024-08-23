<?php

namespace App\Http\ViewComposers;

use App\Settings\SiteSettings;
use App\Settings\ThemeSettings;
use Illuminate\View\View;

class LayoutViewComposer
{
    public function __construct(
        public SiteSettings $site,
        public ThemeSettings $theme,
    ) {}

    public function compose(View $view)
    {
        $view->with([
            'site' => $this->site,
            'theme' => $this->theme,
        ]);
    }
}
