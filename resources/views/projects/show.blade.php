@if(auth()->user()->isManager() || auth()->user()->role === 'admin')
  @if($project->approval_status == 'pending')
  <form action="{{ route('projects.approve', $project) }}" method="POST" style="display:inline">@csrf<button class="btn btn-success">Approve</button></form>
  <form action="{{ route('projects.reject', $project) }}" method="POST" style="display:inline">@csrf<button class="btn btn-danger">Reject</button></form>
  @endif
@endif

<table class="table">
  <thead><tr><th>Customer</th><th>Service</th><th>Start</th><th>End</th><th>Status</th></tr></thead>
  <tbody>
  @foreach($subscriptions as $s)
    <tr>
      <td>{{ $s->user->name }} ({{ $s->user->email }})</td>
      <td>{{ $s->service->name }}</td>
      <td>{{ $s->start_date }}</td>
      <td>{{ $s->end_date }}</td>
      <td>{{ $s->status }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
