@extends('backend.master')
@section('sub-category')
 active
@endsection
{{-- @section('css-link')
  @endsection --}}
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Category <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Create Sub Category
              </button></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Sub Category</li>
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
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><h5 class="text-white fs-5">&times;</h5></button>
              <h5><i class="icon fas fa-check"></i>{{ session('success') }}</h5>
          </div>
          @endif
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Sub Category</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($subcategories as $subcategory)
                  <tr>
                      <td>{{ $loop->iteration + ($subcategories->currentPage() - 1) * $subcategories->perPage() }}</td>
                      <td><strong>{{ $subcategory->subcategory_name }}</strong></td>
                      <td><strong>{{ $subcategory->category->category_name }}</strong></td>
                      <td>{{ $subcategory->created_at }}</td>
                      <td>
                          <button type="button" class="btn btn-secondary editBtn" data-toggle="modal" data-target="#modal-secondary"
                              data-subcategory-name="{{ $subcategory->subcategory_name }}"
                              data-category-name="{{ $subcategory->category->category_name }}" 
                              data-route="{{ route('sub-category.update', $subcategory->id) }}"
                              >Edit</button>
  
                          <form action="{{ route('sub-category.destroy',$subcategory->id) }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger mt-1">Delete</button>
                          </form>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="5" class="text-center">No Sub Categories yet!</td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
      <!-- /.card-body -->
  
      <!-- Pagination Links -->
      <div class="card-footer">
        {{ $subcategories->links('pagination::bootstrap-4') }}
    </div>
    </div>
  </div>

  {{-- Categgory Create --}}
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create Sub Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('sub-category.store') }}" method="post" class="form-group">
          @csrf
        <div class="modal-body">

          <label for="category_name">Sub Category Name:</label>
          <input type="text" name="subcategory_name" class="form-control" placeholder="Enter a Sub Category name" required>

          <label for="category_id">Category:</label>
          <select name="category_id" class="form-control" required>
            <option value="">Select one</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
          </select>

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
          <h4 class="modal-title">Sub Category edit form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class="form-group editForm" id="editForm">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <label for="category_name">Sub Category Name:</label>
            <input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="Enter a Sub Category name" required>
            <label for="category_select">Category:</label>
            <select name="category_id" class="form-control" id="category_select" required>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
              @endforeach
            </select>
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
            const subcategoryName = this.getAttribute('data-subcategory-name');
            const categoryName = this.getAttribute('data-category-name');
            const subcategoryRoute = this.getAttribute('data-route');
            
            // Set data to modal form fields
            document.getElementById('subcategory_name').value = subcategoryName;
            
            let selectElement = document.getElementById('category_select');
            
            // Loop through the options to find and select the correct one
            for (let i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].text === categoryName) {
                    selectElement.selectedIndex = i;
                    break;
                }
            }

            // Set the form's action to the correct route
            document.getElementById('editForm').action = subcategoryRoute;
        });
    });
});

</script>
@endsection
{{-- @section('js-link')
@endsection --}}
