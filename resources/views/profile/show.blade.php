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

    {{-- My Orders --}}
    <x-section-border />
    <div class="mt-10 sm:mt-0">
        <h2 class="text-lg font-medium text-gray-900">My Orders</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Order ID</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-4 py-2 border">{{ $order->id }}</td>
                            <td class="px-4 py-2 border">{{ $order->total }}</td>
                            <td class="px-4 py-2 border">{{ $order->order_status }}</td>
                            <td class="px-4 py-2 border">{{ $order->order_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
