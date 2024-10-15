<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::orderBy('name')->paginate(10);
        return view('tag.index', [
            'tags' => $tags
        ]);
    }

    public function create(){
        return view('tag.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'unique:tags,name']
        ]);

        $tag = Tag::create([
            'slug' => Str::slug($request->name, '-'),
            'name' => $request->name
        ]);

        return redirect()->route('tag')->with('success', 'Data ' .$tag->name. ' berhasil disimpan');
    }

    public function edit(Tag $tag){
        return view('tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag){
        $request->validate([
            'name' => ['required', 'unique:tags,name,' . $tag->id]
        ]);

        $tag->update([
            'slug' => Str::slug($request->name, '-'),
            'name' => $request->name
        ]);

        return redirect()->route('tag')->with('success', 'Data ' .$tag->name. ' berhasil diperbarui');
    }

    public function destroy(Tag $tag){
        if($tag->blogs->count() > 0){
            return [
                'success' => false,
                'message' => 'Data '.$tag->name.' tidak dapat dihapus'
            ];
        } else {
            $tag->delete();
            return [
                'success' => true,
                'message' => 'Data '.$tag->name.' berhasil dihapus'
            ];
        }
    }
}
