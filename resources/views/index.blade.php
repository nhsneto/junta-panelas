<x-layout>
    <section class="w-full flex flex-col justify-center items-center gap-y-10 sm:flex-row sm:gap-y-0 sm:gap-x-10 lg:justify-between">
        <img src="{{ url('storage/pexels-fauxels-3184195-640.jpg') }}" alt="{{ __('People having lunch at a table') }}" class="w-full max-w-[385px] rounded-md drop-shadow-md sm:min-w-[385px] sm:max-w-[480px] lg:min-w-[480px] lg:max-w-[640px]">
        <div class="max-w-md">
            <h1 class="text-xl font-bold leading-tight md:text-2xl md:leading-tight lg:text-5xl lg:leading-tight">{{ __('Plan Your Junta-Panelas now!') }}</h1>
            <p class="mt-4 text-sm leading-snug md:text-base md:leading-snug lg:text-xl lg:leading-snug">{{ __('When will be the junta-panelas? What will people should bring?') }}</p>
            <x-primary-link-button href="{{ route('login') }}" class="mt-4 block text-lg py-4 rounded-xl lg:text-xl">{{ __('Plan now!') }}</x-primary-link-button>
        </div>
    </section>
</x-layout>
