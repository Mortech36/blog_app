<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class MasterPostController extends Controller
{
    public function storesubcat(Request $request){
        $validate_data=$request->validate([
            'post_name'=>'unique:posts|max:100|min:5',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
            
        ]);
        Post::create($validate_data);

        return redirect()->back()->with('message','Post Added Successfully');
    }
    

    public function showsubcat($id){
        $post_info = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post_info', 'categories'));
    }
    
    public function updatesubcat(Request $request,$id){
        $post =Post::findOrFail($id);
        $validate_data=$request->validate([
            'post_name'=>'unique:posts|max:100|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);
        $post->update($validate_data);
        return redirect()->back()->with('message','Post Updated Successfully');

    }

    public function deletesubcat($id){
        $Post = Post::find($id);
        $Post->delete();
        return redirect()->back()->with('message','Post Deleted Successfully');

    }
}
