<nav class="flex justify-between items-center py-10 font-semibold">
    <a href="{{ url('/') }}" class="font-['Style_Script'] text-3xl sm:text-5xl">Junta-Panelas</a>

    @guest
        <div class="dropdown dropdown-bottom dropdown-end sm:hidden">
            <button>
                <x-icons.bars class="size-7" />
            </button>
            <div tabindex="0" id="dropdownMenu" class="w-48 px-0 py-1.5 dropdown-content menu bg-[#fbfbfb] rounded z-[1] shadow">
                <a href="{{ route('login') }}" class="px-4 py-2 hover:bg-black/5">{{ __('Log In') }}</a>
                <a href="{{ route('register') }}" class="px-4 py-2 hover:bg-black/5">{{ __('Register') }}</a>
            </div>
        </div>

        <div class="hidden items-center space-x-6 sm:flex">
            <x-primary-link href="{{ route('login') }}">{{ __('Log In') }}</x-primary-link>
            <x-primary-link href="{{ route('register') }}">{{ __('Register') }}</x-primary-link>
        </div>
    @endguest

    @auth
        <div class="flex items-center space-x-6">
            <x-primary-link href="{{ route('junta-panelas.index') }}" class="hidden sm:inline">{{ __('My Junta-Panelas') }}</x-primary-link>

            <div class="flex dropdown dropdown-bottom dropdown-end">
                <button>
                    <x-icons.user-circle class="size-9" />
                </button>
                <div tabindex="0" id="dropdownMenu" class="w-48 px-0 py-1.5 dropdown-content menu bg-[#fbfbfb] rounded z-[1] shadow">
                    <a href="{{ route('junta-panelas.index') }}" class="px-4 py-2 hover:bg-black/5 sm:hidden">{{ __('My Junta-Panelas') }}</a>
                    <a href="{{ route('profile') }}" class="px-4 py-2 hover:bg-black/5">{{ __('Profile') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @method('DELETE')
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-black/5">{{ __('Log Out') }}</button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</nav>
