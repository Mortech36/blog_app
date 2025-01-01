@extends('admin.layouts.layout')
@section('admin_page_title')
   Manage Category - Admin Panel
@endsection
@section('admin_layout')
<div class="row">
   <div class="col-12 ">
      <div class="card">
         <div class="card-header">
            <h5 class="card-title mb-0">All Categories</h5>
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
                     <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse ($categories as $category)
                     <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                           <div style="display: flex; gap: 8px; align-items: center;">
                             <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $category->id }})">Delete</button>
                             <a href="{{ route('show.cat', $category->id) }}" class="btn btn-primary">Edit</a>
                           </div>
                         </td>
                     </tr>
                     @empty
                     <tr>
                         <td colspan="7" class="text-center p-4">No Category available</td>
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

<form id="deleteForm" method="POST" style="display:none;">
   @csrf
   @method('DELETE')
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function confirmDelete(categoryId) {
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
               form.action = `{{ route('delete.cat', ':id') }}`.replace(':id', categoryId);
               form.submit();
           }
       });
   }
</script>
@endsection
