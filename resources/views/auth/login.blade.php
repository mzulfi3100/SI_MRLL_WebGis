<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <style>
    .solid {border-style: solid;}
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css')}}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Assets/css/style2.css" type="text/css">
</head>
<body>
        <div class="wrapper"><!-- bg-bubbles -> memanggil jumlah animasi yang muncul -->
        <ul class="bg-bubbles"><li><li><li><li><li><li><li><li><li><li></li></li></li></li></li></li></li></li></li></li></ul>
        <!-- bagian utama -->
        <!-- fadeInDown -->
        <div class="container ">
            <div>&nbsp;</div>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">Login Admin</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                    <form action="{{ route('login.process') }}" method="POST" class="signin-form">
                        @csrf 
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password"
                                    required>
                                <span style="position: absolute" toggle="#password"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div><div>| &nbsp;</div>
                                <div> <a href="/" style="font-size: 15px; font-weight: bold">Kembali Ke Menu Awal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /bagian utama -->
        </div>
    <script src="{{('/Assets/js/jquery.min.js')}}"></script>
    <script src="{{('/Assets/js/popper.js')}}"></script>
    <script src="{{('/Assets/js/bootstrap.min.js')}}"></script>
    <script src="{{('/Assets/js/main.js')}}"></script>
</body>
</html>