<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterPostController extends Controller
{
    public function storepost(Request $request)
    {
        $request->validate([
            'post_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);
    
        // Handle the file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public'); // Store in `storage/app/public/posts`
        }
    
        // Save the post
        Post::create([
            'post_name' => $request->post_name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'name' => auth()->user()->name, // Authenticated user's name
            'usertype' => auth()->user()->usertype,
            'post_status' => 'Accepted', // Post status
            'image' => $imagePath, // Save the image path
        ]);
    
        return redirect()->back()->with('message', 'Post created successfully!');
    }
    
    

    public function showpost($id){
        $post_info = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post_info', 'categories'));
    }
    
    public function updatepost(Request $request,$id){
        $post =Post::findOrFail($id);
        $validate_data=$request->validate([
            'post_name'=>'unique:posts|max:100|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);
        $post->update($validate_data);
        return redirect()->back()->with('message','Post Updated Successfully');

    }

    public function deletepost($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post Deleted Successfully');

    }
}
