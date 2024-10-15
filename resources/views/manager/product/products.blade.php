@extends('manager.layout')
@section('page_title', 'Sản phẩm')
@section('page_css')
<link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Sản phẩm</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Quản lý sản phẩm</a>
                <span class="breadcrumb-item active">Sản phẩm</span>
            </nav>
        </div>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Sản phẩm</span>
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
                            <th>Thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Phân loại</th>
                            <th>Trending</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>

                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #31
                            </td>
                            <td>Nước hoa province</td>
                            <td>Luis Vuitton</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="assets/images/others/thumb-9.jpg" style="border: dotted 1px #f0069d;max-width: 60px" alt="">
                                </div>
                            </td>
                            <td>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                                <div class="metadata-table-wrapper">
                                    <span class="badge badge-pill badge-blue m-r-10">Kích thước: 100 ml</span>
                                    <span class="badge badge-pill badge-green m-r-10">Đơn giá: 50,000</span>
                                    <span class="badge badge-pill badge-orange m-r-10">Giảm giá: 50 %</span>
                                    <span class="badge badge-pill badge-red m-r-10">SL: 753</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input type="checkbox" id="switch-fb" checked="">
                                        <label for="switch-fb"></label>
                                    </div>
                                </div>
                            </td>

                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-eye"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Add -->
    <div class="modal fade bd-example-modal-xl">
        <div class="modal-dialog modal-dialog-scrollable" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Thêm sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <form>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Tên sản phẩm*</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                                </div>
                                <div class="form-group">
                                    <div class="row" style=" display: block;">
                                        <label class="col-form-label col-sm-2 pt-0">Trạng thái</label>
                                        
                                        <div class="col-sm-10" style=" display: flex;">
                                            <div class="radio m-r-50">
                                                <input type="radio" name="status" id="status4" value="option1" checked>
                                                <label for="status4">
                                                    Công khai
                                                </label>
                                            </div>
                                            <div class="radio m-r-50">
                                                <input type="radio" name="status" id="status5" value="option2">
                                                <label for="status5">
                                                    Ẩn
                                                </label>
                                            </div>
                                            <div class="radio m-r-50">
                                                <input type="radio" name="status" id="status6" value="option3">
                                                <label for="status6">
                                                    Hết hàng
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Thương hiệu*</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Luis Vuitton</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row" style=" display: block;">
                                        <label class="col-form-label col-sm-2 pt-0">Giới tính*</label>
                                        
                                        <div class="col-sm-10" style=" display: flex;">
                                            <div class="radio m-r-50">
                                                <input type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                <label for="gridRadios1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="radio m-r-50">
                                                <input type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                                <label for="gridRadios2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="radio m-r-50">
                                                <input type="radio" name="gridRadios" id="gridRadios3" value="option3">
                                                <label for="gridRadios3">
                                                    Unisex
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn <span class="data-description-return"></span></label>
                                    <textarea class="form-control data-description " name="description" placeholder="Mô tả ngắn" rows="4" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết đặc tính <span class="data-description-return"></span></label>
                                    <div class="metadata-item" style=" padding: 1rem; border: dotted 2px #1391c3; ">
                                        <div class="form-group">
                                            <label>Nồng độ</label>
                                            <input type="text" class="form-control data-nongdo" placeholder="">
                                        </div> 
                                        <div class="form-group">
                                            <label>Phong cách</label>
                                            <input type="text" class="form-control data-style" placeholder="">
                                        </div> 
                                        <div class="form-group">
                                            <label>Nhóm hương</label>
                                            <input type="text" class="form-control data-perfume" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Độ tuổi</label>
                                            <input type="text" class="form-control data-agegroup" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Thành phần</label>
                                            <input type="text" class="form-control data-ingredient" placeholder="">
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả chi tiết <span class="data-description-return"></span></label>
                                    <textarea id="summernote" name="editordata"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm* (600x600) <span class="data-description-return"></span></label>   
                                <div class="image-item" style=" padding: 1rem; border: dotted 2px #1391c3; ">
                                    <div class="custom-file" style="display: none;">
                                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" multiple>
                                        <label class="custom-file-label" for="customFile">Choose files</label>
                                    </div>
                                    <button class="btn btn-info btn-tone m-r-5" id="uploadButton">
                                        <i class="anticon anticon-file-add"></i>
                                    </button>
                                    
                                    <!-- Container để hiển thị ảnh preview -->
                                    <div id="previewContainer" style="margin-top: 20px; display: flex; flex-wrap: wrap;"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-tone m-r-5 m-b-20" id="addItemButton">Thêm phân loại</button>
                                <div>
                                    <div class="row g-2" id="itemContainer"> <!-- Thêm g-2 để tạo khoảng cách giữa các cột -->
                                        <div class="col-md-6 col-sm-12 m-b-15">
                                            <div class="metadata-item p-3 border border-dotted" style="border-color: #1391c3;">
                                                <div class="form-group">
                                                    <label>Dung lượng *</label>
                                                    <input type="text" class="form-control data-size number-type" placeholder="ml">
                                                </div>
                                                <div class="form-group">
                                                    <label>Đơn giá *</label>
                                                    <input type="text" class="form-control data-prices number-type" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Giảm giá *</label>
                                                    <input type="text" class="form-control data-discount number-type" placeholder="%">
                                                </div>
                                                <div class="form-group">
                                                    <label>Số lượng * (Mặc định 0)</label>
                                                    <input type="text" class="form-control data-quantity number-type" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-danger metadata-remove" atr="Delete">Xóa thuộc tính</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('page_js')
<script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>




@endsection
