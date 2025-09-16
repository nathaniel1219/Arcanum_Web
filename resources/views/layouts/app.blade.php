<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Arcanum') }}</title>
    @vite('resources/css/app.css') {{-- Laravel Mix / Vite --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="bg-gray-100 font-sans antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Page Content --}}
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script>
        async function addToCart(productId, quantity = 1) {
            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const res = await fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity
                    })
                });

                const data = await res.json();

                if (data.success) {
                    // Tell Livewire cart (if open) to refresh
                    if (window.Livewire) {
                        Livewire.emit('cartUpdated');
                    }
                    // lightweight feedback (replace with nicer toast later)
                    window.dispatchEvent(new CustomEvent('cart-toast', {
                        detail: {
                            message: data.message
                        }
                    }));
                } else {
                    window.dispatchEvent(new CustomEvent('cart-toast', {
                        detail: {
                            message: data.message || 'Failed to add'
                        }
                    }));
                }
            } catch (err) {
                console.error(err);
                window.dispatchEvent(new CustomEvent('cart-toast', {
                    detail: {
                        message: 'Network error'
                    }
                }));
            }
        }

        // optional global listener to show a simple toast (you can replace with nicer UI)
        window.addEventListener('cart-toast', e => {
            alert(e.detail.message);
        });
    </script>
    @livewireStyles
    @livewireScripts
    <!-- Tailwind toast -->
    <div x-data="{ show: false, message: '' }"
        x-on:toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition
        class="fixed top-4 right-4 bg-yellow-500 text-white px-4 py-2 rounded shadow-lg z-50">
        <span x-text="message"></span>
    </div>



</body>

</html>
