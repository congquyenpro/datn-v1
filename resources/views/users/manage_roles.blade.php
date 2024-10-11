<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Manage User Roles</h3>

    <form action="{{ route('users.assignRoles', $selectedUser->id ?? '') }}" method="POST" onsubmit="return confirm('Are you sure you want to assign these roles?');">
        @csrf
        <label for="user">Select User:</label>
        <select id="user" name="user_id" onchange="updateRoles(this.value)">
            <option value="">Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    
        <div id="assign-roles" style="margin-top: 20px;"></div>
    
        <button type="submit" class="btn btn-success">Assign Roles</button>
    </form>
    
    <form action="{{ route('users.removeRoles', $selectedUser->id ?? '') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove these roles?');" style="margin-top: 20px;">
        @csrf
        @method('POST')
    
        <div id="remove-roles" style="margin-top: 20px;"></div>
    
        <button type="submit" class="btn btn-danger">Remove Roles</button>
    </form>
    
    <script>
        function updateRoles(userId) {
            if (userId) {
                // Gửi AJAX request để lấy các role hiện tại của người dùng
                fetch(`/users/${userId}/roles`)
                    .then(response => response.json())
                    .then(data => {
                        const assignRolesDiv = document.getElementById('assign-roles');
                        const removeRolesDiv = document.getElementById('remove-roles');
    
                        // Hiển thị role để gán
                        assignRolesDiv.innerHTML = '';
                        data.allRoles.forEach(role => {
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'roles[]';
                            checkbox.value = role.id;
    
                            const label = document.createElement('label');
                            label.appendChild(checkbox);
                            label.appendChild(document.createTextNode(role.name));
                            assignRolesDiv.appendChild(label);
                            assignRolesDiv.appendChild(document.createElement('br'));
                        });
    
                        // Hiển thị role để xóa
                        removeRolesDiv.innerHTML = '';
                        data.currentRoles.forEach(role => {
                            const checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.name = 'roles[]';
                            checkbox.value = role.id;
                            checkbox.checked = true; // Đánh dấu role hiện tại
    
                            const label = document.createElement('label');
                            label.appendChild(checkbox);
                            label.appendChild(document.createTextNode(role.name));
                            removeRolesDiv.appendChild(label);
                            removeRolesDiv.appendChild(document.createElement('br'));
                        });
                    });
            } else {
                document.getElementById('assign-roles').innerHTML = ''; // Xóa nội dung nếu không chọn user
                document.getElementById('remove-roles').innerHTML = ''; // Xóa nội dung nếu không chọn user
            }
        }
    </script>
</body>
</html>