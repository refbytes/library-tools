<div>
    <div class="flex gap-2 mb-4">
        <div>
            <button wire:click="$dispatch('update-alpha', {'letter': null})"
                    class="p-2 @if(empty(data_get($filters, 'alpha', null))) active  bg-[var(--primaryLinkColor)] @endif">
                {{ __('All') }}
            </button>
        </div>
        @foreach(range('A', 'Z') as $letter)
            <div>
                <button wire:click="$dispatch('update-alpha', {'letter': '{{ $letter }}'})"
                        class="p-2
                                @if(data_get($filters, 'alpha', null) == $letter) active bg-[var(--primaryLinkColor)] @endif
                                @if(empty($alphaFacet->firstWhere('value', $letter))) opacity-40 @endif
                        "
                        @if(empty($alphaFacet->firstWhere('value', $letter))) disabled @endif
                >
                    {{ $letter }}
                </button>
            </div>
        @endforeach
    </div>
</div>
