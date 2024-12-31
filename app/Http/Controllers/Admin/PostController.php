<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function manage(){
        $posts = Post::all();
        return view('admin.posts.manage',compact('posts'));
    }
}
