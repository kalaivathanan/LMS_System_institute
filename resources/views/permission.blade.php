@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Permissions') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <button class="btn btn-primary" id="createPermissionBtn">Create Permission</button>
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
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm edit-permission"
                                                data-permission-id="{{ $permission->id }}"
                                                data-permission-name="{{ $permission->name }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-permission"
                                                data-permission-id="{{ $permission->id }}"
                                                data-permission-name="{{ $permission->name }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Create and Edit Permission -->
    <div class="modal" tabindex="-1" role="dialog" id="permissionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalTitle">Create Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="permissionForm">
                        @csrf
                        <input type="hidden" id="permissionId" name="permissionId">
                        <div class="form-group">
                            <label for="permissionName">Permission Name:</label>
                            <input type="text" class="form-control" id="permissionName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function () {
            // Code for handling Create and Edit Modal
            $('#createPermissionBtn').click(function () {
                $('#permissionModalTitle').text('Create Permission');
                $('#permissionId').val('');
                $('#permissionName').val('');
                $('#permissionModal').modal('show');
            });

            $('.edit-permission').click(function () {
                var permissionId = $(this).data('permission-id');
                var permissionName = $(this).data('permission-name');

                $('#permissionModalTitle').text('Edit Permission');
                $('#permissionId').val(permissionId);
                $('#permissionName').val(permissionName);
                $('#permissionModal').modal('show');
            });

            // Code for handling form submission
            $('#permissionForm').submit(function (e) {
                e.preventDefault();

                var actionUrl = ($('#permissionId').val() !== '') ? '/permissions/' + $('#permissionId').val() : '/permissions';

                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#permissionModal').modal('hide');
                        location.reload(); // Reload the page or update the table using AJAX
                    },
                    error: function (error) {
                        console.log(error);
                        // Handle error response
                    }
                });
            });

            // Code for handling Delete action
            $('.delete-permission').click(function () {
                if (confirm('Are you sure you want to delete this permission?')) {
                    var permissionId = $(this).data('permission-id');
                    var actionUrl = '/permissions/' + permissionId;

                    $.ajax({
                        type: 'DELETE',
                        url: actionUrl,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            location.reload(); // Reload the page or update the table using AJAX
                        },
                        error: function (error) {
                            console.log(error);
                            // Handle error response
                        }
                    });
                }
            });
        });
    </script>
@endsection
