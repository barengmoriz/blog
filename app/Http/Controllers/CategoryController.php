<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        // $categories = Category::latest()->paginate(10);
        $categories = Category::orderBy('name')->paginate(10);
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

        // Insert biasa
        // $category = new Category;
        // $category->slug = Str::slug($request->name, '-');
        // $category->name = $request->name;
        // $category->save();

        // Insert Mass Assignment -> Model Category
        $category = Category::create([
            'slug' => Str::slug($request->name, '-'),
            'name' => $request->name
        ]);

        return redirect()->route('category')->with('success', 'Data ' .$category->name. ' berhasil disimpan');
    }

    public function edit(Category $category){
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name' => ['required', 'unique:categories,name,' . $category->id]
        ]);

        // Update Mass Assignment -> Model Category
        $category->update([
            'slug' => Str::slug($request->name, '-'),
            'name' => $request->name
        ]);

        return redirect()->route('category')->with('success', 'Data ' .$category->name. ' berhasil diperbarui');
    }

    public function destroy(Category $category){
        if($category->blogs->count() > 0){
            return [
                'success' => false,
                'message' => 'Data '.$category->name.' tidak dapat dihapus'
            ];
        } else {
            $category->delete();
            return [
                'success' => true,
                'message' => 'Data '.$category->name.' berhasil dihapus'
            ];
        }
    }
}