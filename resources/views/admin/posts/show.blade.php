@extends('admin.layouts.layout')

@section('admin_page_title')
   Manage Post - Admin Panel
@endsection

@section('admin_layout')
<div class="row">
   <div class="col-12 ">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title mb-0">All Posts</h5>
         </div>
         <div class="card-body">
            
            <div class="table-responsive">
               @if (@session('message'))
                  <div class="alert alert-danger">
                     {{ session('message') }}
                  </div>
               @endif
               <table class="table">
                <thead>
                  <tr class="text-slate-500 border-b border-slate-300 bg-slate-50">
                    <th class="p-4">Image</th>
                    <th class="p-4">Post Title</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Post by</th>
                    <th class="p-4">Post Status</th>
                    <th class="p-4">User Type</th>
                    <th class="p-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($posts as $post)
                  <tr class="hover:bg-slate-50">
                      <td class="p-4">
                          <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" />
                      </td>
                      <td class="p-4">{{ $post->post_name }}</td>
                      <td class="p-4">{{ $post->description }}</td>
                      <td class="p-4">{{ $post->name }}</td>
                      <td class="p-4">{{ $post->post_status }}</td>
                      <td class="p-4">{{ $post->usertype }}</td>
                      <td>
                          <div class="flex space-x-4 p-4">
                              <button onclick="confirmDelete({{ $post->id }})" class="btn btn-danger">Delete</button>
                              <a href="{{ url('update_post_page', $post->id) }}" class="btn btn-secondary">Update</a>
                              <a href="{{ url('accept_post', $post->id) }}" class="btn btn-success">Accept</a>
                              <a href="{{ url('reject_post', $post->id) }}" class="btn btn-primary">Reject</a>
                          </div>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="7" class="text-center p-4">No posts available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            
         </div>
      </div>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<form id="deleteForm" action="{{ route('post.delete', ':id') }}" method="POST" style="display:none;">
   @csrf
   @method('DELETE')
</form>
<script>
   function confirmDelete(postId) {
       Swal.fire({
           title: "Are you sure?",
           text: "This action cannot be undone!",
           icon: "warning",
           showCancelButton: true,
           confirmButtonColor: "#d33",
           cancelButtonColor: "#3085d6",
           confirmButtonText: "Yes, delete it!"
       }).then((result) => {
           if (result.isConfirmed) {
               let form = document.getElementById('deleteForm');
               form.action = form.action.replace(':id', postId);
               form.submit();
           }
       });
   }
</script>

@endsection
