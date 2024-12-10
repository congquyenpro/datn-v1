@extends('customer.layout')

@section('page_content')
<div class="site-content">
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin">
                        <a href="#">
								<span>
									Home
								</span>
                        </a>
                    </li>
                    <li class="trail-item trail-end active">
							<span>
								Cart
							</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="main-content-cart main-content col-sm-12">
                    <h3 class="custom_blog_title">
                        Cart
                    </h3>
                    <div class="page-main-content">
                        <div class="shoppingcart-content">
                            <form action="https://dreamingtheme.kiendaotac.com/html/stelina/shoppingcart.html" class="cart-form">
                                <table class="shop_table">
                                    <thead>
                                    <tr>
                                        <th class="product-remove"></th>
                                        <th class="product-thumbnail"></th>
                                        <th class="product-name"></th>
                                        <th class="product-price"></th>
                                        <th class="product-quantity"></th>
                                        <th class="product-subtotal"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-items">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <div class="coupon">
                                                    <label class="coupon_code">Coupon Code:</label>
                                                    <input type="text" class="input-text" placeholder="Promotion code here">
                                                    <a href="#" class="button">Apply Coupon</a>
                                                </div>
                                                <div class="order-total">
                                                    <span class="title">Total Price:</span>
                                                    <span class="total-price" id="total-price">
                                                        <!-- Tổng giá sẽ hiển thị ở đây -->
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    
                                    <div id="total-price2"></div>
                                </table>
                            </form>
                            <div class="control-cart">
                                <a href="/shop" class="button btn-continue-shopping">
                                    Continue Shopping
                                </a>
                                <a href="{{route('customer.checkout')}}" class="button btn-cart-to-checkout">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('page_js')
    <script src="{{asset('customer/page/js/api.js')}}"></script>
    <script src="{{asset('customer/page/js/shopping_cart.js')}}"></script>

    <script src="{{asset('customer/page/js/cart2.js')}}"></script>
@endsection