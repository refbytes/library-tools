<?php

namespace App\Livewire;

use App\Models\Subscriptions\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class Subscriptions extends Component
{
    public ?Collection $subscriptions;

    #[Url]
    public ?string $q = '';

    #[Url]
    public ?array $filters = [
        'vendor' => [],
        'formats' => [],
        'subjects' => [],
        'alpha' => null,
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
                'subjects',
                'alpha',
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
                'subjects',
                'proxy',
                'media',
            ]))
            ->get();
    }

    private function buildFilterQuery()
    {
        $query = collect($this->filters)
            ->filter(fn ($facet) => ! empty($facet))
            ->map(fn ($values) => ! is_array($values) ? [$values] : $values)
            ->map(fn ($values, $key) => '('.collect($values)->map(fn ($value) => $key.' = "'.trim($value).'"')->implode(' OR ').')')
            ->implode(' AND ');

        return $query;
    }
}
