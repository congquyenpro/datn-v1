<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Đăng Nhập</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required class="form-control" placeholder="Nhập email">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="password" required class="form-control" placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>
