<?php

namespace App\Livewire;

use App\Models\Subscriptions\Subscription;
use Illuminate\Support\Collection;
use Livewire\Component;

class Subscriptions extends Component
{
    public ?Collection $subscriptions;

    public function render()
    {
        $this->subscriptions = Subscription::get();

        return view('livewire.subscriptions');
    }
}
