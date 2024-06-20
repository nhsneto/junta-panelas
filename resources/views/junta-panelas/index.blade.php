<x-layout>
    <div class="mt-6 w-2/3 flex flex-col">
        <x-primary-link-button href="{{ route('junta-panelas.create') }}" class="w-32 px-9 py-3 font-extrabold">{{ __('Plan') }}</x-primary-link-button>
        <div class="mt-12 space-y-5">
            @foreach($juntaPanelasList as $juntaPanelas)
                <x-junta-panelas.card :juntaPanelas="$juntaPanelas" />
            @endforeach
        </div>
    </div>
</x-layout>
