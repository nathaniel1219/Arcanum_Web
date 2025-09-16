<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 font-sans">
        <x-authentication-card class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md">
            <x-slot name="logo">
                <img src="{{ asset('images/logo/ARCANUM.png') }}" alt="Arcanum Logo" class="w-full mb-4">
            </x-slot>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Status Message -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Password Input -->
                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </div>

                <!-- Login Button -->
                <x-button class="w-full py-2 bg-[#F4B14E] text-white font-semibold rounded-md hover:bg-yellow-600 transition-colors duration-300">
                    {{ __('Log in') }}
                </x-button>

                <!-- Register Link -->
                <p class="text-center text-sm text-gray-600 mt-2">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
                </p>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <p class="text-center text-sm mt-1">
                        <a class="underline text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </p>
                @endif
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
