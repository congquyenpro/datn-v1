@extends('manager.layout')

@section('page_title', 'Quản lý người dùng')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/select2/select2.css')}}" rel="stylesheet">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('page_content')

<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Nhân viên</h4>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs nav-justified" id="myTabJustified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-justified" role="tab" aria-controls="home-justified" aria-selected="true">Người dùng hệ thống</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-justified" role="tab" aria-controls="profile-justified" aria-selected="false">Vai trò và quyền</a>
        </li>
    </ul>
    <div class="tab-content m-t-15" id="myTabContentJustified">
        <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab-justified">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-30">
                        <div class="col-lg-8">
                            <div class="d-md-flex">
                                <div class="m-b-10">
                                    <select class="custom-select" style="min-width: 180px;">
                                        <option selected>Status</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Nhân viên</span>
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
                                    <th>Tên</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($users))
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="check-item-1" type="checkbox">
                                                <label for="check-item-1" class="m-b-0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            #{{$user->id}}
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($user->status == 1)
                                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                                    <div>Active</div>
                                                @else 
                                                    <div class="badge badge-danger badge-dot m-r-10"></div>
                                                    <div>Deactive</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded btn-edit-user" data-id="{{$user->id}}" data-toggle="modal" data-target=".bd-example-modal-lg-2">
                                                <i class="anticon anticon-eye"></i>
                                            </button>
           {{--                                  <button class="btn btn-icon btn-hover btn-sm btn-rounded btn-delete-user" data-toggle="modal" data-target="#deleteModal" data-id="{{$user->id}}">
                                                <i class="anticon anticon-delete"></i>
                                            </button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab-justified">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-30">
                        <div class="col-lg-8">
                            <div class="d-md-flex">
                                <div class="m-b-10 m-r-15">
                                    <select class="custom-select" style="min-width: 180px;">
                                        <option selected>Status</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-3">
                                <i class="anticon anticon-plus-circle m-r-5"></i>
                                <span>Vai trò</span>
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
                                    <th>Vai trò</th>
                                    <th>Quyền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($permissions_by_roles))
                                    @foreach ($permissions_by_roles as $pbr)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <input id="check-item-1" type="checkbox">
                                                <label for="check-item-1" class="m-b-0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{$pbr->id}}
                                        </td>
                                        <td>
                                            {{$pbr->name}}
                                        </td>
                                        <td>
                                            @foreach ($pbr->permissions as $permission)
                                                {{$permission->description}} <br>
                                            @endforeach
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded edit-permission-btn" data-id="{{$pbr->id}}" data-role-name="{{$pbr->name}}" data-toggle="modal" data-target=".bd-example-modal-lg-4">
                                                <i class="anticon anticon-eye"></i>
                                            </button>
{{--                                             <button class="btn btn-icon btn-hover btn-sm btn-rounded" data-id="{{$pbr->id}}">
                                                <i class="anticon anticon-delete"></i>
                                            </button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- Modal User -->
    <div class="modal fade bd-example-modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('manager.users.store')}}">
                        @csrf
                        <div class="form-group row">                        
                                <label for="inputname" class="col-sm-2 col-form-label">Họ tên</label>
                                <div class="col-sm-10">
                                    <input type="name" name="name" class="form-control" id="inputname3" placeholder="Họ tên">
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="text" name="password" class="form-control" id="inputPassword3" placeholder="Mật khẩu">
                                <a href="#" class="m-t-10 btn btn-default float-right">Random</a>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 pt-0">Vai trò</label>
                            <div class="col-sm-10">
                                <select name="role_id" id="inputState" class="form-control">
                                    @if (isset($all_roles))
                                        @foreach ($all_roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach                                   
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal edit user --}}
    <div class="modal fade bd-example-modal-lg-2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div id="edit-modal-body"></div>
            </div>
        </div>
    </div>


    <!-- Model Role -->
    <div class="modal fade bd-example-modal-lg-3">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Vai trò và Quyền</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('manager.roles')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="inputRole" class="col-sm-2 col-form-label">Vai trò</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputRole" placeholder="Vai trò">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">Quyền</div>
                            <div class="col-sm-10">
                                @foreach ($all_permissions as $ap)
                                    <div class="checkbox">
                                        <input type="checkbox" name="permission_id[]" id="role_permission{{$ap->id}}" value="{{$ap->id}}">
                                        <label for="role_permission{{$ap->id}}">{{$ap->description}}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal Role -->
    <div class="modal fade bd-example-modal-lg-4">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Vai trò và Quyền</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div id="edit-role-body"></div>
            </div>
        </div>
    </div>

    {{-- Form delete user and role --}}
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xóa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div id="delete-model-body">

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
        $(document).ready(function(){
            $('.btn-edit-user').click(function(){
                var user_id = $(this).data('id');
                $.ajax({
                    url: '/admin/system/user/' + user_id,
                    type: 'GET',
                    success: function(response){
                        var roleOptions = '';
                        @if (isset($all_roles))
                            @foreach ($all_roles as $role)
                                roleOptions += `<option value="{{ $role->id }}" ${response.roles[0].id === {{ $role->id }} ? 'selected' : ''}>{{ $role->name }}</option>`;
                            @endforeach
                        @endif

                        $('#edit-modal-body').html(`
                        <div class="modal-body">
                            <form>
                                <div class="form-group row">                        
                                        <label for="inputname" class="col-sm-2 col-form-label">Họ tên</label>
                                        <div class="col-sm-10">
                                            <input type="name" name="name" class="form-control" id="inputname3" placeholder="Họ tên" value="${response.name}">
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="${response.email}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control" id="inputPassword3" placeholder="Mật khẩu" autocomplete="new-password">
                                        <a href="#" class="m-t-10 btn btn-default float-right">Random</a>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 pt-0">Vai trò</label>
                                    <div class="col-sm-10">
                                        <select name="role_id" id="inputState" class="form-control">
                                            ${roleOptions}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 pt-0">Trạng thái</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="inputStatus" class="form-control">
                                            <option value="1">Activate</option>
                                            <option value="0">Deactivate</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-update-user" data-id="${user_id }">Lưu lại</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                        `);
                    }
                });
            });

            $(document).on('click', '.btn-update-user', function(e){
                e.preventDefault();
                
                var token = $('meta[name="csrf-token"]').attr('content'); // Lấy CSRF token
                var form = $(this).closest('form'); // Lấy form chứa button
                var formData = form.serialize(); // Lấy dữ liệu từ form
                var user_id = $(this).data('id'); // Lấy user_id từ data-id của button

                // Thêm user_id vào dữ liệu gửi lên
                formData += '&user_id=' + user_id; // Thêm user_id vào form data

                $.ajax({
                    url: '/admin/system/user/' + user_id, // Đường dẫn API cập nhật
                    type: 'POST',
                    data: formData, // Gửi dữ liệu form
                    headers: {
                        'X-CSRF-TOKEN': token // Thêm CSRF token vào header
                    },
                    success: function(response){
                        if(response.code == 200){
                            alert('Cập nhật thành công');
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error); // Nếu có lỗi xảy ra
                    }
                });
            });

            $('.edit-permission-btn').click(function(e){
                e.preventDefault();
                var role_id = $(this).data('id');
                var role_name = $(this).data('role-name');
                
                $.ajax({
                    url: '/admin/system/permission-by-role/' + role_id,
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                        
                        // Dữ liệu phản hồi có dạng mảng với các permission_id đã được gán
                        var assignedPermissions = response.map(function(item) {
                            return item.permission_id;
                        });

                        // Tạo HTML cho modal
                        $('#edit-role-body').html(`
                        <div class="modal-body">
                            <form>
                                <div class="form-group row">
                                    <label for="inputRole" class="col-sm-2 col-form-label">Vai trò</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputRole" placeholder="Vai trò" value="${role_name}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">Quyền</div>
                                    <div class="col-sm-10">
                                        @foreach ($all_permissions as $ap)
                                            <div class="checkbox">
                                                <input type="checkbox" name="permission_id[]" id="role_permission{{$ap->id}}_2" value="{{$ap->id}}" 
                                                ${assignedPermissions.includes({{ $ap->id }}) ? 'checked' : ''}>
                                                <label for="role_permission{{$ap->id}}_2">{{$ap->description}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-update-role" data-role-id="${role_id}">Cập nhật</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                        `);
                    }
                });
            });

            $(document).on('click', '.btn-update-role', function(e){
                e.preventDefault();
                
                var token = $('meta[name="csrf-token"]').attr('content'); // Lấy CSRF token
                var form = $(this).closest('form'); // Lấy form chứa button
                var formData = form.serialize(); // Lấy dữ liệu từ form
                var role_id = $(this).data('role-id'); // Lấy role_id từ data-id của button

                // Thêm role_id vào dữ liệu gửi lên
                formData += '&role_id=' + role_id; // Thêm role_id vào form data

                $.ajax({
                    url: '/admin/system/update-role/' + role_id, // Đường dẫn API cập nhật
                    type: 'POST',
                    data: formData, // Gửi dữ liệu form
                    headers: {
                        'X-CSRF-TOKEN': token // Thêm CSRF token vào header
                    },
                    success: function(response){
                        alert('Cập nhật thành công');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error); // Nếu có lỗi xảy ra
                    }
                });
            });

            //delete user
            $('.btn-delete-user').click(function(){
                let id = $(this).data('id');
                $('#delete-model-body').html(`
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        Xác nhận xóa người dùng?
                            <input type="hidden" name="id" value="${id}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" value="Xóa người dùng"></input>
                    </div>
                </form>
                `)
            })

        });

    </script>

@endsection