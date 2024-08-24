<div>
    <ul>
        @foreach($subscriptions as $subscription)
            <x-subscriptions.templates.resource.default :subscription="$subscription" />
        @endforeach
    </ul>
</div>
