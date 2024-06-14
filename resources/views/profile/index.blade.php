<x-layout>
    <div class="max-w-2xl flex flex-col basis-full items-center gap-y-20">
        <section class="w-full flex flex-col items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
            <h2 class="text-xl font-semibold self-start">{{ __('Change Email') }}</h2>

            <form method="POST" action="" class="w-full flex flex-col gap-y-6 text-sm">
                @csrf
                <x-form-field label="{{ __('Current Email') }}" type="email" name="current_email" :value="old('current_email')" required/>
                <x-form-field label="{{ __('New Email') }}" type="email" name="new_email" required/>
                <x-form-field label="{{ __('Confirm New Email') }}" type="email" name="new_email_confirmation" required/>
                <x-primary-button class="max-w-40">{{ __('Change Email') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full flex flex-col basis-full items-center gap-y-8 px-12 py-10 bg-[#fbfbfb] rounded-xl shadow-md">
            <h2 class="text-xl font-semibold self-start">{{ __('Change Password') }}</h2>

            <form method="POST" action="" class="w-full flex flex-col gap-y-6 text-sm">
                @csrf
                <x-form-field label="{{ __('Current Password') }}" type="email" name="current_password" :value="old('current_email')" required/>
                <x-form-field label="{{ __('New Password') }}" type="email" name="new_password" required/>
                <x-form-field label="{{ __('Confirm New Password') }}" type="email" name="new_password_confirmation" required/>
                <x-primary-button class="max-w-40">{{ __('Change Password') }}</x-primary-button>
            </form>
        </section>

        <section class="w-full px-12 py-4 bg-[#fbfbfb] rounded-xl shadow-md">
            <form method="POST" action="">
                @csrf
                <button class="flex items-center gap-x-1.5 px-2 py-1 text-sm text-[#c82333] rounded hover:bg-black/5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 group-hover:text-[#c82333]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    <span>{{ __('Delete Account') }}</span>
                </button>
            </form>
        </section>
    </div>
</x-layout>
