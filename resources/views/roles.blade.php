@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Roles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <button class="btn btn-primary" id="createRoleBtn">Create Role</button>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-role"
                                                data-role-id="{{ $role->id }}"
                                                data-role-name="{{ $role->name }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-role"
                                                data-role-id="{{ $role->id }}"
                                                data-role-name="{{ $role->name }}">Delete</button>

                                            <!-- Assign Permissions Button -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#permissionsModal{{ $role->id }}">
                                                Assign Permissions
                                            </button>

                                            <!-- Permissions Modal -->
                                            <div class="modal fade" id="permissionsModal{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="permissionsModalLabel{{ $role->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="roleModalTitle">Create Role</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- ... permissions modal content ... -->
                                                            <form id="permissionsForm{{ $role->id }}">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- List of permissions with checkboxes -->

                                                                <!-- Include the role ID in the form -->
                                                                <input type="hidden" name="role_id"
                                                                    value="{{ $role->id }}">

                                                                @foreach ($permissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]"
                                                                            value="{{ $permission->name }}"
                                                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach

                                                                <button type="submit" class="btn btn-primary mt-3">Save
                                                                    Permissions</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Assing Roles to User category') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('assignRolesByDesignation') }}">
                            @csrf
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <select name="designation" id="designation" class="form-select">
                                    @foreach ($desig as $desigs)
                                        <option value={{ $desigs->desig }}>{{ $desigs->desig }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-select">
                                    @foreach ($roles as $role)
                                        <!-- Populate this dropdown with your available roles -->
                                        <option value={{ $role->name }}>{{ $role->name }}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            {{-- <label for="permission">Permission:</label>
                            <select name="permission" id="permission">
                                <!-- Populate this dropdown with your available permissions -->
                                <option value="edit">Edit</option>
                                <option value="view">View</option>
                                <!-- Add more options as needed -->
                            </select> --}}
                            <br />
                            <div class="form-group">
                                {{-- <div class="modal-footer bg-success text-light text-center"> --}}
                                <button type="submit" class="bg-success text-light text-center">Assign Roles </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Assing Permission to specific user') }}</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('assignPermissionToUser') }}">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User:</label>
                                <select name="user_id" id="user_id" class="form-select">
                                    <!-- Populate this dropdown with your available users -->
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="permission">Permission:</label>
                                <select name="permission" id="permission" class="form-select">
                                    @foreach ($permissions as $permissions)
                                    <option value="{{$permissions->name}}">{{$permissions->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="bg-success text-light text-center">Assign Permissions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Create and Edit Role -->
    <div class="modal" tabindex="-1" role="dialog" id="roleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalTitle">Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="roleForm">
                        @csrf
                        <input type="hidden" id="roleId" name="roleId">
                        <div class="form-group">
                            <label for="roleName">Role Name:</label>
                            <input type="text" class="form-control" id="roleName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function() {
            // Code for handling Create and Edit Modal
            $('#createRoleBtn').click(function() {
                $('#roleModalTitle').text('Create Role');
                $('#roleId').val('');
                $('#roleName').val('');
                $('#roleModal').modal('show');
            });

            $('.edit-role').click(function() {
                var roleId = $(this).data('role-id');
                var roleName = $(this).data('role-name');

                $('#roleModalTitle').text('Edit Role');
                $('#roleId').val(roleId);
                $('#roleName').val(roleName);
                $('#roleModal').modal('show');
            });

            // Code for handling form submission
            $('#roleForm').submit(function(e) {
                e.preventDefault();

                var actionUrl = ($('#roleId').val() !== '') ? '/roles/' + $('#roleId').val() : '/roles';

                $.ajax({
                    type: 'post',
                    url: actionUrl,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#roleModal').modal('hide');
                        location.reload(); // Reload the page or update the table using AJAX
                    },
                    error: function(error) {
                        console.log(error);
                        // Handle error response
                    }
                });
            });

            // Code for handling Delete action
            $('.delete-role').click(function() {
                if (confirm('Are you sure you want to delete this role?')) {
                    var roleId = $(this).data('role-id');
                    var actionUrl = '/roles/' + roleId;

                    $.ajax({
                        type: 'DELETE',
                        url: actionUrl,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            location.reload(); // Reload the page or update the table using AJAX
                        },
                        error: function(error) {
                            console.log(error);
                            // Handle error response
                        }
                    });
                }
            });
            //comment this and add one atleast one role
        $('#permissionsForm{{ $role->id }}').submit(function(e) {
            e.preventDefault();

            // Extract form data
            var formData = $(this).serialize();

            // Determine the action URL
            var actionUrl = '/roles/' + $(this).find('input[name="role_id"]').val() + '/permissions';

            // Send AJAX request
            $.ajax({
                type: 'post',
                url: actionUrl,
                data: formData,
                success: function(response) {
                    // Handle success (close modal, update UI, etc.)
                    $('#permissionsModal{{ $role->id }}').modal('hide');
                    // ... other actions ...
                },
                error: function(error) {
                    console.log(error);
                    // Handle error response
                }
            });
        });
        });
    </script>
@endsection
