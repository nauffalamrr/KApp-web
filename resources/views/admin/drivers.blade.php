@extends('layouts.app')
@section('content')
<h3>Drivers</h3>

<!-- Button Add Driver -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDriverModal">
  Add Driver
</button>

<table class="table">
  <thead>
    <tr>
      <th>No</th><th>Name</th><th>Username</th><th>Password</th><th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($drivers as $i => $driver)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $driver->name }}</td>
        <td>{{ $driver->username }}</td>
        <td>••••••</td>
        <td>
          <!-- Edit Button -->
          <button type="button" class="btn btn-sm btn-warning btn-edit-driver"
            data-id="{{ $driver->id }}"
            data-name="{{ $driver->name }}"
            data-username="{{ $driver->username }}"
            data-bs-toggle="modal" data-bs-target="#editDriverModal">
            Edit
          </button>

          <!-- Delete Form -->
          <form action="{{ url('drivers/delete/' . $driver->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal Add Driver -->
<div class="modal fade" id="addDriverModal" tabindex="-1" aria-labelledby="addDriverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ url('drivers/store') }}">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addDriverModalLabel">Add Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Driver</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Driver -->
<div class="modal fade" id="editDriverModal" tabindex="-1" aria-labelledby="editDriverModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" id="editDriverForm">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="editDriverModalLabel">Edit Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="name" id="edit-name" class="form-control mb-2" placeholder="Name" required>
        <input type="text" name="username" id="edit-username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control" placeholder="New Password (leave blank if no change)">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('.btn-edit-driver');
  const editForm = document.getElementById('editDriverForm');
  const inputName = document.getElementById('edit-name');
  const inputUsername = document.getElementById('edit-username');

  editButtons.forEach(button => {
    button.addEventListener('click', function () {
      const id = this.dataset.id;
      const name = this.dataset.name;
      const username = this.dataset.username;

      editForm.action = `/drivers/update/${id}`;

      inputName.value = name;
      inputUsername.value = username;

      editForm.querySelector('input[name="password"]').value = '';
    });
  });
});
</script>
@endsection
