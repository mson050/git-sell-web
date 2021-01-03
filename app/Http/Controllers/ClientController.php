<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Collection;
use App\Models\Invoice;
use Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $category_id = '';
        $keyword = $request->input('keyword');
        $category_query = Category::query();
        $collection_query = Collection::query();
        $item_query = Item::orderBy('id','desc');
        if ($keyword) {
            $item_query->where('name', 'like', "%{$keyword}%");
        }
        // if($category_id){
        //     $item_query->where('category_id', '=', "{$category_id}");
        // }
        $categories = $category_query->get();
        $items = $item_query->get();
        $collections = $collection_query->get();

        return view('client.page.home', compact('categories','items','collections','category_id'));
    }
    public function indexCategory($category_id,Request $request)
    {
        $keyword = $request->input('keyword');
        $category_query = Category::query();
        $collection_query = Collection::query();
        $item_query = Item::orderBy('id','desc');
        if ($keyword) {
            $item_query->where('name', 'like', "%{$keyword}%");
        }
        if($category_id){
            $item_query->where('category_id', '=', "{$category_id}");
        }
        $categories = $category_query->get();
        $items = $item_query->get();
        $collections = $collection_query->get();

        return view('client.page.home', compact('categories','items','collections','category_id'));
    }

    public function categoriesLayout(Request $request)
    {
        $category_requests = $request->input('category-id');
        $category_query = Category::query();
        $categories = $category_query->get();
        $item_query = Item::orderBy('id','desc');
        if($category_requests)
        {
            foreach($category_requests as $category_request){
                $item_query->orWhere('category_id', '=', "$category_request");
            }
        }
        $count = count($item_query->get());
        $items = $item_query->paginate(12);
        return view('client.page.categories', compact('categories','items','category_requests','count'));
    }

    public function checkoutLayout()
    {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);
        return view('client.page.checkout', compact('categories'));
    }
    public function hotdealsLayout()
    {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);
        return view('client.page.hotdeals', compact('categories'));
    }
    public function detail($id)
    {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);
        $item_query = Item::find($id);
        $item = $item_query->first();
        $related_items = Item::query()->where('category_id','=',"{$item->category_id}")->get();
        return view('client.page.detail',compact('item','categories','related_items'));

    }
    public function addtocart($id, Request $request)
    {
        
        $item = Item::find($id);
        $totalQty = 0;
        $totalPrice = 0;
        $cart = session()->get('cart');
        $cartInfo = session()->get('cartInfo');
        if (isset($cart[$id]) )
        {
            $cart[$id]['qty'] = $cart[$id]['qty'] + 1;
        } else {
            $cart[$id] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'qty' => 1
            ];
        }
        foreach($cart as $item){
            $totalQty += $item['qty'];
            $totalPrice += $item['qty'] * $item['price'];
        }
        $cartInfo['totalQty'] = $totalQty;
        $cartInfo['totalPrice'] = $totalPrice;
        $request->session()->put('cart',$cart);
        $request->session()->put('cartInfo',$cartInfo);
        return view('client.layout.cart', compact('cart','cartInfo'));
    }
    public function deleteItemCart($id, Request $request)
    {
        
        $cart = session()->get('cart');
        $cartInfo = session()->get('cartInfo');
        
        $cartInfo['totalQty'] = $cartInfo['totalQty'] - $cart[$id]['qty'];
        $cartInfo['totalPrice'] = $cartInfo['totalPrice'] - $cart[$id]['qty'] * $cart[$id]['price'];
        unset($cart[$id]);
        $request->session()->put('cart',$cart);
        $request->session()->put('cartInfo',$cartInfo);
        return view('client.layout.cart', compact('cart','cartInfo'));
    }

}
