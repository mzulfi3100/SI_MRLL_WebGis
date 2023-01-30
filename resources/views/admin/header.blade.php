<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard</title>

  <link rel="stylesheet" href="{{'/Assets/css/style4.css'}}" type="text/css">

  <!-- multiple delete -->
  <link rel="stylesheet" href="{{ asset('Admin/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Admin/toastr/toastr.min.css') }}">
  <!-- /multiple delete -->
  <!-- Jam -->
  <script src="{{'/Assets/js/js/jam2.js'}}"></script>
  <!-- /jam -->
  <!-- animasi text bergerak -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- /animasi text bergerak -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css')}}">
  <!-- leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
  <!-- leaflet -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/L.Control.Layers.Tree.css" crossorigin=""/>
  <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />  
</head>
<body class="hold-transition sidebar-mini" onload="realtimeClock()">
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
        <a style="color:white;font-size:18px" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-chevron-left"></i>
        &nbsp;&nbsp;&nbsp; <span id="typed" ></span></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="color:white;"></i>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 " style="color:white; ">ADMIN</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" >
          <a class="dropdown-item" href="/administrator/register">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400">
          </i>Tambah Akun</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="/administrator/sign_out">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
        </div>
      </li>
    </ul>

  </nav>
  <script>
  new Typed('#typed',{
    strings : ['SISTEM INFORMASI MANAJEMEN REKAYASA LALU LINTAS'],
    typeSpeed : 100,
    delaySpeed : 3000,
    loop : true,
    showCursor: false,
  });
  </script>
  <!-- /.navbar -->

  