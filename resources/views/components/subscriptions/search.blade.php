<div>
    <form wire:submit="search"
          method="GET">
        <input type="text"
               wire:model="q"
               name="q"
               placeholder="{{ str(__('subscriptions.search'))->title() }}..."
               class="p-2 w-full rounded-lg border border-gray-300">
    </form>
</div>
