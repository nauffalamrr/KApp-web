@extends('layouts.app')
@section('content')
<h3 class="mb-4 fw-bold">Drivers</h3>

<!-- Button Add Driver -->
<div class="d-flex justify-content-end mb-3">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriverModal">
    Add Driver
  </button>
</div>

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
        @if(session('form') === 'add' && $errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
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
        @if(session('form') === 'edit' && $errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
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

@if(session('form') === 'add' && $errors->any())
<script>
  var addModal = new bootstrap.Modal(document.getElementById('addDriverModal'));
  addModal.show();
</script>
@endif

@if(session('form') === 'edit' && $errors->any())
<script>
  var editModal = new bootstrap.Modal(document.getElementById('editDriverModal'));
  editModal.show();
</script>
@endif

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
