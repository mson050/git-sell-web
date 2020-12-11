<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Image;
class CollectionController extends Controller
{
    public function index(Request $request)
    { 
        $keyword = $request->input('keyword');
        $query = Collection::query();
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }
        $collections = $query->paginate(5);

        return view('collection.index', compact('collections'));
    }
    public function create()
    {
        return view('collection.create');
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $collection = new Collection;

        $collection->name = $name;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(360, 240)->save(public_path('/uploads/collection_imgs/' . $filename));
            $collection->image = $filename;
        }

        $collection->save();
        return redirect()->route('collections.index');

    }
    public function edit($id)
    {
        $collection = Collection::find($id);
        if(!$category) {
            abort(404);
        }
        return view('collection.update', compact('collection'));
    }
    public function update($id, Request $request)
    {
        $name = $request->input('name');
        
        
        $collection =  Collection::find($id);

        $collection->name = $name;
    
        $collection->save();
        return redirect()->route('collection.edit',$collection->id);
    }
    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();
        return redirect()->route('collection.index');
    }
}
