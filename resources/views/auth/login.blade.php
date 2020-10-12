@extends('layouts.app')

@section('content')
  <body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">SIDEMIT</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silakan Login</p>

      <form action="{{url('/login')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">

            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!--<div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
          Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
          Google+</a>
      </div>


      <a href="#">I forgot my password</a><br>
      <a href="{{url('register')}}" class="text-center">Register a new membership</a>
    -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  </body>
@endsection
