<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Arcanum') }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @livewireStyles
</head>

<body class="bg-gray-100 font-sans antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Page Content --}}
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @livewireScripts

    {{-- Toast (works with Livewire dispatchBrowserEvent) --}}
    <div x-data="{ show: false, message: '' }"
        x-on:toast.window="
            message = $event.detail.message;
            show = true; 
            setTimeout(() => show = false, 3000);
        "
        x-show="show" x-transition
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50"
        <span x-text="message"></span>
    </div>

</body>

</html>
