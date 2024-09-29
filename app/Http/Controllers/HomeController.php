<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(10);
        return view('public.home', [
            'blogs' => $blogs 
        ]);
    }
}
