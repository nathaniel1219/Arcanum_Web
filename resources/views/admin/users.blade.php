{{-- resources/views/admin/users.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-6 flex flex-col">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <a href="{{ route('dashboard') }}" class="text-[#F4B14E] hover:underline mb-6 inline-block">← Back to Shop</a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded max-w-7xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex gap-8 max-w-7xl flex-1">
        {{-- Sidebar with users --}}
        <aside class="w-64 bg-white p-4 rounded shadow h-[600px] overflow-y-auto">
            <h2 class="font-semibold text-lg mb-4 border-b pb-2">Users</h2>
            <ul>
                @foreach($users as $user)
                    <li class="mb-2">
                        <a href="{{ route('admin.users', ['selected' => $user->id]) }}"
                           class="block px-3 py-1 rounded hover:bg-yellow-100 {{ request('selected') == $user->id ? 'bg-yellow-200 font-semibold' : '' }}">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        {{-- Main content --}}
        <main class="flex-1 bg-white p-6 rounded shadow max-h-[600px] overflow-y-auto">
            @php
                $selectedUser = $users->firstWhere('id', request('selected'));
            @endphp

            @if($selectedUser)
                <section class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">User Details</h2>
                    <p><strong>Name:</strong> {{ $selectedUser->name }}</p>
                    <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
                    <p><strong>Is Admin:</strong> {{ $selectedUser->is_admin ? 'Yes' : 'No' }}</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">User Orders</h2>
                    @if($selectedUser->orders->count())
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-3 py-1 text-left">Order ID</th>
                                    <th class="border border-gray-300 px-3 py-1 text-left">Total</th>
                                    <th class="border border-gray-300 px-3 py-1 text-left">Date</th>
                                    <th class="border border-gray-300 px-3 py-1 text-left">Status</th>
                                    <th class="border border-gray-300 px-3 py-1 text-left">Change</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedUser->orders as $order)
                                    <tr>
                                        <td class="border border-gray-300 px-3 py-1">{{ $order->id }}</td>
                                        <td class="border border-gray-300 px-3 py-1">LKR {{ number_format($order->total, 2) }}</td>
                                        <td class="border border-gray-300 px-3 py-1">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="border border-gray-300 px-3 py-1">{{ $order->order_status }}</td>
                                        <td class="border border-gray-300 px-3 py-1">
                                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <select name="order_status" class="border rounded px-2 py-1">
                                                    <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                                </select>
                                                <button type="submit" class="bg-[#F4B14E] text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>This user has no orders.</p>
                    @endif
                </section>
            @else
                <p>Select a user from the left panel to view details.</p>
            @endif
        </main>
    </div>
</div>
@endsection
