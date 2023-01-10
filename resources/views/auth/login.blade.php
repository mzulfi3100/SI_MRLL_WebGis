<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition layout-top-nav">
    <!-- Tampilan Preloader Logo Dishub -->
    <div class="preloader flex-column justify-content-center align-items-center bg-gradient-dark">
        <img class="animation__shake" src="{{('/Admin/dist/img/LogoDishub.png')}}" alt="LogoDishub" height="200" width="230">
    </div>
    <!-- End Tampilan Preloader Logo Dishub -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-lightblue navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a style="color:white;font-size:18px" class="nav-link" href="/">
                    &nbsp;&nbsp;&nbsp;SISTEM INFORMASI MANAJEMEN REKAYASA LALU LINTAS </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <div class="p-4">
            <h3 class="mb-4">LOGIN ADMIN</h3>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>