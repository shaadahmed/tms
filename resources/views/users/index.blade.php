@extends('layouts.app')

@section('title', 'User Management')

@section('styles')
<!-- Additional styles can be placed here -->
@endsection

@section('content')
    <h2>User Management</h2>
    <button class="btn btn-primary mb-3" id="createUser">Create New User</button>
    <table id="userTable" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('getUsers') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'id',
                    name: 'actions',
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-warning" onclick="updateUser(${data})">Update</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(${data})">Delete</button>
                        `;
                    },
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#createUser').click(function() {
            window.location.href = '{{ route('users.create') }}';
        });
    });

    function updateUser(userId) {
        window.location.href = `/users/${userId}/edit`;
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: `/users/${userId}`,
                type: 'DELETE',
                success: function(result) {
                    $('#userTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    alert('Error deleting user');
                }
            });
        }
    }
</script>
@endsection
