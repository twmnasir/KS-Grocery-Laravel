<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KS Grocery | Verify Email</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>KS Grocery</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h1>Email Verification Required</h1>
      <p>Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.</p>
      
      @if (session('status') == 'verification-link-sent')
          <p>A new verification link has been sent to your email address.</p>
      @endif
      
      <form action="{{ route('verification.send') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">Resend Verification Email</button>
      </form>
          <a href="{{ route('dashboard') }}" class="btn btn-danger mt-2">Back With Some facility</a>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
