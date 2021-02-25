<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Collection;
use App\Models\Invoice;
use App\Models\Comment;
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
        $topSells_querry = Item::orderBy('number','desc')->where('number','>=','3');
        $topSells = $topSells_querry->get();
        return view('client.page.home', compact('categories','items','collections','category_id','topSells'));
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
        $topSells = Item::orderBy('number','asc')->where('number','>=','3');
        return view('client.page.home', compact('categories','items','collections','category_id','topSells'));
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
        $item = Item::find($id);
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
                'image' => $item->image,
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
   public function viewCart()
   {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);

        $cart = session()->get('cart');
        $cartInfo = session()->get('cartInfo');
       return view('client.page.viewcart', compact('categories','cart','cartInfo'));
   }
   public function updateCart($id,Request $request)
   {
    $category_query = Category::query();
    $categories = $category_query->paginate(5);
    $cart = session()->get('cart');
    $cartInfo = session()->get('cartInfo');

    $cartInfo['totalQty'] = $cartInfo['totalQty'] + ($request->input('cart_quantity')-$cart[$id]['qty']);
    $cartInfo['totalPrice'] = $cartInfo['totalPrice'] + ($request->input('cart_quantity')-$cart[$id]['qty'])*$cart[$id]['price'];
    $cart[$id]['qty'] = $request->input('cart_quantity');
    $request->session()->put('cart',$cart);
    $request->session()->put('cartInfo',$cartInfo);
    return view('client.page.viewcart', compact('categories','cart','cartInfo'));

   }
   public function viewOrder($id)
   {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);   

        $order_query = Invoice::orderBy('id','desc')->where('user_id','=',"{$id}");
        $orders = $order_query->paginate(3);
        
        return view('client.page.vieworder', compact('categories','orders'));
   }
   public function addcomment(Request $request)
   {
        $user = $request->input('user_id');
        $item = $request->input('item_id');
        $review = $request->input('comment_content');

        $comment = new Comment;
        $comment->user_id = $user;
        $comment->item_id = $item;
        $comment->comment = $review;
        $comment->save();

   }
   public function loadcomment(Request $request){
        $item_id = $request->item_id;
        $comments = Comment::query()->orderBy('id','desc')->where('item_id','=',"{$item_id}")->get();
        return view('client.layout.review',compact('comments'));
   }
}
