<?php

namespace App\Livewire;

use App\Models\Subscriptions\Subscription;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Subscriptions extends Component
{
    use WithPagination;

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

    public ?int $totalHits = 0;

    public function render()
    {
        return view('livewire.subscriptions', [
            'subscriptions' => $this->search(),
        ]);
    }

    public function search()
    {
        return Subscription::search($this->q, function ($meilisearch, string $q, array $options) {
            $options['facets'] = [
                'vendor',
                'formats',
                'subjects',
                'alpha',
            ];
            $options['sort'] = ['name:asc'];
            $options['filter'] = $this->buildFilterQuery();

            // https://github.com/meilisearch/meilisearch-php/blob/main/src/Search/SearchResult.php
            $response = $meilisearch->search($q, $options);
            $this->facetDistribution = $response->getFacetDistribution();
            //$this->totalHits = $response->getTotalHits();

            return $response;
        })
            ->query(fn (Builder $query) => $query->with([
                'vendor',
                'formats',
                'subjects',
                'proxy',
                'media',
            ]))
            ->paginate(20);
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

    #[On('update-alpha')]
    public function setAlpha($letter)
    {
        $this->filters['alpha'] = $letter;
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }
}
