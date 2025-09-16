<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo/ARCANUM.png') }}" alt="Arcanum Vault" class="h-10">
        </a>

        {{-- Links --}}
        <ul class="flex space-x-6 text-gray-700 font-medium">
            <li>
                <x-nav-link :href="url('/')" :active="request()->is('/')">
                    Home
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="url('/pokemon')" :active="request()->is('pokemon')">
                    Pokémon
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="url('/tcg')" :active="request()->is('tcg')">
                    TCG
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="url('/funko')" :active="request()->is('funko')">
                    Funko
                </x-nav-link>
            </li>
        </ul>

        {{-- Right-side icons --}}
        <div class="flex items-center space-x-4">
            @auth
                {{-- Profile icon --}}
                <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-yellow-500">
                    <img src="{{ asset('images/icons/account.svg') }}" alt="Profile" class="h-6 w-6">
                </a>

                {{-- Cart icon --}}
                <a href="{{ url('/cart') }}" class="text-gray-700 hover:text-yellow-500">
                    <img src="{{ asset('images/icons/cart.svg') }}" alt="Cart" class="h-6 w-6">
                </a>

                {{-- Logout button for testing --}}
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 ml-2">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Register</a>
            @endauth
        </div>
    </div>
</nav>
