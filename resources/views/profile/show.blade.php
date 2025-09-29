@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    {{-- Update Profile Information --}}
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        @livewire('profile.update-profile-information-form')
        <x-section-border />
    @endif

    {{-- Update Password --}}
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>
        <x-section-border />
    @endif

    {{-- Two-Factor Authentication --}}
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire('profile.two-factor-authentication-form')
        </div>
        <x-section-border />
    @endif

    {{-- Logout Other Browser Sessions --}}
    <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div>

    {{-- Account Deletion --}}
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-section-border />
        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
    @endif

</div>
@endsection
