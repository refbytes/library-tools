<div>
    <div class="py-4">
        <form wire:submit="search"
              method="GET">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <input type="search"
                       wire:model="q"
                       name="q"
                       placeholder="{{ str(__('subscriptions.search'))->title() }}..."
                       class="p-2 w-full border border-gray-300 corner-style-lg">
                <button type="submit"
                        class="p-2 bg-[var(--primaryButtonColor)] bg-[var(--primaryInverseButtonColor)] corner-style-lg">
                    {{ str(__('subscriptions.search'))->title() }}
                </button>
            </div>
        </form>
    </div>
</div>
