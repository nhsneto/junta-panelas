<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-5 px-8 py-5 bg-[#fbfbfb] rounded-xl shadow-md md:gap-y-8 md:px-12 md:py-10">
        <h1 class="text-xl font-semibold md:text-3xl">{{ __('Register') }}</h1>

        <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col gap-y-5 md:gap-y-6">
            @csrf
            <x-form-field label="{{ __('Name') }}" name="name" :value="old('name')" required/>
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="{{ __('Password') }}" type="password" name="password" required/>
            <x-form-field label="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required/>
            <x-primary-button class="py-3 text-sm md:text-base">{{ __('Register Now') }}</x-primary-button>
        </form>

        <x-primary-link href="{{ route('login') }}" class="text-xs md:text-sm">{{ __('Already registered?') }}</x-primary-link>
    </section>
</x-layout>
