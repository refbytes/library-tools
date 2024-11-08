<div class="subscriptions corner-style-{{ $subscriptionSettings->corners }}">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1 order-[var(--filterOrder)]">
                <x-subscriptions.facets.checkboxes :facet="'formats'" :facets="$facetDistribution" :icons="$icons"/>
                <x-subscriptions.facets.checkboxes :facet="'subjects'" :facets="$facetDistribution" />
                <x-subscriptions.facets.checkboxes :facet="'vendor'" :facets="$facetDistribution" />
            </div>
            <div class="col-span-3 order-[var(--listOrder)]">
                <x-subscriptions.search />
                <livewire:subscriptions.alphabet :facet="'vendor'" :facets="$facetDistribution" :filters="$filters" />
                <x-subscriptions.list :subscriptions="$subscriptions" :icons="$icons"/>
                <div>
                    @if(! is_array($subscriptions))
                        {{ $subscriptions->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('theme')
        --filterOrder: {{ $subscriptionSettings->filter_order === 1 ? '1' : '2' }};
        --listOrder: {{ $subscriptionSettings->filter_order === 1 ? '2' : '1' }};
    @endpush
</div>
