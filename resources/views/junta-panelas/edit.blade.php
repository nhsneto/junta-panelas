@php
$timestamp = strtotime($juntaPanelas->date);
$date = date('Y-m-d', $timestamp);
$time = date('H:i', $timestamp);
@endphp

<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">{{ __('Update Planning') }}</h1>

        <form method="POST" action="{{ route('junta-panelas.update', ['juntaPanelas' => $juntaPanelas]) }}" class="w-full flex flex-col gap-y-6">
            @method('PUT')
            @csrf
            <x-form-field label="{{ __('Event Title') }}" name="title" placeholder="{{ __('Christmas Party') }}" :value="$juntaPanelas->title" required/>
            <x-form-field label="{{ __('Date') }}" type="date" name="date" :min="now()->addDay()->format('Y-m-d')" :value="$date" required/>
            <x-form-field label="{{ __('Time') }}" type="time" name="time" :value="$time" required/>

            <div class="flex items-center justify-between gap-x-8">
                <button form="deleteForm" class="flex items-center gap-x-1.5 px-4 py-2 hover:text-[#c82333]">
                    <x-icons.trash />
                    <span>{{ __('Delete') }}</span>
                </button>
                <x-primary-button class="grow text-base py-3">{{ __('Plan') }}</x-primary-button>
            </div>
        </form>

        <form id="deleteForm" method="POST" action="{{ route('junta-panelas.destroy', ['juntaPanelas' => $juntaPanelas]) }}">
            @method('DELETE')
            @csrf
        </form>
    </section>
</x-layout>
