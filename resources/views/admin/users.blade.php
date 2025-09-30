<h1>All Users</h1>

@foreach($users as $user)
    <h3>{{ $user->name }} ({{ $user->email }})</h3>
    <ul>
        @foreach($user->orders as $order)
            <li>
                Order #{{ $order->id }} - {{ $order->order_status }}
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    <input type="text" name="order_status" value="{{ $order->order_status }}">
                    <button type="submit">Update</button>
                </form>
            </li>
        @endforeach
    </ul>
@endforeach
