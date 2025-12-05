@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">

    <h1 class="text-xl font-semibold mb-4">Edit Lead</h1>

    <form action="{{ route('leads.update', $lead) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Name</label>
        <input name="name" value="{{ $lead->name }}" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Company</label>
        <input name="company" value="{{ $lead->company }}" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Email</label>
        <input name="email" value="{{ $lead->email }}" type="email" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Status</label>
        <select name="status" class="w-full border p-2 rounded mb-4">
            <option {{ $lead->status=='New' ? 'selected':'' }}>New</option>
            <option {{ $lead->status=='Contacted' ? 'selected':'' }}>Contacted</option>
            <option {{ $lead->status=='Negotiating' ? 'selected':'' }}>Negotiating</option>
        </select>

        <div class="flex justify-between">
            <a href="{{ route('leads.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                ← Back
            </a>
            <button type="submit" class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700">Update</button>
        </div>

    </form>
</div>
@endsection
