<x-layout>
    <section class="w-full flex justify-between items-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold leading-tight">{{ __('Plan Your Junta-Panelas now!') }}</h1>
            <p class="mt-4 text-xl leading-snug">{{ __('When will be the junta-panelas? What will people should bring?') }}</p>
            <x-primary-link-button href="{{ route('login') }}" class="mt-4 block text-xl py-4 rounded-xl">{{ __('Plan now!') }}</x-primary-link-button>
        </div>
        <img src="{{ url('storage/pexels-fauxels-3184195-640.jpg') }}" alt="{{ __('People having lunch at a table') }}" class="rounded-md drop-shadow-md">
    </section>
</x-layout>
