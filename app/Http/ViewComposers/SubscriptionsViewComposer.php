<?php

namespace App\Http\ViewComposers;

use App\Settings\SubscriptionSettings;
use Illuminate\View\View;

class SubscriptionsViewComposer
{
    public function __construct(
        public SubscriptionSettings $subscriptionSettings,
    ) {}

    public function compose(View $view)
    {
        $view->with([
            'subscriptionSettings' => $this->subscriptionSettings,
        ]);
    }
}
