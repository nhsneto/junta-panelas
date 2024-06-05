@props(['href' => '#'])

@php
    $classes = 'block bg-[#f0997d] text-xl text-black/50 font-bold text-center py-4 rounded-xl drop-shadow-md hover:brightness-110 active:brightness-100';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
