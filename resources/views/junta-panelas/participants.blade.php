<x-layout>
    <div class="max-w-xl flex flex-col basis-full gap-y-8">
        <h1 class="self-center text-2xl">{{ __('Participants') }}</h1>

        <section class="flex flex-col gap-y-10">
            <div class="text-center space-y-3">
                <h2 class="text-2xl font-bold">Confraternização do curso de inglês</h2>
                <p class="text-md font-bold text-black/50">31/05/2024 · 11:30</p>
            </div>
            <x-primary-link-button class="self-start">{{ __('Add') }}</x-primary-link-button>
            <ul class="space-y-4">
                <li>
                    <x-junta-panelas.participant-card />
                </li>
            </ul>
        </section>

        <form method="POST" action="" class="flex flex-col gap-y-4 px-6 py-6 bg-[#fbfbfb] text-sm rounded-lg shadow-md">
            @csrf
            <x-form-field label="{{ __('Name') }}" name="name" placeholder="{{ __('John') }}" :value="old('name')" required/>
            <x-form-field label="{{ __('Item(s)') }}" name="items" placeholder="{{ __('Cake, soda') }}" :value="old('items')" required/>
            <x-primary-button class="self-end px-3 py-2">{{ __('Add') }}</x-primary-button>
        </form>
    </div>
</x-layout>
