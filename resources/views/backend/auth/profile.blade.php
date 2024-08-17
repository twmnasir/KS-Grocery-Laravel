@extends('backend.master')
@section('profile')
border border-4 bg-primary
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
            <!-- Profile Image -->
            <div class="card">
              <div class="card-body">
                <div class="text-center">
                  <img class=""
                       src="{{ asset('dashboard/dist/img/user-photo/user999.png') }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-center">{{ $user->email }}</p>
                @if(session('status'))
                <p class="text-success text-center">{{ session('status') }}</p>
                @endif
                <div class="d-flex justify-content-around">
                    <button href="#" class="btn btn-primary w-25" data-toggle="modal" data-target="#modal-default"><b>Edit</b></button>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger w-25"><b>logout</b></a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        {{-- MOdal --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Profile Update</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('profile.update') }}" method="post" class="form-group">
                  @csrf
                <div class="modal-body">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
            
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
            
                    <label for="password">New Password (leave blank to keep current password)</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
            
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

@endsection