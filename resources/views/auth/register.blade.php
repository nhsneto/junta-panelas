<x-layout>
    <section class="max-w-lg flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold">{{ __('Register') }}</h1>

        <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col gap-y-6">
            @csrf
            <x-form-field label="{{ __('Name') }}" name="name" :value="old('name')" required/>
            <x-form-field label="Email" type="email" name="email" :value="old('email')" required/>
            <x-form-field label="{{ __('Password') }}" type="password" name="password" required/>
            <x-form-field label="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required/>
            <x-primary-button class="py-3">{{ __('Register Now') }}</x-primary-button>
        </form>

        <x-primary-link href="{{ route('login') }}" class="text-sm">{{ __('Already registered?') }}</x-primary-link>
    </section>
</x-layout>
