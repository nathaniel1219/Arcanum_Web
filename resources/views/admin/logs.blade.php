@extends('layouts.app') {{-- or your layout file --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Admin Logs</h1>

    @if(!empty($logs) && count($logs) > 0)
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Message</th>
                    <th class="py-2 px-4 border-b">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $log->_id ?? $log->id }}</td>

                        {{-- Safe message output --}}
                        <td class="py-2 px-4 border-b">
                            @if(is_array($log->message))
                                <pre class="text-sm">{{ json_encode($log->message, JSON_PRETTY_PRINT) }}</pre>
                            @else
                                {{ $log->message }}
                            @endif
                        </td>

                        <td class="py-2 px-4 border-b">{{ $log->created_at ?? $log->timestamp ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No logs available.</p>
    @endif
</div>
@endsection
