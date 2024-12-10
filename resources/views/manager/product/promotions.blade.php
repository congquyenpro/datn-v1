@extends('manager.layout')

@section('page_title', 'Chương trình khuyến mãi')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Chương trình khuyến mãi</h4>
                </div>
            </div>
        </div>
        @include('errors.error-admin')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Catergory</option>
                                <option value="all">All</option>
                                <option value="Burberry">Burberry</option>
                                <option value="Calvin Klein">Calvin Klein</option>
                                <option value="Christian Dior">Christian Dior</option>
                            </select>
                        </div>
                        <div class="m-b-10">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="inStock">In Stock</option>
                                <option value="outOfStock">Out of Stock</option>
                                <option value="outOfStock">Trending</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Khuyến mãi</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Tên chương trình</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $ls)
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-{{$ls->id}}" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                {{$ls->id}}
                            </td>
                            <td>
                                {{$ls->name}}
                            </td>
                            <td>
                                {{$ls->start_date}}
                            </td>
                            <td>
                                {{$ls->end_date}}
                            </td>
                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded btn-remove-promotion" data-promotion-id="{{$ls->id}}" data-toggle="modal" data-target="#deleteModal">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Chương trình khuyến mãi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('manager.promotion.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">                        
                            <label for="inputname" class="col-sm-2 col-form-label">Tên chương trình</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputname" placeholder="Tên chương trình" required>
                            </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputStartTime" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                        <div class="col-sm-10">
                            <input type="text" name="start_date" class="form-control" id="inputStartTime" placeholder="ngày/tháng/năm" required onchange="validateDates()">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputEndTime" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                        <div class="col-sm-10">
                            <input type="text" name="end_date" class="form-control" id="inputEndTime" placeholder="ngày/tháng/năm" required onchange="validateDates()" >
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputEndTime" class="col-sm-2 col-form-label">Mã khuyến mại (Nếu có)</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" id="inputEnđate" placeholder="Mã khuyến mãi">
                        </div>
                    </div>
                    <div class="form-group row">                        
                        <label for="inputEndTime" class="col-sm-2 col-form-label">Chiết khấu</label>
                        <div class="col-sm-10">
                            <input type="number" name="discount" class="form-control" id="inputEnđate" placeholder="% Khuyến mãi" required>
                        </div>
                    </div>

                    <label for="inputEndTime" class="col-form-label">Danh sách sản phẩm</label>
                    <!-- Multiple select boxes -->
                    <div>
                        <select class="select2" name="product_list[]" multiple="multiple">
                            @foreach ($products as $pr)
                            <option value="{{$pr->id}}">{{$pr->id}} - {{$pr->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="validateDatesOnSubmit(event)">Lưu lại</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa chương trình khuyến mãi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Xác nhận xóa ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-submit-remove">Xóa</button>
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
        function isValidDate(dateString) {
            // Kiểm tra định dạng ngày
            if (!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString)) // Sửa từ - thành /
                return false;

            // Phân tách ngày, tháng, năm
            var parts = dateString.split("/");
            var day = parseInt(parts[0], 10);
            var month = parseInt(parts[1], 10);
            var year = parseInt(parts[2], 10);

            // Kiểm tra phạm vi tháng và năm
            if (year < 1000 || year > 3000 || month == 0 || month > 12)
                return false;

            var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            // Điều chỉnh cho năm nhuận
            if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
                monthLength[1] = 29;

            // Kiểm tra phạm vi ngày
            return day > 0 && day <= monthLength[month - 1];
        }
        function validateDatesOnSubmit(event) {
            var startDate = document.getElementById('inputStartTime').value;
            var endDate = document.getElementById('inputEndTime').value;

            // Kiểm tra xem trường ngày bắt đầu và ngày kết thúc đã được điền
            if (!startDate) {
                alert('Vui lòng nhập ngày bắt đầu.');
                event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                return;
            }

            if (!endDate) {
                alert('Vui lòng nhập ngày kết thúc.');
                event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                return;
            }

            // Kiểm tra ngày bắt đầu
            if (!isValidDate(startDate)) {
                alert('Ngày bắt đầu không hợp lệ. Vui lòng nhập theo định dạng ngày/tháng/năm.');
                event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                return;
            }

            // Kiểm tra ngày kết thúc
            if (!isValidDate(endDate)) {
                alert('Ngày kết thúc không hợp lệ. Vui lòng nhập theo định dạng ngày/tháng/năm.');
                event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                return;
            }

            // Kiểm tra nếu ngày kết thúc sau ngày bắt đầu
            var start = new Date(startDate.split('/').reverse().join('/'));
            var end = new Date(endDate.split('/').reverse().join('/'));

            if (start > end) {
                alert('Ngày kết thúc phải sau ngày bắt đầu.');
                event.preventDefault(); // Ngăn chặn gửi biểu mẫu
                return;
            }
        }
    </script>

    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>
    <script>
        
        function deletePromotion(){
            $('.btn-remove-promotion').click(function(){
                var id = $(this).data('promotion-id');
                console.log(id);
                $('.btn-submit-remove').click(function(){
                    Api.Promotion.delete(id).done(function(response){
                        if(response.status == "success"){
                            $('#deleteModal').modal('hide');
                            location.reload();
                        }else{
                            alert('Xóa không thành công');
                        }

                    }).fail(function(response){
                        alert('Xóa không thành công');
                        console.log(response);
                    });
                });
            });
        }
        deletePromotion();
    </script>
@endsection