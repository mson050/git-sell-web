<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Image;

class ItemController extends Controller
{
    public function index (Request $request)
    { 
        $keyword = $request->input('keyword');
        $query = Item::query();
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }
        $items = $query->paginate(5);


        // $items = Item::paginate(2);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $detail = $request->input('detail');
        $price = $request->input('price');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $category = $request->input('category');
        
        $item = new Item;

        $item->name = $name;
        $item->detail = $detail;
        $item->price = $price;
        $item->color = $color;
        $item->quantity = $quantity;
        $item->category_id = $category;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(263, 263)->save(public_path('/uploads/images/' . $filename));
            $item->image = $filename;
        }
        $item->save();
        return redirect()->route('items.index');

    }
    public function edit($id)
    {
        $item = Item::find($id);
        if(!$item) {
            abort(404);
        }
        return view('items.update', compact('item'));
    }
    public function update($id, Request $request)
    {
        $name = $request->input('name');
        $detail = $request->input('detail');
        $price = $request->input('price');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $category = $request->input('category');
        
        $item =  Item::find($id);

        $item->name = $name;
        $item->detail = $detail;
        $item->price = $price;
        $item->color = $color;
        $item->quantity = $quantity;
        $item->category_id = $category;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save(public_path('/uploads/images/' . $filename));
            $item->image = $filename;
        }
        $item->save();
        return redirect()->route('items.edit',$item->id);
    }
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('items.index');
    }


    
}
