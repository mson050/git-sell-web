@extends('layout.admin')
@section('content')
    @foreach ($invoices as $invoice)
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title" style="background: ">
                                <img style="background: black" src="./store/img/logo.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Hóa đơn #: {{$invoice->id}}<br>
                                Ngày: {{ date_format($invoice->created_at,'Y/m/d') }} <br>
                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
            
            <tr class="information">
                <td >
                    <table>
                        <tr>
                            <td>
                                Khách hàng<br>
                                Email khách hàng<br>
                                Địa chỉ nhận<br>
                                Số điện thoại
                            </td>
                            <td></td>
                            <td>
                                {{ $invoice->customer_name }} <br>
                                {{ $invoice->email }} <br>
                                {{ $invoice->address_shipping}}, {{ $invoice->city}} <br>
                                {{ $invoice->customer_phone }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            
            <tr class="heading">
                <td>
                    Sản phẩm
                </td>
                
                <td>
                    Số lượng
                </td>

                <td>
                    Giá
                </td>
            </tr>
            @foreach ($invoice->item as $item)
                <tr class="item">
                    <td>
                        {{ $item->name}}
                    </td>
                    
                    <td>
                        {{ $item->pivot->item_quantity}}
                    </td>   
                    <td>
                        {{ number_format($item->price)}} VND
                    </td>
                </tr>
            @endforeach
        
            
            
            <tr class="total">
                <td></td>
                <td>
                    Tổng tiền: {{ number_format($invoice->totalPrice ) }} VND 
                </td>
                <td>
                   
                </td>
            </tr>
        </table>
    </div>
    @endforeach
    {{ $invoices->appends($_GET) }}

@endsection