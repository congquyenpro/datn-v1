@extends('manager.layout')

@section('page_title', 'Giao dịch')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Giao dịch</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Lịch sử nhập -->
        <div id="entry-history" class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-30">
                        <div class="col-lg-8">
                            <div class="d-md-flex">
                                <div class="m-b-10 m-r-15">
                                    <select class="custom-select" style="min-width: 180px;">
                                        <option selected>Loại giao dịch</option>
                                        <option value="all">Tất cả</option>
                                        <option value="Burberry">IN</option>
                                        <option value="Calvin Klein">OUT</option>
                                    </select>
                                </div>
                                <div class="m-b-10 m-r-15">
                                    <select class="custom-select" style="min-width: 180px;">
                                        <option selected>Thời gian</option>
                                        <option value="all">Tất cả</option>
                                        <option value="Burberry">Tháng này</option>
                                        <option value="Calvin Klein">3 tháng gần đây</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <button class="btn btn-primary" id="export-excel">
                                <i class="fas fa-file-excel m-r-5"></i>
                                <span>Export</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover e-commerce-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tài khoản</th>
                                    <th>THời gian</th>
                                    <th>Loại</th>
                                    <th>Số tiền</th>
                                    <th>Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $tr)
                                    <tr>
                                        <td>{{$tr->id}}</td>
                                        <td>{{$tr->gateway}}</td>
                                        <td>{{$tr->created_at}}</td>
                                        @if ($tr->amount_in > 0)
                                            <td><span class="badge badge-pill badge-info">IN</span></td>
                                            <td>{{$tr->amount_in}}</td>
                                        @else
                                            <td><span class="badge badge-pill badge-warning">OUT</span></td>
                                            <td>{{$tr->amount_out}}</td>
                                        @endif
                                        <td>{{$tr->transaction_content}}</td>    
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('page_js')
    <!-- page js -->
    <script src="{{asset('admin_assets/assets/vendors/select2/select2.min.js')}}"></script>

    <script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

    <script>
            $('.select2').select2();
    </script>
    
    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>

@endsection