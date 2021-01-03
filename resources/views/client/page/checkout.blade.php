@extends('client.layout.web')

@section('content')
    


		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
					
					<form action="{{route('invoice.store')}}" method="POST" role="form">
						@csrf 
						<legend><h1>Thông tin giao hàng</h1></legend>
					
						<div class="form-group">
							<input type="text" name="name" class="form-control" id="" placeholder="Họ Tên">
							@error('name')
								<div class="text-danger"> {{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input type="text" name="email" class="form-control" id="" placeholder="Email">
							@error('email')
							<div class="text-danger"> {{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input type="text" name="address" class="form-control" id="" placeholder="Địa chỉ nhận">
							@error('address')
							<div class="text-danger"> {{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input type="text" name="city" class="form-control" id="" placeholder="Tỉnh thành">
							@error('city')
							<div class="text-danger"> {{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<input type="text" name="phone" class="form-control" id="" placeholder="Số điện thoại">
							@error('phone')
							<div class="text-danger"> {{ $message }}</div>
							@enderror
						</div>
						<div class="form-group ">
							<button type="submit" class="btn btn-primary">Đặt hàng</button>
						</div>
	
					</form>
					
					
					</div>

					@php
						$cart = session()->get('cart');
						$cartInfo = session()->get('cartInfo');
					@endphp
					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								@if (isset($cart))
									@foreach ($cart as $item)
										<div class="order-col">
											<div> <p> {{$item['qty']}}x   {{$item['name']}} </p> </div>
											<div>{{number_format($item['qty'] * $item['price'])}} VND</div>
										</div>
									@endforeach
								@endif
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total"> {{isset($cart) ? number_format($cartInfo['totalPrice']) : '0'}} VND </strong></div>
							</div>
						</div>

					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection