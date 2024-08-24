<li class="resource">
    <div>
        <div>
            <div class="mb-4 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    @if($thumbnail = $subscription->getfirstMediaUrl('thumbnail'))
                        <div class="w-48 h-48 flex-0">
                            <img src="{{ $thumbnail }}" alt="{{ $subscription->name }}" class="object-cover" />
                        </div>
                    @endif
                    <div class="flex-1">
                        <div class="py-5 px-4 sm:px-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                <a href="{{ $subscription->full_url }}">
                                    {{ $subscription->name }}
                                </a>
                               @if($subscription->vendor_id)
                                    <span>
                                        by {{ $subscription->vendor->name }}
                                    </span>
                               @endif
                            </h3>
                            <div class="line-clamp-3">
                                {!! $subscription->description !!}
                            </div>
                            <div>
                                <div class="flex flex-wrap gap-4">
                                    @foreach($subscription->subjects as $subject)
                                        <span>
                            {{ $subject->name }}
                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-0">

                        <div class="flex justify-center">
                            <div
                                x-data="{
                                    open: false,
                                    toggle() {
                                        if (this.open) {
                                            return this.close()
                                        }

                                        this.$refs.button.focus()

                                        this.open = true
                                    },
                                    close(focusAfter) {
                                        if (! this.open) return

                                        this.open = false

                                        focusAfter && focusAfter.focus()
                                    }
                                }"
                                x-on:keydown.escape.prevent.stop="close($refs.button)"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']"
                                class="relative"
                            >
                                <!-- Button -->
                                <button
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="flex items-center p-2"
                                >
                        <span class="sr-only">
                            Options
                        </span>
                                    <x-heroicon-o-ellipsis-vertical class="w-5 h-5 text-gray-400" />
                                </button>

                                <!-- Panel -->
                                <div
                                    x-ref="panel"
                                    x-show="open"
                                    x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')"
                                    style="display: none;"
                                    class="absolute right-2 mt-2 w-40 bg-white rounded-md shadow-md"
                                >
                                    <a href="#" class="flex gap-2 items-center py-2.5 px-4 w-full text-sm text-left hover:bg-gray-50 disabled:text-gray-500 first-of-type:rounded-t-md last-of-type:rounded-b-md">
                                        Copy URL
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
