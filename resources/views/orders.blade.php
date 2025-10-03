@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Order ID</th>
                        <th class="px-4 py-2 border">Total</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Items</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Shipping Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-4 py-2 border">{{ $order->id }}</td>
                            <td class="px-4 py-2 border">{{ $order->total }}</td>
                            <td class="px-4 py-2 border">{{ $order->order_status }}</td>
                            <td class="px-4 py-2 border">{{ $order->order_date }}</td>
                            <td class="px-4 py-2 border">
                                @foreach ($order->orderItems ?? [] as $item)
                                    <div>{{ $item->product->product_name ?? 'Unnamed Product' }} x {{ $item->quantity }}</div>
                                @endforeach

                            </td>
                            <td class="px-4 py-2 border">{{ $order->payment_method ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $order->shipping_address ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
