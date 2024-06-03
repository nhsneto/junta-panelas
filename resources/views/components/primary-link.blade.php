@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'hover:text-[#d3756b] hover:underline decoration-2 underline-offset-2']) }}>
    {{ $slot }}
</a>
