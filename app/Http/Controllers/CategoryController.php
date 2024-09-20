<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(10);
        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'unique:categories,name']
        ]);

        $category = new Category;
        $category->slug = Str::slug($request->name, '-');
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'unique:categories,name,' . $id]
        ]);

        $category = Category::find($id);
        $category->slug = Str::slug($request->name, '-');
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category');
    }
}