@props(['href' => '#'])

@php
    $classes = 'bg-[#f0997d] text-sm text-black/50 font-bold text-center px-4 py-2 rounded-md drop-shadow-md hover:brightness-110 active:brightness-100';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
