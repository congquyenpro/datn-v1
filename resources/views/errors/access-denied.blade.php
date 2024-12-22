{{-- <!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
</head>
<body>
    <h1>Access Denied</h1>
    <p>{{ session('error') }}</p>
    <a href="{{ url('/') }}">Quay lại trang chủ</a>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Error</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('admin_assets/images/logo_banner/BKP.png')}}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('admin_assets/assets/css/app.min.css')}}" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid">
            <div class="d-flex full-height p-v-20 flex-column justify-content-between">
                <div class="d-none d-md-flex p-h-40">
                    <img src="{{asset('admin_assets/images/logo_banner/BKP.png')}}" alt="">
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="p-v-30">
                                <h1 class="font-weight-semibold display-1 text-primary lh-1-2">404</h1>
                                <h2 class="font-weight-light font-size-30">Whoops! Looks like you got lost</h2>
                                <p class="lead m-b-30">{{ session('error') }}</p>
                                <a href="{{ url('/') }}" class="btn btn-primary btn-tone">Go Back</a>
                                or
                                <a href="{{ route('manager.auth.logout') }}" class="btn btn-primary btn-tone">Log out</a>
                            </div>
                        </div>
                        <div class="col-md-6 m-l-auto">
                            <img class="img-fluid" src="{{asset('admin_assets/assets/images/others/error-1.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex  p-h-40 justify-content-between">
                    <span class="">© 2024 BKPerfume</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Core Vendors JS -->
    <script src="{{asset('admin_assets/assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{asset('admin_assets/assets/js/app.min.js')}}"></script>

    <!-- Right assets-->
    {{-- <script src="{{asset('/assets')}}/js/vendors.min.js"></script> --}}

</body>

</html>