@extends('backend.master')
@section('about-us')
 active
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">About us</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">About us</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     @foreach ($about_us as $abt)
     <div class="card">
        <div class="card-body">
          <h5 class="text-center">{{ $abt->title }}</h5>
          <p class="text text-center">
              {{ $abt->content }}
          </p>
        </div>
        <!-- /.card-body -->
    
        <!-- Pagination Links -->
        <div class="card-footer">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
               Change it & renew
            </button>
      </div>
      </div>
     @endforeach
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
        <div class="modal-header">
          <h4 class="modal-title">Change the content & renew</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('about-us.store') }}" method="post" class="form-group">
          @csrf
          <div class="modal-body">
              <label for="">Title:</label>
              <input type="text" name="title" class="form-control" required>
              <label for="">Content</label>
              <textarea name="content" id="" class="form-control"></textarea>
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
@endsection
