<div>
    <div class="flex gap-2 mb-4">
        <div>
            <button wire:click="$set('filters.alpha', null)"
                    class="p-2 @if(empty(data_get($filters, 'alpha', null))) active  bg-[var(--primaryLinkColor)] @endif">
                {{ __('All') }}
            </button>
        </div>
        @foreach(range('A', 'Z') as $letter)
            <div>
                <button wire:click="$set('filters.alpha', '{{ $letter }}')"
                        class="p-2
                                @if(data_get($filters, 'alpha', null) == $letter) active bg-[var(--primaryLinkColor)] @endif
                                @if(! in_array($letter, array_keys(data_get($facets, 'alpha', [])))) opacity-40 @endif
                        "
                        @if(! in_array($letter, array_keys(data_get($facets, 'alpha', [])))) disabled @endif
                >
                    {{ $letter }}
                </button>
            </div>
        @endforeach
    </div>
</div>
