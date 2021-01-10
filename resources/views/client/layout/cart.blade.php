<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Giỏ hàng</span>
        <div class="qty">{{$cartInfo['totalQty']}}</div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list">

            @foreach ($cart as $item)
            <div class="product-widget">
                <div class="product-img">
                    <img src="/uploads/images/{{ $item['image'] }}" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#"> {{$item['name']}} </a></h3>
                    <h4 class="product-price"><span class="qty"> {{$item['qty']}} X </span>{{ number_format($item['price']) }} </h4>
                </div>
                <button onclick="deleteItemCart()" class="delete" data-id="{{$item['id']}}"><i class="fa fa-close"></i></button>
            </div>            
            @endforeach
        </div>
        <div class="cart-summary">
            <small class="total-items"> {{$cartInfo['totalQty']}} selected</small>
            <h5 class="total-price">SUBTOTAL: {{number_format($cartInfo['totalPrice'])}} VND</h5>
        </div>
        <div class="cart-btns">
            <a href="{{ route('viewcart.layout')}}">View Cart</a>
            <a href=" {{ route('checkout.layout')}} ">Checkout <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>