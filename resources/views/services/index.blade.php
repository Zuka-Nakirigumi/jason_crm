@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Services</h2>
            <a href="{{ route('services.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add Service
            </a>
        </div>

        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 font-medium">Name</th>
                    <th class="py-2 font-medium">Price</th>
                    <th class="py-2 font-medium">Description</th>
                    <th class="py-2 font-medium">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($services as $service)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3">{{ $service->name }}</td>
                    <td class="py-3">Rp{{ number_format($service->price) }}</td>
                    <td class="py-3 text-gray-600">{{ $service->description }}</td>
                    <td class="py-3 space-x-2">
                        <a href="{{ route('services.show', $service) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('services.edit', $service) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this service?')" class="text-red-600 hover:underline">
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
