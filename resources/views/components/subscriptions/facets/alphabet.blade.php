<div>
    <div class="flex gap-2 mb-4">
        @foreach(range('A', 'Z') as $letter)
            <div>
                <button wire:click="$set('filters.alpha', '{{ $letter }}')"
                        class="p-2">
                    {{ $letter }}
                </button>
            </div>
        @endforeach
    </div>
</div>
