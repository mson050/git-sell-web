@extends('client.layout.web')

@section('content')
<div class="container">
    <div class="row">
        <table class="table">
            <thead style="background: red">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td scope="row">
                        <img src="/uploads/images/{{ $item['image'] }}" alt="" style="height: 100px">
                    </td>
                    <td> {{$item['name']}} </td>
                    <td> {{$item['price']}} </td>
                    <td> 
                        <form action="{{route('viewcart.update',$item['id'])}}" method="post">
                            @csrf
                            <input type="number" name="cart_quantity" min="1" value="{{$item['qty']}}">
                            <input class="btn btn-default" type="submit" value="Cập nhật" name="update_qty">
                        </form>
                    </td>
                    <td>
                        {{ number_format($item['price']*$item['qty'])}} VNĐ
                    </td>
                </tr>
                @endforeach
               <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td>Tổng tiền :{{number_format($cartInfo['totalPrice'])}} VNĐ</td>
               </tr>
            </tbody>
        </table>
        <div class="btn btn-sucess cart-btns" style="background: red;width:100px;float:right">
            <a href=" {{ route('checkout.layout')}} "> Checkout <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection