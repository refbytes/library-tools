<div>
    <ul>
        @foreach($subscriptions as $subscription)
            @switch($subscriptionSettings->resource_layout)
                @case('custom')
                    <x-subscriptions.custom-resource-summary :subscription="$subscription"
                                                             :subscription-settings="$subscriptionSettings"
                                                             :icons="$icons"
                    />
                    @break
                @default
                    <x-subscriptions.templates.resource.default :subscription="$subscription"
                                                                wire:key="subscription-{{  $subscription->id }}"/>
            @endswitch
        @endforeach
    </ul>
</div>
