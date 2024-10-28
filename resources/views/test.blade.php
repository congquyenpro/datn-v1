<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
        }
        
        .pagination a, .pagination span {
            padding: 10px 15px;
            margin: 0 5px;
            border: 1px solid #ddd;
            text-decoration: none;
        }
        
        .pagination .active {
            background-color: #007bff;
            color: white;
        }
        
        .pagination .disabled {
            color: #ccc;
        }
        </style>
        
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td><img src="{{ $product->image }}" alt="" width="100"></td>
            </tr>
        @endforeach
        <div class="pagination">
            {{ $products->links('vendor.pagination.custom') }} <!-- Chỉ định view tùy chỉnh -->
        </div>
        
    

        {{-- datatable
                <h1>Product List</h1>
    <table id="productTable" border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/products', // URL đến controller để lấy dữ liệu
                    type: 'GET'
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'images', render: function(data) {
                        return `<img src="${data}" alt="" width="100">`;
                    }}
                ],
                paging: true,
                lengthChange: true,
                pageLength: 5
            });
        });
    </script>


        --}}
</body>
</html>