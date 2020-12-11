<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use App\Models\Collection;

class ClientController extends Controller
{
    public function index()
    {
        $category_query = Category::query();
        $collection_query = Collection::query();
        $item_query = Item::orderBy('id','desc');
        $categories = $category_query->paginate(5);
        $items = $item_query->get();
        $collections = $collection_query->get();

        return view('client.page.home', compact('categories','items','collections'));
    }
    public function categoriesLayout()
    {
        $category_query = Category::query();
        $categories = $category_query->paginate(5);
        return view('client.page.categories', compact('categories'));
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
        $items = $item_query->first()->get();
        return view('client.page.detail',compact('items','categories'));

    }
    public function addtocart($id)
    {
        $item = Item::find($id);
        $cart = session()->get('cart');
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

        session()->put('cart',$cart);
        return response()->json($cart);
    }
}
