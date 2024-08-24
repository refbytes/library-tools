<?php

namespace App\Livewire;

use App\Models\Subscriptions\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class Subscriptions extends Component
{
    public ?Collection $subscriptions;

    public ?string $q = '';

    public ?array $filters = [
        'vendor' => [],
        'formats' => [],
    ];

    public ?array $facetDistribution = [];

    public ?int $totalhits = 0;

    public function render()
    {
        $this->search();

        return view('livewire.subscriptions');
    }

    public function search()
    {
        $this->subscriptions = Subscription::search($this->q, function ($meilisearch, string $q, array $options) {
            $options['facets'] = [
                'vendor',
                'formats',
            ];
            $options['filter'] = $this->buildFilterQuery();

            // https://github.com/meilisearch/meilisearch-php/blob/main/src/Search/SearchResult.php
            $response = $meilisearch->search($q, $options);
            $this->facetDistribution = $response->getFacetDistribution();
            $this->totalHits = $response->getEstimatedTotalHits();

            return $response;
        })
            ->query(fn (Builder $query) => $query->with([
                'vendor',
                'formats',
            ]))
            ->get();
    }

    private function buildFilterQuery()
    {
        $options = '';

        foreach ($this->filters as $key => $values) {
            if (empty($values)) {
                continue;
            }
            //dd($this->filters);
            //dd($values);
            $options .= $key.' = "'.$values[0].'"';

            //dd($options);
        }

        return $options;
    }
}
