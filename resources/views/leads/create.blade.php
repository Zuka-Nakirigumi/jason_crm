@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">

    <h1 class="text-xl font-semibold mb-4">Add Lead</h1>

    <form action="{{ route('leads.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Name</label>
        <input name="name" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Company</label>
        <input name="company" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Email</label>
        <input name="email" type="email" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Status</label>
        <select name="status" class="w-full border p-2 rounded mb-4">
            <option>New</option>
            <option>Contacted</option>
            <option>Negotiating</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>

    </form>
</div>
@endsection
