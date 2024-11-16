@extends('customer.layout')

@section('page_content')
<div class="main-content main-content-details single right-sidebar">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-trail breadcrumbs">
					<ul class="trail-items breadcrumb">
						<li class="trail-item trail-begin">
							<a href="index-2.html">Home</a>
						</li>
						<li class="trail-item">
							<a href="#">Accents</a>
						</li>
						<li class="trail-item trail-end active">
							Glorious Eau
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="content-area content-details col-lg-9 col-md-8 col-sm-12 col-xs-12">
				<div class="site-main">
					<div class="details-product" data-id="{{$product->id}}">
						<div class="details-thumd">
							<div class="image-preview-container image-thick-box image_preview_container">
								@php
									$images = explode(',', $product->images);
									$firstImage = asset($images[0]);
								@endphp
								<img id="img_zoom" data-zoom-image="{{ $firstImage }}" src="{{ $firstImage }}" alt="img">
								<a href="#" class="btn-zoom open_qv"><i class="fa fa-search" aria-hidden="true"></i></a>
							</div>
							
							<div class="product-preview image-small product_preview">
								<div id="thumbnails" class="thumbnails_carousel owl-carousel" data-nav="true" data-autoplay="false" data-dots="false" data-loop="false" data-margin="10" data-responsive='{"0":{"items":3},"480":{"items":3},"600":{"items":3},"1000":{"items":3}}'>
									@foreach($images as $image)
										@php $imagePath = asset(trim($image)); @endphp
										<a href="#" data-image="{{ $imagePath }}" data-zoom-image="{{ $imagePath }}" class="{{ $loop->first ? 'active' : '' }}">
											<img src="{{ $imagePath }}" data-large-image="{{ $imagePath }}" alt="img">
										</a>
									@endforeach
								</div>
							</div>					
						</div>
						<div class="details-infor">
							<h1 class="product-title">
								{{$product->name}}
							</h1>
							<div class="stars-rating">
								<div class="star-rating">
									<span class="star-5"></span>
								</div>
								<div class="count-star">
									(7)
								</div>
							</div>
							<div class="availability">
								availability:
								<a href="#">in Stock</a>
							</div>
							<div class="price">
								<span>{{ number_format($product->price, 0, ',', ',') }}₫</span>
							</div>
							<div class="product-details-description">
								<ul>
									<li>Vestibulum tortor quam</li>
									<li>Imported</li>
									<li>Art.No. 06-7680</li>
								</ul>
							</div>
							<div class="variations">
								<div class="attribute attribute_size">
									<div class="size-text text-attribute">
										Gender:
									</div>
									<div class="list-size list-item">
										@php
											$gender = $product->gender; // Assuming gender is 1, 2, or 3
											$genders = [
												1 => 'Male',
												0 => 'Female',
												2 => 'Unisex'
											];
										@endphp
										
										@foreach ($genders as $key => $value)
											<a href="#" class="{{ $gender == $key ? 'active' : '' }}">{{ $value }}</a>
										@endforeach
									</div>
								</div>
								<div class="attribute attribute_size selected_size">
									<div class="size-text text-attribute">
										Pots Size:
									</div>
                                    <div class="list-size list-item">
                                        @php
                                            $sizes = $product->productSizes ?? []; // Lấy kích thước sản phẩm
                                            $selectedSize = !empty($sizes) ? $sizes->first()->volume : null; // Kích thước đầu tiên
                                        @endphp
                                    
                                        @if (is_iterable($sizes) && count($sizes) > 0)
                                            @foreach ($sizes as $size)
												@php
													if ($size->quantity == 0) {
														continue;
													}
												@endphp
                                                <a href="#" class="{{ $size->volume == $selectedSize ? 'active' : '' }}" 
                                                   data-size-id="{{ $size->id }}" 
                                                   data-size-price="{{ $size->price }}">
                                                   {{ $size->volume }} ml
                                                </a>
                                            @endforeach
                                        @else
                                            <span>No sizes available</span>
                                        @endif
                                    </div>                                    
								</div>
							</div>
							<div class="group-button">
								<div class="yith-wcwl-add-to-wishlist">
									<div class="yith-wcwl-add-button">
										<a href="#">Add to Wishlist</a>
									</div>
								</div>
								<div class="size-chart-wrapp">
									<div class="btn-size-chart">
										<a id="size_chart" href="assets/images/size-chart.jpg" class="fancybox">View Size Chart</a>
									</div>
								</div>
								<div class="quantity-add-to-cart">
									<div class="quantity">
										<div class="control">
											<a class="btn-number qtyminus quantity-minus" href="#">-</a>
											<input type="text" data-step="1" data-min="0" value="1" title="Qty" class="input-qty qty" size="4">
											<a href="#" class="btn-number qtyplus quantity-plus">+</a>
										</div>
									</div>
									<button class="single_add_to_cart_button2 button">Add to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-details-product">
						<ul class="tab-link">
							<li class="active">
								<a data-toggle="tab" aria-expanded="true" href="#product-descriptions">Descriptions </a>
							</li>
							<li class="">
								<a data-toggle="tab" aria-expanded="true" href="#information">Information </a>
							</li>
							<li class="">
								<a data-toggle="tab" aria-expanded="true" href="#reviews">Reviews (212)</a>
							</li>
						</ul>
						<div class="tab-container">
							<div id="product-descriptions" class="tab-panel active">
								{!! $product->detail_description !!}
							</div>

                            <div id="information" class="tab-panel">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Thương hiệu</td>
                                        <td>{{$product->productAttributes[0]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Giới tính</td>
                                        <td>
											@php
												$gender = $product->gender;
												$genders = [
													1 => 'Nam',
													0 => 'Nữ',
													2 => 'Unisex'
												];
												echo $genders[$gender];
											@endphp
										</td>
                                    </tr>
                                    <tr>
                                        <td>Độ tuổi</td>
                                        <td>{{$product->productAttributes[6]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nồng độ</td>
                                        <td>{{$product->productAttributes[1]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phong cách</td>
                                        <td>{{$product->productAttributes[2]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nhóm hương</td>
                                        <td>{{$product->productAttributes[3]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Độ lưu hương</td>
                                        <td>{{$product->productAttributes[4]->attributeValue->value}}</td>
                                    </tr>
                                    <tr>
                                        <td>Độ tỏa hương</td>
                                        <td>{{$product->productAttributes[5]->attributeValue->value}}</td>
                                    </tr>

                                </table>
                            </div>
                            <div id="reviews" class="tab-panel">
                                <div class="reviews-tab">
                                    <div class="comments">
                                        <h2 class="reviews-title">
                                            11 review for
                                            <span>Glorious Eau</span>
                                        </h2>
                                        <div id="total-rating">
                                            <div class="row" style="display: flex; align-items: center; margin-bottom: 20px;">
                                                <div class="col-sm-6 col-md-6 col-xl-6" style="display: flex; justify-content: flex-end;">
                                                    <div style=" font-size: 25px; font-weight: bold; color: #ab8e66; ">4.9/5</div>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-xl-6">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                                            <div style="display: flex; align-items: center;">
                                                                <div class="star-rating">
                                                                    <span class="star-5"></span>
                                                                </div>
                                                                <div style="margin-left: 8px;">(200 reviews)</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                                            <div style="display: flex; align-items: center;">
                                                                <div class="star-rating">
                                                                    <span class="star-4"></span>
                                                                </div>
                                                                <div style="margin-left: 8px;">(10 reviews)</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                                            <div style="display: flex; align-items: center;">
                                                                <div class="star-rating">
                                                                    <span class="star-3"></span>
                                                                </div>
                                                                <div style="margin-left: 8px;">(2 reviews)</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                                            <div style="display: flex; align-items: center;">
                                                                <div class="star-rating">
                                                                    <span class="star-2"></span>
                                                                </div>
                                                                <div style="margin-left: 8px;">(0 reviews)</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-xl-12">
                                                            <div style="display: flex; align-items: center;">
                                                                <div class="star-rating">
                                                                    <span class="star-1"></span>
                                                                </div>
                                                                <div style="margin-left: 8px;">(0 reviews)</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-xl-4"></div>
                                            </div>
                                        </div>
										@if (!Auth::check())
											<div style="margin-bottom: 10px; cursor:pointer;" id="view-more-comments">
												<div style="border: 1px dotted;padding: 4px;text-align: center;font-weight: bold;font-size: 14px;color: #ab8e66;">Đăng nhập để đánh giá</div>
											</div>
										@else
											<div class="review_form_wrapper">
												<div class="review_form">
													<div class="comment-respond">
														<form class="comment-form-review">
															<div class="comment-form-rating">
																<label>Your rating</label>
																<p class="stars">
																		<span>
																			<a class="rating-star star-1" data-star-id="1" href="javascript:void(0)"></a>
																			<a class="rating-star star-2" data-star-id="2" href="javascript:void(0)"></a>
																			<a class="rating-star star-3" data-star-id="3" href="javascript:void(0)"></a>
																			<a class="rating-star star-4" data-star-id="4" href="javascript:void(0)"></a>
																			<a class="rating-star star-5" data-star-id="5" href="javascript:void(0)"></a>
																		</span>
																</p>
															</div>
															<p class="comment-form-comment">
																<label>
																	Your review
																	<span class="required">*</span>
																</label>
																<textarea title="review" id="comment-content" name="comment-content" cols="30" rows="2"></textarea>
															</p>
															<p class="form-submit">
																<input style="float: right;margin-top:-25px;margin-bottom:20px;" name="submit" type="submit" id="submit-comment" class="submit" value="Submit">
															</p>
														</form>
													</div>
												</div>
											</div>	
										@endif
                                        <ol class="commentlist" id="list-comments">
 {{--                                            <li class="conment">
                                                <div id="list-comments"></div>
                                                <div class="conment-container">
                                                    <a href="#" class="avatar">
                                                        <img src="https://placehold.co/60x59" alt="img">
                                                    </a>
                                                    <div class="comment-text">
                                                        <div class="stars-rating">
                                                            <div class="star-rating">
                                                                <span class="star-5"></span>
                                                            </div>
                                                            <div class="count-star">
                                                                (1)
                                                            </div>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="author">Quyền 3</strong>
                                                            <span>-</span>
                                                            <span class="time">8/10/2024</span>
                                                        </p>
                                                        <div class="description">
                                                            <p>perfect!</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </li> --}}
{{-- 											<div style="margin-bottom: 10px; cursor:pointer;" id="view-more-comments">
												<div style="border: 1px dotted;padding: 4px;text-align: center;font-weight: bold;font-size: 14px;color: #ab8e66;">Xem thêm</div>
											</div> --}}
                                        </ol>
                                    </div>

                                </div>
                            </div>
						</div>
					</div>
					<div style="clear: left;"></div>
					<div class="related products product-grid">
						<h2 class="product-grid-title">You may also like</h2>
						<div class="owl-products owl-slick equal-container nav-center"  data-slick ='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":3}},{"breakpoint":"1200","settings":{"slidesToShow":2}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
							@if ($similar_products->isNotEmpty())
								@foreach ($similar_products as $sp)
									<div class="product-item style-1" data-id="{{$sp['id']}}" data-id-size="{{$sp['product_size_id']}}" data-size="{{$sp['size']}}">
										<div class="product-inner equal-element">
											<div class="product-top">
												<div class="flash">
															<span class="onnew">
																<span class="text">
																	Trending
																</span>
															</span>
												</div>
											</div>
											<div class="product-thumb">
												<div class="thumb-inner">
													<a href="/nuoc-hoa/{{$sp['slug']}}">
														<img src="/{{$sp['image']}}" alt="img">
													</a>
													<div class="thumb-group">
														<div class="yith-wcwl-add-to-wishlist">
															<div class="yith-wcwl-add-button">
																<a href="#">Add to Wishlist</a>
															</div>
														</div>
														<a href="#" class="button quick-wiew-button">Quick View</a>
														<div class="loop-form-add-to-cart">
															<button class="single_add_to_cart_button button">Add to cart
															</button>
														</div>
													</div>
												</div>
											</div>
											<div class="product-info">
												<h5 class="product-name product_title">
													<a href="/nuoc-hoa/{{$sp['slug']}}">{{$sp['name']}}</a>
												</h5>
												<div class="group-info">
													<div class="stars-rating">
														<div class="star-rating">
															<span class="star-5"></span>
														</div>
														<div class="count-star">
															(3)
														</div>
													</div>
													<div class="price">
														<del>
															{{$sp['price']}}
														</del>
														<ins>
															{{$sp['discounted_price']}}
														</ins>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="sidebar sidebar-details col-lg-3 col-md-4 col-sm-12 col-xs-12">
				<div class="wrapper-sidebar">
					<div class="widget widget-categories">
						<h3 class="widgettitle">Policy</h3>
						<ul class="list-categories" style="border: dotted 1px #ccc; padding: 10px; list-style: none;">
							<img src="https://xuongsiquanao.vn/wp-content/uploads/2024/07/chinh-sach-doi-tra-ban-si-quan-ao-online.jpg" alt="" srcset="">
							<li style="display: flex; align-items: center; margin-bottom: 5px;">
								<i class="fa fa-check-square-o" aria-hidden="true" style="color: #ab8e66;"></i>
								<label for="cb1" class="label-text" style="color: #ab8e66;">
									Miễn phí đổi trả trong 7 ngày
								</label>
							</li>
							<li style="display: flex; align-items: center; margin-bottom: 5px;">
								<i class="fa fa-check-square-o" aria-hidden="true" style="color: #ab8e66;"></i>
								<label for="cb2" class="label-text" style="color: #ab8e66;">
									Kiểm tra hàng trước khi nhận
								</label>
							</li>
							<li style="display: flex; align-items: center;">
								<i class="fa fa-check-square-o" aria-hidden="true" style="color: #ab8e66;"></i>
								<label for="cb3" class="label-text" style="color: #ab8e66;">
									Cam kết hàng giả hoàn tiền
								</label>
							</li>
						</ul>
					</div>
					<div class="widget widget-testimonials">
						<h3 class="widgettitle">Testimonials</h3>
						<div class="slider-related-products owl-slick nav-top-right"  data-slick ='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"991","settings":{"slidesToShow":1 }}]'>
							<div class="testimonials-item">
								<div class="Testimonial-inner">
									<div class="comment">
										My family and relatives have been using BKeShop products for 5 years and I highly appreciate these products. This is always my first choice!
									</div>
									<div class="author">
										<div class="avt">
											<img src="/customer/page/images/user_avatar.jpeg" alt="img">
										</div>
										<h3 class="name">
											Mr. PFP
											<span class="position">
													CEO/Founder PerfumePro
												</span>
										</h3>

									</div>
								</div>
							</div>
							<div class="testimonials-item">
								<div class="Testimonial-inner">
									<div class="comment">
										Donec ligula mauris, posuere sed tincidunt a, facilisis id enim. Class aptent taciti sociosqu ad litora torquent per conubia.
									</div>
									<div class="author">
										<div class="avt">
											<img src="/customer/page/images/user_avatar.jpeg" alt="img">
										</div>
										<h3 class="name">
											Tom Milikin
											<span class="position">
													CEO/Founder Apple
												</span>
										</h3>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="widget widget-related-products">
						<h3 class="widgettitle">Related Products</h3>
						<div class="slider-related-products owl-slick nav-top-right equal-container"  data-slick ='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}' data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1 }},{"breakpoint":"992","settings":{"slidesToShow":2}}]'>
							{{-- DÙng only nên trả về mảng--}}
							@if($related_products->isNotEmpty())
								@foreach ($related_products as $rp)
									<div class="product-item style-1" data-id="{{$rp['id']}}" data-id-size="{{$rp['product_size_id']}}" data-size="{{$rp['size']}}">
										<div class="product-inner equal-element">
											<div class="product-top">
												<div class="flash">
															<span class="onnew">
																<span class="text">
																	new
																</span>
															</span>
												</div>
											</div>
											<div class="product-thumb">
												<div class="thumb-inner">
													<a href="#">
														<img src="{{$rp['image']}}" alt="img">
													</a>
													<div class="thumb-group">
														<div class="yith-wcwl-add-to-wishlist">
															<div class="yith-wcwl-add-button">
																<a href="#">Add to Wishlist</a>
															</div>
														</div>
														<a href="#" class="button quick-wiew-button">Quick View</a>
														<div class="loop-form-add-to-cart">
															<button class="single_add_to_cart_button button">Add to cart
															</button>
														</div>
													</div>
												</div>
											</div>
											<div class="product-info">
												<h5 class="product-name product_title">
													<a href="#">{{$rp['name']}}</a>
												</h5>
												<div class="group-info">
													<div class="stars-rating">
														<div class="star-rating">
															<span class="star-5"></span>
														</div>
														<div class="count-star">
															(3)
														</div>
													</div>
													<div class="price">
														<del>
															{{number_format($rp['price'], 0, ',', '.')}}₫
														</del>
														<ins>
															{{number_format($rp['discounted_price'], 0, ',', '.')}}₫
														</ins>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@else
								<p>No related products found.</p>
							@endif
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('page_js')
	
	<script src="{{asset('customer/page/js/api.js')}}"></script>
	<script src="{{asset('customer/page/js/product_detail.js')}}"></script>
@endsection