<div class="facet">
    @if($values = data_get($facets, $facet, []))

        <div x-data="{ active: 1 }" class="mx-auto space-y-4 w-full max-w-3xl min-h-[16rem]">
            <div x-data="{
                id: 1,
                get expanded() {
                    return this.active === this.id
                },
                set expanded(value) {
                    this.active = value ? this.id : null
                },
            }" role="region" class="bg-[var(--boxBackgroundColor)] shadow corner-style-lg">
                <h2>
                    <button
                        type="button"
                        x-on:click="expanded = !expanded"
                        :aria-expanded="expanded"
                        class="flex justify-between items-center py-4 px-6 w-full text-xl font-bold"
                    >
                        <span>
                            {{ str(__('subscriptions.'.$facet))->plural()->title() }}
                        </span>
                        <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                        <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                    </button>
                </h2>
                <div x-show="expanded" x-collapse>
                    <div class="px-2 pb-4">
                        <fieldset>
                            <legend class="sr-only">
                                {{ str(__('subscriptions.'.$facet))->plural()->title() }}
                            </legend>
                            <div class="overflow-auto mt-2 max-h-72">
                                @foreach($values as $name => $count)
                                    <div class="flex relative items-start py-2 px-3">
                                        <div class="flex-1 min-w-0 text-sm leading-6">
                                            <label for="person-1"
                                                   class="font-medium text-gray-900 select-none">
                                                {{ $name }} ({{ $count }})
                                            </label>
                                        </div>
                                        <div class="flex items-center ml-3 h-6">
                                            <input wire:model.live="filters.{{ $facet }}"
                                                    id="person-1"
                                                   name="person-1"
                                                   type="checkbox"
                                                   value="{{ $name }}"
                                                   class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-600 corner-style"
                                                   wire:key="checkbox-{{ str($name)->slug() }}"
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
