@props(['date' => date('c')])

<time datetime="{{ $date }}" {{ $attributes->merge(['class' => 'text-black/50 font-bold']) }}>
    {{ date('d/m/Y · H:i', strtotime($date)) }}
</time>
