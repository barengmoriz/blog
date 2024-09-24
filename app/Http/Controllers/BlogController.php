<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index', [
            'blogs' => $blogs
        ]);
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        return view('blog.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'description' => ['required'],
            'category' => ['required']
        ]);

        $slug = Str::slug($request->title, '-') . '-' . Str::random(5);
        $file = $request->file('image');
        $image = $file->storeAs('images/blog', $slug . '.' . $file->extension());

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image,
            'description' => $request->description,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('blog')->with('success', 'Data ' .$blog->name. ' Berhasil Disimpan');
    }

    public function edit(Blog $blog){
        $categories = Category::orderBy('name')->get();
        return view('blog.edit', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Blog $blog){
        $request->validate([
            'title' => ['required'],
            'image' => ['image', 'mimes:jpg,jpeg,png'],
            'description' => ['required'],
            'category' => ['required']
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->storeAs('images/blog', $blog->slug . '.' . $file->extension());
            Storage::delete($blog->image);

            $blog->update([
                'title' => $request->title,
                'image' => $image,
                'description' => $request->description,
                'category_id' => $request->category
            ]);
        } else {
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category
            ]);
        }

        return redirect()->route('blog')->with('success', 'Data ' .$blog->title. ' Berhasil Diperbarui');
    }

    public function destroy(Blog $blog){
        $blog->delete();
        Storage::delete($blog->image);

        return [
            'success' => true,
            'message' => 'Data '. $blog->title .' Berhasil Dihapus'
        ];
    }
}
