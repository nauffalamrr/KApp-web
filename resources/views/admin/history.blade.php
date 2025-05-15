@extends('layouts.app')
@section('content')
<h3>Delivery History</h3>
<table class="table">
  <thead>
    <tr><th>No</th><th>Driver</th><th>Task</th><th>Status</th><th>Action</th></tr>
  </thead>
  <tbody>
    @foreach($histories as $i => $history)
    <tr>
      <td>{{ $i + 1 }}</td>
      <td>{{ $history->driver->name }}</td>
      <td>#{{ $history->id }}</td>
      <td>{{ $history->status }}</td>
      <td>
        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $history->id }}">
          Detail
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@foreach($histories as $history)
<div class="modal fade" id="detailModal{{ $history->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Detail Task</h5></div>
      <div class="modal-body">
        <p><strong>Driver:</strong> {{ $history->driver->name }}</p>
        <p><strong>Status:</strong> {{ $history->status }}</p>
        <p><strong>Destinations:</strong></p>
        <ul>
          @foreach($history->destinations as $dest)
          <li>{{ $dest->destination_name }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
