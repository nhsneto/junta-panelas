<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-5 px-8 py-5 bg-[#fbfbfb] rounded-xl shadow-md md:gap-y-8 md:px-12 md:py-10">
        <h1 class="text-xl font-semibold md:text-3xl">{{ __('Welcome Back!') }}</h1>

        <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col gap-y-5 md:gap-y-6">
            @csrf
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="{{ __('Password') }}" type="password" name="password" required/>
            <x-primary-button class="py-3 text-sm md:text-base">{{ __('Log In') }}</x-primary-button>
        </form>

        <x-primary-link href="{{ route('register') }}" class="text-xs md:text-sm">{{ __('Not registered?') }}</x-primary-link>
    </section>
</x-layout>
