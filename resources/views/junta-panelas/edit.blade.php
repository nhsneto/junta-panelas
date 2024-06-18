<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">{{ __('Update Planning') }}</h1>

        <form method="POST" action="" class="w-full flex flex-col gap-y-6">
            @csrf
            <x-form-field label="{{ __('Event Title') }}" name="title" placeholder="{{ __('Christmas Party') }}" :value="old('title')" required/>
            <x-form-field label="{{ __('Date') }}" type="date" name="date" placeholder="test" :value="old('date')" required/>
            <x-form-field label="{{ __('Time') }}" type="time" name="time" :value="old('time')" required/>

            <div class="flex items-center justify-between gap-x-8">
                <button class="flex items-center gap-x-1.5 px-4 py-2 hover:text-[#c82333]">
                    <x-icons.trash />
                    <span>{{ __('Delete') }}</span>
                </button>
                <x-primary-button class="grow text-base py-3">{{ __('Plan') }}</x-primary-button>
            </div>
        </form>
    </section>
</x-layout>
