<x-layout>
    <div class="max-w-2xl flex flex-col basis-full items-center gap-y-20">
        <section class="w-full flex flex-col items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
            <h2 class="text-xl font-semibold self-start">{{ __('Change Email') }}</h2>
            <form method="POST" action="{{ route('email.update') }}" class="w-full flex flex-col gap-y-6 text-sm">
                @method('put')
                @csrf
                <x-form-field label="{{ __('Current Email') }}" type="email" name="current_email" :value="old('current_email')" required/>
                <x-form-field label="{{ __('New Email') }}" type="email" name="new_email" :value="old('new_email')" required/>
                <x-form-field label="{{ __('Confirm New Email') }}" type="email" name="new_email_confirmation" required/>
                <x-primary-button class="self-start px-5 py-2.5">{{ __('Change Email') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
            <h2 class="text-xl font-semibold self-start">{{ __('Change Password') }}</h2>
            <form method="POST" action="" class="w-full flex flex-col gap-y-6 text-sm">
                @csrf
                <x-form-field label="{{ __('Current Password') }}" type="email" name="current_password" :value="old('current_email')" required/>
                <x-form-field label="{{ __('New Password') }}" type="email" name="new_password" required/>
                <x-form-field label="{{ __('Confirm New Password') }}" type="email" name="new_password_confirmation" required/>
                <x-primary-button class="self-start px-5 py-2.5">{{ __('Change Password') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full px-12 py-4 bg-[#fbfbfb] rounded-xl shadow-md">
            <form method="POST" action="">
                @csrf
                <button class="flex items-center gap-x-1.5 px-2 py-1 text-sm text-[#c82333] rounded hover:bg-black/5">
                    <x-icons.trash />
                    <span>{{ __('Delete Account') }}</span>
                </button>
            </form>
        </section>
    </div>
</x-layout>
