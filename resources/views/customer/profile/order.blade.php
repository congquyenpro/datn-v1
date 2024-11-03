@extends('customer.profile.layout') 

@section('css')
<style>
    .tab-pane {
        display: none; /* Hide all tab content by default */
    }
    .tab-pane.show {
        display: block; /* Show the active tab */
    }
</style>
@endsection
@section('profile-content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Lịch sử mua hàng</h4>
        <hr>
        <ul class="nav nav-tabs nav-justified" id="myTabJustified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-justified" data-toggle="tab" href="#home-justified" role="tab" aria-controls="home-justified" aria-selected="true" data-status-id="0">Chờ xác nhận</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-justified" data-toggle="tab" href="#profile-justified" role="tab" aria-controls="profile-justified" aria-selected="false" data-status-id="1">Đã xác nhận</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shipping-tab-justified" data-toggle="tab" href="#shipping-justified" role="tab" aria-controls="shipping-justified" aria-selected="false" data-status-id="3">Chờ giao hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="in-progress-tab-justified" data-toggle="tab" href="#in-progress-justified" role="tab" aria-controls="in-progress-justified" aria-selected="false" data-status-id="4">Đang giao</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="completed-tab-justified" data-toggle="tab" href="#completed-justified" role="tab" aria-controls="completed-justified" aria-selected="false" data-status-id="5">Đã giao</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="canceled-tab-justified" data-toggle="tab" href="#canceled-justified" role="tab" aria-controls="canceled-justified" aria-selected="false" data-status-id="6">Đã hủy</a>
            </li>
        </ul>
        <div class="tab-content m-t-15" id="myTabContentJustified">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab-justified">
                <div id="order-status-0" style="margin-top:5px"><p>Không có đơn hàng nào</p></div>
            </div>
            <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab-justified">
                <div id="order-status-1" style="margin-top:5px">Không có đơn hàng nào</div>
            </div>
            <div class="tab-pane fade" id="shipping-justified" role="tabpanel" aria-labelledby="shipping-tab-justified">
                <div id="order-status-2" style="margin-top:5px"><p>Không có đơn hàng nào</p></div>
            </div>
            <div class="tab-pane fade" id="in-progress-justified" role="tabpanel" aria-labelledby="in-progress-tab-justified">
                <div id="order-status-4" style="margin-top:5px"><p>Không có đơn hàng nào</p></div>
            </div>
            <div class="tab-pane fade" id="completed-justified" role="tabpanel" aria-labelledby="completed-tab-justified">
                <div id="order-status-5" style="margin-top:5px"><p>Không có đơn hàng nào</p></div>
            </div>
            <div class="tab-pane fade" id="canceled-justified" role="tabpanel" aria-labelledby="canceled-tab-justified">
                <div id="order-status-6" style="margin-top:5px"><p>Không có đơn hàng nào</p></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Activate the 'Tất cả' tab on page load
        $('#home-tab-justified').tab('show');

        // Ensure only one tab is displayed at a time
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            // Remove 'show' class from all tabs
            $('.tab-pane').removeClass('show active');
            // Add 'show' and 'active' classes to the current tab
            var target = $(e.target).attr("href");
            $(target).addClass('show active');
        });
    });
</script>
<script src="{{asset('customer/page/js/order-history.js')}}"></script>
@endsection
