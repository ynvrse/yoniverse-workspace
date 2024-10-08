<div class="flex gap-2">
    <button class="rounded-md bg-red-500 text-white px-4 py-2" wire:click="decrement">
        -
    </button>
    <p class="text-2xl font-bold">{{ $counter }}</p>

    <button class="rounded-md bg-green-500 text-white px-4 py-2" wire:click="increment">
        +
    </button>

</div>
