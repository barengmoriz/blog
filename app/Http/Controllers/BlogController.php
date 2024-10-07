<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::latest()->where('user_id', auth()->user()->id)->paginate(10);
        return view('blog.index', [
            'blogs' => $blogs
        ]);
    }

    public function create(){
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('blog.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'short_description' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
            'tag' => ['required'],
        ]);

        $slug = Str::slug($request->title, '-') . '-' . Str::random(5);
        $file = $request->file('image');
        $image = $file->storeAs('images/blog', $slug . '.' . $file->extension());

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $image,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        $blog->tags()->sync($request->tag);

        return redirect()->route('blog')->with('success', 'Data ' .$blog->name. ' berhasil disimpan');
    }

    public function edit(Blog $blog){
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('blog.edit', [
            'blog' => $blog,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(Request $request, Blog $blog){
        $request->validate([
            'title' => ['required'],
            'image' => ['image', 'mimes:jpg,jpeg,png'],
            'short_description' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
            'tag' => ['required'],
        ]);

        if($request->hasFile('image')){
            Storage::delete($blog->image);
            
            $file = $request->file('image');
            $image = $file->storeAs('images/blog', $blog->slug . '.' . $file->extension());

            $blog->update([
                'title' => $request->title,
                'image' => $image,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'category_id' => $request->category
            ]);
        } else {
            $blog->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'category_id' => $request->category
            ]);
        }

        $blog->tags()->sync($request->tag);

        return redirect()->route('blog')->with('success', 'Data ' .$blog->title. ' berhasil diperbarui');
    }

    public function destroy(Blog $blog){
        if($blog->is_publish){
            return [
                'success' => false,
                'message' => 'Data '. $blog->title .' tidak dapat dihapus'
            ];

        } else {
            $blog->delete();
            Storage::delete($blog->image);
    
            return [
                'success' => true,
                'message' => 'Data '. $blog->title .' berhasil dihapus'
            ];
        }
    }

    public function show(Blog $blog){
        return view('public.blog', [
            'blog' => $blog
        ]);
    }

    public function publish(Blog $blog){
        $blog->update([
            'is_publish' => true
        ]);

        return redirect()->route('blog')->with('success', 'Data ' .$blog->title. ' berhasil dipublish');
    }

    public function unpublish(Blog $blog){
        $blog->update([
            'is_publish' => false
        ]);

        return redirect()->route('blog')->with('success', 'Data ' .$blog->title. ' berhasil diunpublish');
    }
}
