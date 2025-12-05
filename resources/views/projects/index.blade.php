@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Projects</h2>
            <a href="{{ route('projects.create') }}"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                + Add Project
            </a>
        </div>

        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b">
                    <th class="py-2 font-medium">Project Name</th>
                    <th class="py-2 font-medium">Client</th>
                    <th class="py-2 font-medium">Service</th>
                    <th class="py-2 font-medium">Status</th>
                    <th class="py-2 font-medium">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3">{{ $project->name }}</td>
                    <td class="py-3">{{ $project->lead->name ?? '-' }}</td>
                    <td class="py-3">{{ $project->service->name ?? '-' }}</td>
                    <td class="py-3">
                        <span class="px-3 py-1 rounded text-white
                            @if($project->status == 'ongoing') bg-blue-600
                            @elseif($project->status == 'completed') bg-green-600
                            @else bg-gray-600 @endif
                        ">
                            {{ ucfirst($project->status) }}
                        </span>
                    </td>
                    <td class="py-3 space-x-2">
                        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('projects.edit', $project) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this project?')" class="text-red-600 hover:underline">
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
