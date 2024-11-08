@extends('manager.layout')

@section('page_title', 'Tài chính')
@section('page_css')
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_assets/page/css/order.css')}}" rel="stylesheet">

    <link href="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection

@section('page_content')
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative" id="notification">
            <div class="media align-center justify-content-between m-b-15 w-100">
                <div class="m-l-15">
                    <h4 class="m-b-0">Tài chính</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="ok m-b-75">
                <button class="btn btn-primary m-r-5 float-right" id="export-excel">
                    <i class="fas fa-file-excel m-r-5"></i>
                    <span> Xuất file</span>
                </button>
                <button class="btn btn-default m-r-5 float-right" id="question-ans" data-toggle="modal" data-target=".bd-example-modal-lg" style="cursor: pointer">
                    <i class="anticon anticon-info-circle"></i>
                    <span> Giải thích thuật ngữ</span>
                </button>
            </div>
            <div class="row m-b-10">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <div><h3 class="font-weight-bold m-b-20" style="display:flex;justify-content:center;">1/11/2024 - 30/11/2024</h3></div>
                        <div class="row">
                            <div class="col-sm-2">
                                <!-- Default Datepicker-->
                                <div class="form-group">
                                    <div class="input-affix m-b-10">
                                        <i class="prefix-icon anticon anticon-calendar"></i>
                                        <input type="text" class="form-control datepicker-input" placeholder="Từ ngày">
                                    </div>
                                </div>
                            </div>
                            -
                            <div class="col-sm-2">
                                <!-- Default Datepicker-->
                                <div class="form-group">
                                    <div class="input-affix m-b-10">
                                        <i class="prefix-icon anticon anticon-calendar"></i>
                                        <input type="text" class="form-control datepicker-input" placeholder="Đến ngày">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-2">
                                <button id="filter_financial" class="btn btn-success m-l-5"><i class="fas fa-file-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="font-size-15">
                                    <th class="font-weight-bold">CHỈ TIÊU BÁO CÁO</th>
                                    <th class="font-weight-bold">KỲ TRƯỚC</th>
                                    <th class="font-weight-bold">KỲ HIỆN TẠI</th>
                                    <th class="font-weight-bold">THAY ĐỔI </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dòng 1 -->
                                <tr class="table-info">
                                    <td class="font-weight-bold">I. Doanh Thu Bán Hàng (1+2+3-4)</td>
                                    <td id="pre_1" >9,250,000</td>
                                    <td id="now_1">16,300,000</td>
                                    <td id="rate1">+44%</td>
                                </tr>
        
                                <!-- Dòng 1.1 -->
                                <tr>
                                    <td class="ml-4"> 1. Tiền Hàng Thực Bán (1a-1b)</td>
                                    <td id="pre_2">9,250,000</td>
                                    <td id="now_2">16,300,000</td>
                                    <td id="rate2">+44%</td>
                                </tr>
        
                                <!-- Dòng 1.1.1 -->
                                <tr>
                                    <td class="ml-5"> a. Tiền Hàng Bán Ra</td>
                                    <td id="pre_3">12,500,000</td>
                                    <td id="now_3">17,800,000</td>
                                    <td id="rate3">+30%</td>
                                </tr>
        
                                <!-- Dòng 1.1.2 -->
                                <tr>
                                    <td class="ml-5"> b. Tiền Hàng Trả Lại</td>
                                    <td id="pre_4">3,250,000</td>
                                    <td id="now_4">1,500,000</td>
                                    <td id="rate4">-54%</td>
                                </tr>
        
                                <tr>
                                    <td> 2. Thuế VAT</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> 3. Phí giao hàng thu của khách</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> 4. Chiết khấu</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
        
                                <!-- ...Thêm các dòng khác tương tự... -->
        
                                <!-- Dòng 2 -->
                                <tr class="table-info">
                                    <td class="font-weight-bold">II. Chi Phí Bán Hàng (1+2+3)</td>
                                    <td id="pre_5">5,675,000</td>
                                    <td id="now_5">8,035,000</td>
                                    <td id="rate5">+30%</td>
                                </tr>
                                <tr>
                                    <td> 1. Chi phí giá vốn hàng hóa</td>
                                    <td id="pre_6">5,250,000</td>
                                    <td id="now_6">7,300,000</td>
                                    <td id="rate6">+28%</td>
                                </tr>
                                <tr>
                                    <td> 2. Phí giao hàng trả đối tác</td>
                                    <td id="pre_7">425,000</td>
                                    <td id="now_7">735,000</td>
                                    <td id="rate7">+42%</td>
                                </tr>
                                <tr>
                                    <td> 3. Thanh toán bằng điểm</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
        
                                <!-- ...Thêm các dòng khác tương tự... -->
        
                                <!-- Dòng 3 -->
                                <tr class="table-info">
                                    <td class="font-weight-bold">III. Thu Nhập Khác (1+2)</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> 1. Phiếu thu</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> 2. Phí khách trả hàng</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
        
                                <!-- ...Thêm các dòng khác tương tự... -->
        
                                <!-- Dòng 4 -->
                                <tr class="table-info">
                                    <td class="font-weight-bold">IV. Chi Phí Khác</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td> 1. Phiếu chi</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
        
                                <!-- ...Thêm các dòng khác tương tự... -->
        
                                <!-- Dòng 5 -->
                                <tr class="table-warning font-weight-bold">
                                    <td>Lợi Nhuận (I + III - II - IV)</td>
                                    <td id="pre_9">3,575,000</td>
                                    <td id="now_9">8,265,000</td>
                                    <td id="rate_9">+57%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        
        
        
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Giải thích thuật ngữa-->
    <div class="modal fade bd-example-modal-lg">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4">Giải thích thuật ngữ</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="table-info">
                                    <th scope="col">#</th>
                                    <th scope="col">Thuật ngữ</th>
                                    <th scope="col">Giải thích</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Doanh thu bán hàng</td>
                                    <td>
    
                                        Là số tiền cửa hàng thu được từ khách hàng trên mỗi đơn hàng.
                                        <br>
                                        - Với đơn hàng Chưa bao gồm thuế:
                                        <br>
                                        <strong>Doanh thu = Tiền hàng thực bán + Thuế VAT (nếu có) + Phí giao hàng thu của
                                            khách (nếu có) - Chiết khấu giảm giá cho khách hàng</strong>
                                        <br>
                                        - Với đơn hàng Đã bao gồm thuế:
                                        <br>
                                        <strong>Doanh thu = Tiền hàng thực bán + Phí giao hàng thu của khách (nếu có) -
                                            Chiết khấu giảm giá cho khách hàng</strong>
    
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Tiền hàng thực bán</td>
                                    <td>
    
                                        <div class="explain">
                                            Tiền hàng thực bán là giá trị hàng hoá thực sự bán được (sau khi đã trừ vì
                                            khách trả hàng). Cụ thể:
                                            <strong>- Tiền hàng thực bán = Tiền hàng bán ra - Tiền hàng trả lại</strong>
                                            <strong>- Tiền hàng bán ra</strong> = Số lượng sản phẩm * Đơn giá bán trên
                                            mỗi đơn hàng
                                            <strong>- Tiền hàng trả lại</strong> = Giá trị hàng bán bị trả lại trên đơn trả
                                            hàng (sau khi
                                            đã tách thuế VAT)
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Thuế VAT</td>
                                    <td>Thuế thu của khách hàng trên mỗi đơn hàng. Thuế VAT sẽ giảm nếu khách hàng trả hàng.
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Phí giao hàng thu của khách</td>
                                    <td>Là khoản phí thu của khách làm tăng giá trị đơn hàng. Khoản phí này thu để chi trả
                                        phí vận chuyển của
                                        đối tác giao hàng</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Chiết khấu</td>
                                    <td>Là tổng chiết khấu, giảm giá trên mỗi đơn hàng, gồm cả chiết khấu cho mỗi sản phẩm
                                        và chiết khấu
                                        của tổng đơn (nếu có)</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Chi phí giá vốn hàng hoá</td>
                                    <td>
                                        <div class="explain">
                                            Là giá vốn của hàng hoá tính = Số lượng hàng được xuất kho * Giá vốn
                                            Nếu khách trả hàng thì chi phí giá vốn sẽ giảm đi = Số lượng hàng bán bị trả lại
                                            * Giá nhập lại vào kho
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Thanh toán bằng điểm</td>
                                    <td>Khách hàng thanh toán đơn hàng bằng điểm (Số tiền quy đổi từ điểm ra tiền)</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Phí giao hàng trả đối tác</td>
                                    <td>Khoản tiền cửa hàng bỏ ra cho việc vận chuyển (phí trả shiper, phí trả giao hàng
                                        nhanh)</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Phiếu thu khác hạch toán kết quả kinh doanh</td>
                                    <td>
                                        <div class="explain">
                                            Là các khoản thu được ghi nhận từ các phiếu thu tự tạo có hạch toán kết quả kinh
                                            doanh và khoản thu từ phiếu yêu cầu bảo hành (nếu có).
                                            Bạn có thể ấn để mở rộng và hiển thị chi tiết khoản thu theo từng Loại phiếu thu
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Phí khách trả hàng</td>
                                    <td>
                                        <div class="explain">
                                            Là khoản chênh lệch tiền khi khách hàng đem trả hàng, khoản chênh này được coi
                                            như khoản phí khách chịu khi trả hàng
                                            <strong>Phí khách trả hàng = Giá trị hàng bán bị trả lại - Tiền hoàn trả lại cho
                                                khách</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Phiếu chi khác hạch toán kết quả kinh doanh</td>
                                    <td>
                                        <div class="explain">
                                            Là các khoản chi được ghi nhận từ các phiếu chi tự tạo có hạch toán kết quả kinh
                                            doanh.
                                            Bạn có thể ấn để mở rộng và hiển thị chi tiết khoản thu theo từng <strong>Loại
                                                phiếu chi</strong></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Lợi nhuận</td>
                                    <td>
                                        <div class="explain">
                                            Là khoản lãi thực tế của cửa hàng, dựa trên chênh lệch của các khoản thu và các
                                            khoản chi
                                            <strong>Lợi nhuận = Doanh thu bán hàng + Thu nhập khác - Chi phí bán hàng - Chi
                                                phí khác</strong>
                                        </div>
                                    </td>
                                </tr>
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


    <script src="{{asset('admin_assets/assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/js/pages/e-commerce-order-list.js')}}"></script>

    <script src="{{asset('admin_assets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('.datepicker-input').datepicker();
    </script>
    
    <script src="{{asset('admin_assets/page/js/api.js')}}"></script>

@endsection