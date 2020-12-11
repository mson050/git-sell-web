<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    { 
        $keyword = $request->input('keyword');
        $query = Category::query();
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }
        $categories = $query->paginate(5);


        
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $category = new Category;

        $category->name = $name;

        $category->save();
        return redirect()->route('categories.index');

    }
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category) {
            abort(404);
        }
        return view('category.update', compact('category'));
    }
    public function update($id, Request $request)
    {
        $name = $request->input('name');
        
        
        $category =  Category::find($id);

        $category->name = $name;
    
        $category->save();
        return redirect()->route('categories.edit',$category->id);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
