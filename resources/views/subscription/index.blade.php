@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Subscriptions</h2>
            <a href="{{ route('subscriptions.create') }}"
               class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                + Add Subscription
            </a>
        </div>

        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 font-medium">Client</th>
                    <th class="py-2 font-medium">Service</th>
                    <th class="py-2 font-medium">Start</th>
                    <th class="py-2 font-medium">End</th>
                    <th class="py-2 font-medium">Status</th>
                    <th class="py-2 font-medium">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($subscriptions as $subscription)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3">{{ $subscription->lead->name }}</td>
                    <td class="py-3">{{ $subscription->service->name }}</td>
                    <td class="py-3">{{ $subscription->start_date }}</td>
                    <td class="py-3">{{ $subscription->end_date }}</td>
                    <td class="py-3">
                        <span class="px-3 py-1 rounded text-white
                            @if($subscription->status == 'active') bg-green-600
                            @elseif($subscription->status == 'expired') bg-red-600
                            @else bg-gray-600 @endif
                        ">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                    <td class="py-3 space-x-2">
                        <a href="{{ route('subscriptions.show', $subscription) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('subscriptions.edit', $subscription) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this subscription?')" class="text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
