@extends('layouts.app')
@section('content')

<h3>Tasks</h3>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Driver Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($driversWithTasks as $driver)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $driver->name }}</td>
      <td>{{ ucfirst($driver->status) }}</td>
      <td>
        @if($driver->status == 'free')
          <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal{{ $driver->id }}">
            Add Task
          </button>
        @else
          <button class="btn btn-sm btn-secondary" disabled>Not Available</button>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@foreach($driversWithTasks as $driver)
<div class="modal fade" id="addTaskModal{{ $driver->id }}" tabindex="-1" aria-labelledby="addTaskModalLabel{{ $driver->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ url('/tasks/assign') }}">
      @csrf
      <input type="hidden" name="driver_id" value="{{ $driver->id }}">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskModalLabel{{ $driver->id }}">Add Task for {{ $driver->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="destinations-wrapper-{{ $driver->id }}">
          <div class="mb-3">
            <input type="text" name="destinations[]" class="form-control mb-2" placeholder="Destination Name" required>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-primary" onclick="addDestination({{ $driver->id }})">Add Another Destination</button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Destinations</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
@endforeach

<script>
function addDestination(driverId) {
  const wrapper = document.getElementById('destinations-wrapper-' + driverId);
  const newInput = document.createElement('div');
  newInput.classList.add('mb-3');
  newInput.innerHTML = `
    <input type="text" name="destinations[]" class="form-control mb-2" placeholder="Destination Name" required>
  `;
  wrapper.appendChild(newInput);
}
</script>

@endsection
