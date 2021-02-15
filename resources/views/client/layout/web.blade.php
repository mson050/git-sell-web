<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		{{-- invoice --}}
		<link rel="stylesheet" href="/invoice/style.css">
		
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="/store/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="/store/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="/store/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="/store/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="/store/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="/store/css/style.css"/>
		
		{{-- sweetalert css --}}
		<link rel="stylesheet" type="text/css" href="/store/css/sweetalert.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +84 936038962</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> sonnguyen050@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						@if(!Auth::check())
						<li><a href=" {{ route("auth.login")}} "><i class="fa fa-sign-in"></i> Đăng nhập </a></li>
						<li><a href=" {{ route("auth.register")}} "><i class="fa fa-user-o"></i> Đăng ký </a></li>
						@else
						<li><a href=""><i class="fa fa-user-o"></i> {{Auth::user()->fullname}} </a></li>
						<li><a href="{{ route("auth.logout")}}"><i class="fa fa-user-o"></i> Đăng xuất </a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="../../store/img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form method="GET" action="">
									<select class="input-select">
										<option value="0">Tất cả</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" type="text" name="keyword" value="{{ request()->input('keyword') }}" placeholder="Search here">
									<button type="submit" class="search-btn">Tìm kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<div>
										<a href="{{Auth::check()?route('order.layout',Auth::user()->id):"#"}}">
											<i class="fa fa-id-card-o"></i>
											<span>Đơn hàng</span>
										</a>
									</div>
								</div>
							
								<!-- /Wishlist -->

								<!-- Cart -->
								<div id="change-items-cart">
									@php
										$cart = session()->get('cart');
										$cartInfo = session()->get('cartInfo');
									@endphp
									<div class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
											<i class="fa fa-shopping-cart"></i>
											<span>Giỏ hàng</span>
											<div class="qty">{{isset($cartInfo) ? $cartInfo['totalQty'] : 0}}</div>
										</a>
										<div class="cart-dropdown">
											<div class="cart-list">
												@if (isset($cart))
														@foreach ($cart as $item)
														<div class="product-widget">
															<div class="product-img">
																<img src="/uploads/images/{{ $item['image'] }}" alt="">
															</div>
															<div class="product-body">
																<h3 class="product-name"><a href="#"> {{$item['name']}} </a></h3>
																<h4 class="product-price"><span class="qty"> {{$item['qty']}} X </span>{{ number_format($item['price']) }} </h4>
															</div>
															<button class="delete" data-id="{{$item['id']}}"><i class="fa fa-close"></i> </button>
														</div>
														
														@endforeach
												@endif
											</div>
											<div class="cart-summary">
												<small class="total-items">  {{isset($cartInfo) ? $cartInfo['totalQty'] : "0"}} selected</small>
												<h5 class="total-price">SUBTOTAL: {{isset($cartInfo) ? number_format($cartInfo['totalPrice']):'0'}} VND</h5>
											</div>
											<div class="cart-btns">
												<a href="{{ route('viewcart.layout')}}">View Cart</a>
												<a href=" {{ route('checkout.layout')}} ">Checkout <i class="fa fa-arrow-circle-right"></i></a>
											</div>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
                    <!-- NAV -->
                    @php
                    $routeName = \Request::route()->getName()
                    @endphp
					<ul class="main-nav nav navbar-nav">
						<li class=" {{ $routeName == 'client.index' ? 'active' : ''  }}"><a href=" {{route('client.index')}} ">Trang chủ</a></li>
						{{-- <li class=" {{ $routeName == 'hotdeals.layout' ? 'active' : ''  }}"><a href=" {{route('hotdeals.layout')}} ">Bán chạy</a></li> --}}
						<li class=" {{ $routeName == 'home.categories' ? 'active' : ''  }}"><a href=" {{ route('home.categories') }} ">Danh mục phụ kiện</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
        <!-- /NAVIGATION -->
        
        @yield('content')

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
                  @foreach ($categories as $category)            
									<li><a href="{{ route('home.categories')}}"> {{ $category->name }} </a></li>
                  @endforeach
                </ul>
            
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->


		<!-- jQuery Plugins -->
		<script src="/store/js/jquery.min.js"></script>
		<script src="/store/js/bootstrap.min.js"></script>
		<script src="/store/js/slick.min.js"></script>
		<script src="/store/js/nouislider.min.js"></script>
		<script src="/store/js/jquery.zoom.min.js"></script>
		<script src="/store/js/main.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			function addToCart(){
				let id = $(this).data('id');
				@if(Auth::user())
				$.ajax({
					type: "GET",
					url: '/home/' + id + '/add-to-cart/',
					success: function (response) {
						// console.log(response);
						$("#change-items-cart").empty();
						$("#change-items-cart").html(response);
						swal("Thêm vào giỏ hàng thành công");
					}
				});
				@else 
						swal("Đăng nhập để thêm vào giỏ hàng của bạn");
				@endif
			};
			function deleteItemCart() {
				let id = $(this).data('id');
				$.ajax({
					type: "DELETE",
					url: '/home/' + id + '/add-to-cart/',
					success: function (response) {
						$("#change-items-cart").empty();
						$("#change-items-cart").html(response);
						swal("Đã xóa sản phẩm từ giỏ hàng thành công");
					}
				});
			}
			$(document).ready(function(){
				$('.add-to-cart-btn').on('click',addToCart);
				$('.delete').on('click',deleteItemCart);
			});
			$(document).on( "click", ".delete", function() {
				let id = $(this).data('id');
				$.ajax({
					type: "DELETE",
					url: '/home/' + id + '/add-to-cart/',
					success: function (response) {
						$("#change-items-cart").empty();
						$("#change-items-cart").html(response);
						swal("Đã xóa sản phẩm từ giỏ hàng thành công");
					}
				});
			});
			//$('.delete').on('click',deleteItemCart);
				
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			})
			@if (Session('success'))
			$(document).ready(function(){
				swal('Đặt hàng thành công')
			})
            @endif
			@if (Session('errors'))
				$(document).ready(function(){
				swal("Không có sản phẩm để thanh toán")
			})
			@endif
		</script>
	</body>
</html>
