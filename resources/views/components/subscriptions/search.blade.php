<div>
    <form wire:submit="search"
          method="GET">
        <input type="text"
               wire:model="q"
               name="q"
               placeholder="{{ str(__('subscriptions.search'))->title() }}..."
               class="w-full p-2 border border-gray-300 rounded-lg">
    </form>
</div>
