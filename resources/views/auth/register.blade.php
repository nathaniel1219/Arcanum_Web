<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 font-sans">
        <x-authentication-card class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md">
            <x-slot name="logo">
                <img src="{{ asset('images/logo/ARCANUM.png') }}" alt="Arcanum Logo" class="w-full mb-4">
            </x-slot>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name Input -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email Input -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Password Input -->
                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Terms and Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div>
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2 text-sm text-gray-600">
                                    {!! trans('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <!-- Register Button -->
                <x-button class="w-full py-2 bg-[#F4B14E] text-white font-semibold rounded-md hover:bg-yellow-600 transition-colors duration-300">
                    {{ __('Register') }}
                </x-button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-600 mt-2">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
                </p>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
