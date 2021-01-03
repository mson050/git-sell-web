<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\DetailOder;
use Validator;
use Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $query = Invoice::query();
        $invoices = $query->paginate(5);
        return view('invoice.index',compact('invoices'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required|min:10',
        ], [
            'name.required' => 'Bạn chưa nhập họ tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không hợp lệ',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'city.required' => 'Bạn chưa nhập thành phố',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.min' => 'Số điện thoại không hợp lệ',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();;
        }

        $cartInfo = session()->get('cartInfo');
        $cart = session()->get('cart');
        
        if( $cart == null ){
            return redirect()->route('client.index')->withErrors('Không có sản phẩm để thanh toán');
        }
        $customer_name = $request->input('name');
        $customer_email = $request->input('email');
        $address_shipping = $request->input('address');
        $city = $request->input('city');
        $customer_phone = $request->input('phone');

        $invoice = new Invoice;
        $invoice->user_id = Auth::user()->id;
        $invoice->customer_name = $customer_name;
        $invoice->email = $customer_email;
        $invoice->address_shipping = $address_shipping;
        $invoice->city = $city;
        $invoice->customer_phone = $customer_phone;
        $invoice->totalPrice = $cartInfo['totalPrice'];
        $invoice->save();
        $id = $invoice->id;
        return redirect()->route('detailOder.store',$id);
    }
   
}
