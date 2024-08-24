<div class="subscriptions">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1">
                <x-subscriptions.facets.checkboxes :facet="'formats'" :facets="$facetDistribution" />
                <x-subscriptions.facets.checkboxes :facet="'subjects'" :facets="$facetDistribution" />
                <x-subscriptions.facets.checkboxes :facet="'vendor'" :facets="$facetDistribution" />
            </div>
            <div class="col-span-3">
                <x-subscriptions.search />
                <x-subscriptions.facets.alphabet :facet="'alpha'" :facets="$facetDistribution" />
                <x-subscriptions.list :subscriptions="$subscriptions" lazy />
            </div>
        </div>
    </div>
</div>
