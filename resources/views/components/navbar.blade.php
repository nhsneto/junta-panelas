<nav class="flex justify-between items-center py-10 font-semibold">
    <a href="{{ url('/') }}" class="font-['Style_Script'] text-5xl">Junta-Panelas</a>
    <div class="flex items-center space-x-6">
        @guest
            <x-primary-link href="{{ route('login') }}">{{ __('Log In') }}</x-primary-link>
            <x-primary-link href="{{ route('register') }}">{{ __('Register') }}</x-primary-link>
        @endguest

        @auth
            <x-primary-link href="{{ route('junta-panelas.index') }}">{{ __('My Junta-Panelas') }}</x-primary-link>

            <div class="flex dropdown dropdown-bottom dropdown-end">
                <button>
                    <x-icons.user-circle class="size-9" />
                </button>
                <div tabindex="0" id="dropdownMenu" class="w-48 px-0 py-1.5 dropdown-content menu bg-[#fbfbfb] rounded z-[1] shadow">
                    <a href="{{ route('profile') }}" class="px-4 py-2 hover:bg-black/5">{{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @method('DELETE')
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-black/5">{{ __('Log Out') }}</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
