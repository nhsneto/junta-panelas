@php
    $classes = 'bg-[#f0997d] text-xl text-black/50 font-bold text-center py-2.5 rounded-xl drop-shadow-md hover:brightness-110 active:brightness-100';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
