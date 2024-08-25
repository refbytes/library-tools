<div>
    <ul>
        @foreach($subscriptions as $subscription)
            @switch($subscriptionSettings->resource_layout)
                @case('custom')
                    <x-subscriptions.custom-resource-summary :subscription="$subscription" :subscription-settings="$subscriptionSettings"/>
                    @break
                @default
                    <x-subscriptions.templates.resource.default :subscription="$subscription" />
            @endswitch
        @endforeach
    </ul>
</div>
