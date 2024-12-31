@extends('admin.layouts.layout')
@section('admin_page_title')
   Create Post - Admin Panel
@endsection
@section('admin_layout')
   <div class="row">
      <div class="col-12 ">
         <div class="card">
            <div class="card-header">
               <h5 class="card-title mb-0">Create Post</h5>
            </div>
            <div class="card-body">
               @if ($errors->any())
                  <div class="alert alert-danger d-flex align-items-center">
                     <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                     </ul>
                  </div>
               @endif
               @if (@session('message'))
                  <div class="alert alert-success">
                     {{session('message')}}
                  </div>
               @endif

               <form action="{{route('post.create')}}" method="POST">
                  @csrf
                  <label for="post_name" class="fw-bold mb-2">Enter Name of Your Post</label>
                  <input type="text" class="form-control" placeholder="Computer" name="post_name">
                  <label for="category_id" class="fw-bold mb-2">Select Category</label>
                  <select name="category_id" class="form-control" id="category_id">
                     @foreach ($categories as $category )
                     <option value="{{$category->id}}">{{$category->category_name}}</option>
                        
                     @endforeach
                  </select>
                  <label for="description" class="fw-bold mb-2">Describe Your Post</label>
                  <textarea class="form-control" spellcheck="false" placeholder="Describe everything about this post here" name="description"></textarea>
                  <label for="post_image" class="fw-bold mb-2">Choose an Image</label>
                  <input  class="form-control" spellcheck="false" placeholder="Post Image" type="file" name="image">
                  <button type="submit" class="btn btn-primary w-100 mt-2">Add Post</button>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
