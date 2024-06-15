@php
    $classes = 'bg-[#f0997d] text-black/50 font-bold text-center rounded-xl drop-shadow-md hover:brightness-110 active:brightness-100';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
