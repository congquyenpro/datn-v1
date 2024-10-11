<!DOCTYPE html>
<html>
<head>
    <title>Role and Permission Management</title>
    <!-- Include any necessary CSS frameworks like Bootstrap -->
</head>
<body>

    <div class="container">
        <h1>Role and Permission Management</h1>

        <!-- Display existing roles with their permissions -->
        <h3>Roles</h3>
        <ul>
            @foreach ($roles as $role)
                <li>{{ $role->name }} 
                    - Permissions: 
                    @foreach ($role->permissions as $permission)
                        {{ $permission->name }},
                    @endforeach
                </li>
            @endforeach
        </ul>

        <!-- Add new role form -->
        <h3>Add New Role</h3>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <label for="role_name">Role Name:</label>
            <input type="text" name="name" id="role_name" required>
            
            <h4>Select Permissions:</h4>
            @foreach ($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> 
                    {{ $permission->name }}
                </label><br>
            @endforeach

            <button type="submit">Add Role</button>
        </form>

        <hr>
        <h3>Edit Role</h3>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="role">Select Role to Edit:</label>
            <select name="role_id" id="role" required onchange="fetchRoleName(this.value)">
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            
            <label for="role_name">Role Name:</label>
            <input type="text" name="name" id="role_name" required>

            <button type="submit">Update Role</button>
        </form>
        <hr>

        <!-- Add new permission form -->
        <h3>Add New Permission</h3>
        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <label for="permission_name">Permission Name:</label>
            <input type="text" name="name" id="permission_name" required>
            <button type="submit">Add Permission</button>
        </form>

        <hr>

        <h3>Gán quyền cho Vai Trò (Role)</h3>
        @foreach ($roles as $role)
            <h4>{{ $role->name }}</h4>
            <form action="{{ route('roles.assignPermissions', $role->id) }}" method="POST">
                @csrf
                <label for="permissions">Chọn các quyền:</label><br>
                @foreach ($permissions as $permission)
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}> 
                            {{ $permission->name }}
                    </label><br>
                @endforeach
                <button type="submit">Gán quyền</button>
            </form>
        @endforeach
        
        <h3>Delete Role</h3>
        <form action="{{ route('roles.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');">
            @csrf
            @method('DELETE')
            <label for="role">Select Role to Delete:</label>
            <select name="role_id" id="role" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-danger">Delete Role</button>
        </form>

        <h3>Delete Permissions</h3>
        <form action="{{ route('permissions.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the selected permissions?');">
            @csrf
            @method('DELETE')
            <label>Select Permissions to Delete:</label><br>
            @foreach ($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ $permission->name }}
                </label><br>
            @endforeach
            <button type="submit" class="btn btn-danger">Delete Selected Permissions</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif



        <!-- Success messages -->
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif
    </div>

</body>
<script>
    function fetchRoleName(roleId) {
        if (roleId) {
            fetch(`/roles/${roleId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('role_name').value = data.name;
                });
        } else {
            document.getElementById('role_name').value = '';
        }
    }
    </script>
    
</html>
