<?php

namespace App\Livewire\Subscriptions;

use Illuminate\Support\Collection;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Meilisearch\Client;
use Meilisearch\Contracts\FacetSearchQuery;

#[Lazy]
class Alphabet extends Component
{
    public ?Collection $alphaFacet;

    public $facet;

    public $facets;

    #[Reactive]
    public $filters;

    public function mount($facet, $facets, $filters)
    {
        $this->facet = $facet;
        $this->facets = $facets;
        $this->filters = $filters;
        $client = new Client(
            config('scout.meilisearch.host'),
            config('scout.meilisearch.key')
        );
        $index = $client->index('subscription_index');
        $results = $index->facetSearch((new FacetSearchQuery())->setFacetName('alpha'));
        $this->alphaFacet = collect($results->getFacetHits());
    }

    public function render()
    {
        return view('livewire.subscriptions.alphabet');
    }
}
