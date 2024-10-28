<!-- resources/views/posts/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
    <table id="postsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Phone</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu sẽ được tải qua AJAX -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#postsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/order/all', // Đường dẫn đúng tới API
                    type: 'GET',
                    dataSrc: function(json) {
                        return json.data; // Trả về mảng 'data' từ phản hồi JSON
                    }
                },
                columns: [
                    { data: 'id' }, // Trường ID
                    { data: 'value' }, // Trường Value
                    { data: 'phone' }, // Trường Phone
                    { data: 'created_at' } // Trường Created At
                ],
                // Nếu bạn muốn thêm các tính năng phân trang của DataTables
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        </script>
</body>
</html>
