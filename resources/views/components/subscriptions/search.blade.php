<div>
    <div class="py-4">
        <form wire:submit="search"
              method="GET">
            <input type="text"
                   wire:model="q"
                   name="q"
                   placeholder="{{ str(__('subscriptions.search'))->title() }}..."
                   class="p-2 w-full border border-gray-300 corner-style-lg">
        </form>
    </div>
</div>
