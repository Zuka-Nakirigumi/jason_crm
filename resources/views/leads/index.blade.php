@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-md rounded p-6">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Leads</h1>
        <a href="{{ route('leads.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Lead
        </a>
    </div>

    <table class="min-w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Company</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border w-48">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td class="p-3 border">{{ $lead->name }}</td>
                <td class="p-3 border">{{ $lead->company }}</td>
                <td class="p-3 border">{{ $lead->email }}</td>
                <td class="p-3 border">
                    <span class="px-2 py-1 text-xs rounded bg-gray-200">{{ $lead->status }}</span>
                </td>
                <td class="p-3 border">
                    <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:underline">View</a> |
                    <a href="{{ route('leads.edit', $lead) }}" class="text-green-600 hover:underline">Edit</a> |
                    <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    |
                    <a href="{{ route('projects.create', ['lead_id'=>$lead->id]) }}"
                       class="text-purple-600 hover:underline">
                       Create Project
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
