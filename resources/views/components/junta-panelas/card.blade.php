@props(['juntaPanelas'])

@php
    $timestamp = strtotime($juntaPanelas->date);
    $date = date('d/m/Y · H:i', $timestamp);
@endphp

<article {{ $attributes->merge(['class' => 'group bg-[#fbfbfb] px-5 py-4 rounded-xl shadow-md']) }}>
    <div class="flex gap-x-2 items-center">
        <h1>
            <x-primary-link href="{{ route('junta-panelas.show') }}" class="text-lg font-bold">{{ $juntaPanelas->title }}</x-primary-link>
        </h1>
        <a href="{{ route('junta-panelas.edit') }}" class="hidden px-1 py-1 rounded-md group-hover:inline hover:bg-black/5 active:bg-black/10">
            <x-icons.pencil />
        </a>
    </div>

    <p class="mt-1 text-sm text-black/50 font-bold">{{ $date }}</p>

    <div class="mt-4 inline-flex items-center gap-x-1.5">
        <x-primary-link href="{{ route('junta-panelas.participants') }}" class="flex items-center gap-x-1.5 text-sm font-bold">
            <x-icons.people />
            <span>{{ __('Participants') }}</span>
        </x-primary-link>
    </div>
</article>
