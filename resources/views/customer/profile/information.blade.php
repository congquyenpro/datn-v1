@extends('customer.profile.layout') 

@section('profile-content')
<div class="card" id="user-information">
    <div class="card-body">
      <h4 class="card-title">Chỉnh sửa thông tin thành viên</h4>
      <!-- <p class="card-text">Some example text. Some example text.</p> -->
      <hr>
      <div class="form-edit" style="padding: 3rem;">
        <div class="row">
            <div class="col-sm-12 col-md-8">

                <form action="{{route('customer.profile.update')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Họ tên" value="{{$user_info['name']}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{$user_info['email']}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-3 col-form-label">Địa chỉ</label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <!-- select -->
                            <select class="form-control" id="province" name="province" style="height: 42px;border-radius: 30px;margin-bottom:5px;">
                                <option selected>Hà Nội</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <!-- select -->
                            <select class="form-control" id="district" name="district" style="height: 42px;border-radius: 30px;margin-bottom:5px;">
                                <option selected>Quận Hai Bà Trưng</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <!-- select -->
                            <select class="form-control" id="ward" name="ward" style="height: 42px;border-radius: 30px;margin-bottom:5px;">
                                <option selected>Phường Lê Đại Hành</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-sm-9" style="margin-top: 15px;">
                            <input type="text" class="form-control" placeholder="Địa chỉ tiết" id="detail_address" name="detail_address" required>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3 pt-0">Giới tính</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="gender" name="gender" style="height: 42px;border-radius: 30px;">
                                @php
                                    $gender = $user_info['gender'];
                                @endphp
                                <option value="1" {{ $gender == 1 ? 'selected' : '' }}>Nam</option>
                                <option value="0" {{ $gender == 0 ? 'selected' : '' }}>Nữ</option>
                                <option value="2" {{ $gender == 2 ? 'selected' : '' }}>Unisex</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputBirthYear" class="col-sm-3 col-form-label">Năm sinh</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputBirthYear" name="birth_year" placeholder="yyyy" required value="{{$user_info['birthday']}}">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: end;">
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </form>
                
            </div>
            <div class="col-sm-12 col-md-4" style="margin-top: 4rem;">
                <div class="rounded" style=" display: flex; justify-content: center;">      
                    <img src="https://openseauserdata.com/files/e597b67ffc073521926db6cfd28af7ff.jpg" style="border-radius: 50%;" alt="Cinque Terre" width="50%" height="236"> 
                </div>
                <div class="form-group">
                    <div style="display: flex; justify-content: center; margin-top: 1rem;">
                        <input type="file" class="form-control" id="inputAvatar">
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>
</div>
@endsection