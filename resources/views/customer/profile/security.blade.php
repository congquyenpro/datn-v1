@extends('customer.profile.layout') 

@section('profile-content')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Thay đổi mật khẩu</h4>
      <!-- <p class="card-text">Some example text. Some example text.</p> -->
      {{-- Thông báo lỗi haowjc thành công --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
  
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
      <hr>
      <div class="form-edit" style="padding: 3rem;">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <form method="POST" action="{{route('customer.profile.security.update')}}">
                    @csrf  <!-- Include this if you're using Laravel to protect against CSRF attacks -->
                    
                    <div class="form-group row">
                        <label for="oldPassword" class="col-sm-4 col-form-label">Mật khẩu hiện tại</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="oldPassword" name="old_password" placeholder="Old password" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-4 col-form-label">Mật khẩu mới</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="New password" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="confirmPassword" class="col-sm-4 col-form-label">Xác nhận mật khẩu</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm password" required>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: end;">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </form>
                

            </div>
        </div>
      </div>
    </div>
</div>
    
@endsection