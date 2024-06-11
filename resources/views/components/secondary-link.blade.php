@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'border-2 border-transparent rounded font-semibold hover:border-[#f0997d]']) }}>
    {{ $slot }}
</a>
