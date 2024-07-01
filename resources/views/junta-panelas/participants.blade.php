<x-layout>
    <div class="max-w-xl flex flex-col basis-full gap-y-8">
        <section class="flex flex-col gap-y-10">
            <div class="text-center space-y-3">
                <h1 class="text-2xl font-bold">{{ $juntaPanelas->title }}</h1>
                <x-date :date="$juntaPanelas->date" class="block text-md" />
            </div>
            <h2 class="self-center text-2xl">{{ __('Participants') }}</h2>
            <x-primary-link-button href="#name" class="self-start">{{ __('Add') }}</x-primary-link-button>
            <ul class="space-y-4">
                @foreach($juntaPanelas->participants->sortBy('name') as $participant)
                    <li>
                        <x-junta-panelas.participant-card :$participant :$juntaPanelas />
                    </li>
                @endforeach
            </ul>
        </section>

        <form method="POST" action="{{ route('participant.store', ['juntaPanelas' => $juntaPanelas]) }}" class="mt-12 flex flex-col gap-y-4 px-6 py-6 bg-[#fbfbfb] text-sm rounded-lg shadow-md">
            @csrf
            <x-form-field label="{{ __('Name') }}" name="name" id="name" placeholder="{{ __('John') }}" :value="old('name')" required/>
            <div class="flex flex-col gap-y-4">
                <p class="font-semibold">Item(s)</p>
                <x-form-field name="item_1" placeholder="{{ __('Cake') }}" :value="old('item_1')" />
                <x-form-field name="item_2" :value="old('item_2')" />
                <x-form-field name="item_3" :value="old('item_3')" />
                <x-form-field name="item_4" :value="old('item_4')" />
                <x-form-field name="item_5" :value="old('item_5')" />
            </div>
            <x-primary-button class="self-end px-3 py-2">{{ __('Add') }}</x-primary-button>
        </form>
    </div>
</x-layout>
