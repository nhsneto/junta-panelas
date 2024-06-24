@props(['participant'])

@php
    $length = count($participant->items);

    if ($length === 0) {
        $formattedItems = '';
    } else if ($length === 1) {
        $formattedItems = $participant->items[0];
    } else {
        $last = $length - 1;
        $formattedItems = '';

        for ($i = 0; $i < $length; $i++) {
            if ($i === $last) {
                $formattedItems .= $participant->items[$i];
            } else {
                $formattedItems .= $participant->items[$i] . ' · ';
            }
        }
    }
@endphp

<article class="group flex flex-col basis-full gap-y-2 px-6 py-3 bg-[#fbfbfb] rounded-lg shadow-md">
    <div class="flex justify-between gap-x-2">
        <h2 class="font-bold text-black/50">{{ $participant->name }}</h2>
        <form method="POST" action="">
            @csrf
            <button class="hidden px-1 py-1 rounded hover:bg-black/5 active:bg-black/10 hover:text-[#c82333] group-hover:flex">
                <x-icons.trash />
            </button>
        </form>
    </div>
    <p class="text-sm font-semibold text-black/50">{{ $formattedItems }}</p>
</article>
