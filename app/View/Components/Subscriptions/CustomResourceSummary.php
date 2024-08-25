<?php

namespace App\View\Components\Subscriptions;

use App\Models\Subscriptions\Subscription;
use App\Settings\SubscriptionSettings;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class CustomResourceSummary extends Component
{
    public function __construct(
        public SubscriptionSettings $subscriptionSettings,
        public Subscription $subscription
    ) {}

    public function render(): string
    {

        return Blade::render($this->subscriptionSettings->custom_resource_layout, [
            'subscription' => $this->subscription,
        ]);
    }
}
