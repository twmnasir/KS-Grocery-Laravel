@extends('backend.master')
@section('category')
 active
@endsection
{{-- @section('css-link')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  @endsection --}}
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Create Category
              </button></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
      <div class="card-body">
          @if (session('success'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><h5 class="text-white">&times;</h5></button>
              <h5><i class="icon fas fa-check"></i> The Action Completed!</h5>
          </div>
          @endif
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($categories as $category)
                  <tr>
                      <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ $category->created_at }}</td>
                      <td>
                          <button type="button" class="btn btn-secondary editBtn" data-toggle="modal" data-target="#modal-secondary"
                              data-category-name="{{ $category->category_name }}" data-category-id="{{ $category->id }}" 
                              data-route="{{ route('category.update', $category->id) }}">Edit</button>
  
                          <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger mt-1">Delete</button>
                          </form>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="5">No Categories yet!</td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
      <!-- /.card-body -->
  
      <!-- Pagination Links -->
      <div class="card-footer">
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  {{-- Categgory Create --}}
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('category.store') }}" method="post" class="form-group">
          @csrf
        <div class="modal-body">
          <label for="category_name">Category Name:</label>
          <input type="text" name="category_name" class="form-control" placeholder="Enter a Category name" required>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Sumbit</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  {{-- Categgory Create --}}

  {{-- Categor Edit --}}
  <div class="modal fade" id="modal-secondary">
    <div class="modal-dialog">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">Secondary Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class="form-group editForm" id="editForm">
          @method('PUT')
          @csrf
          <div class="modal-body">
              <label for="category_name">Category Name:</label>
              <input type="text" name="category_name" class="form-control" value="" id="categoryName" required>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </form>      
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Attach click event to all edit buttons
    const editButtons = document.querySelectorAll('.editBtn');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get data from button attributes
            const categoryName = this.getAttribute('data-category-name');
            const categoryRoute = this.getAttribute('data-route');
            
            // Set data to modal form fields
            document.getElementById('categoryName').value = categoryName;
            
            // Set form action URL using route attribute
            document.getElementById('editForm').action = categoryRoute;
        });
    });
});
</script>
@endsection
{{-- @section('js-link')
<script src="{{ asset('dashboared/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboared/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endsection --}}
