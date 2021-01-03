<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailOder;

class DetailOderController extends Controller
{
    public function storeDetailOder($id)
    {
        $cart = session()->get('cart');
        $cartInfo = session()->get('cartInfo');
        foreach ($cart as $item) {
       
            $detailOder = new DetailOder;
            $detailOder->invoice_id = $id;
            $detailOder->item_id = $item['id'];
            $detailOder->item_quantity = $item['qty'];
            $detailOder->save();
        }
        session()->forget(['cart','cartInfo']);
        return redirect()->route('client.index')->withSuccess('Đặt hàng thành công');
    }
}
