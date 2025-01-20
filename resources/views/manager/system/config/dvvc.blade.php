<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5>Đơn vị vận chuyển</h5>
                <br>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-h-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-icon" style="color: #005ef7; background: rgba(0, 94, 247, 0.1)">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="font-size-15 font-weight-semibold m-l-15">Giao hàng nhanh (GHN)</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="switch m-t-5 m-l-10">
                                    <input type="checkbox" id="switch-inst" checked="">
                                    <label for="switch-inst"></label>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item p-h-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-icon" style="color: #fff; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%)">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="font-size-15 font-weight-semibold m-l-15">Giao hàng tiết kiệm (GHTK)</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="switch m-t-5 m-l-10">
                                    <input type="checkbox" id="switch-db">
                                    <label for="switch-db"></label>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item p-h-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-icon" style="color: #fff; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #d81f0f 45%,#2c4cda 60%,#a3abc4 90%)">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="font-size-15 font-weight-semibold m-l-15">Vận chuyển ngoài</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="switch m-t-5 m-l-10">
                                    <input type="checkbox" id="switch-db2" checked="">
                                    <label for="switch-db2"></label>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <ul class="nav nav-tabs flex-column" id="myTabVertical" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-vertical" data-toggle="tab" href="#home-vertical" role="tab" aria-controls="home-vertical" aria-selected="true">GHN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-vertical" data-toggle="tab" href="#profile-vertical" role="tab" aria-controls="profile-vertical" aria-selected="false">GHTK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab-vertical" data-toggle="tab" href="#contact-vertical" role="tab" aria-controls="contact-vertical" aria-selected="false">Khác</a>
                        </li>
                    </ul>
                
                    <div class="tab-content m-l-15" id="myTabContentVertical">
                        <div class="tab-pane fade show active" id="home-vertical" role="tabpanel" aria-labelledby="home-tab-vertical">
                            <form action="{{route('manager.config.shipping')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="formGroupExampleInput">GHN Shop ID</label>
                                    <input type="text" class="form-control" name="shop_id" placeholder="Nhập ID shop" value="{{$shippingConfig[0]['detail']}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">GHN Token</label>
                                    <input type="password" class="form-control" name="token" placeholder="Nhập token" required>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Mã xác nhận</label>
                                    <input type="password" class="form-control" name="verify_code" placeholder="Nhập mã xác nhận" required>
                                </div>   
                                <input type="hidden" class="form-control" name="code" value="GHN">
                                                                              
                                
                                <div class="form-group">
                                    <button class="btn btn-primary float-right m-l-5" type="submit">Lưu</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="profile-vertical" role="tabpanel" aria-labelledby="profile-tab-vertical">
                            <form>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">GHTK Token</label>
                                    <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Nhập token"  disabled>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Mã xác nhận</label>
                                    <input type="password" class="form-control" id="formGroupExampleInput" placeholder="Nhập token"  disabled>
                                </div>                                                              
                                
                                <div class="form-group">
                                    {{-- <button class="btn btn-primary float-right m-l-5" type="submit">Lưu</button> --}}
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="contact-vertical" role="tabpanel" aria-labelledby="contact-tab-vertical">
                            - Đối với các đơn vị chưa kết nối, người bán nhập thủ công thông tin vận chuyển
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>