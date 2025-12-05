@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">

    <h1 class="text-xl font-semibold mb-4">Lead Details</h1>

    <p><strong>Name:</strong> {{ $lead->name }}</p>
    <p><strong>Company:</strong> {{ $lead->company }}</p>
    <p><strong>Email:</strong> {{ $lead->email }}</p>
    <p><strong>Status:</strong> {{ $lead->status }}</p>

    <a href="{{ route('leads.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">
        ← Back
    </a>

</div>
@endsection
