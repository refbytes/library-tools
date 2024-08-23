<div>
    @foreach($subscriptions as $subscription)
        <div class="overflow-hidden mb-4 bg-white shadow sm:rounded-lg">
            <div class="py-5 px-4 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ $subscription->name }}
                </h3>
            </div>
        </div>
    @endforeach
</div>
