<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
<title>Landing Page</title>

<script src="{{'/Assets/js/js/jam.js'}}"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<link rel="stylesheet" href="Assets/css/style.css" type="text/css">
</head>

<div id="preloder">
        <div class="loader"></div>]
    </div>

<body class="img-bg" onload="realtimeClock()"> 
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboardPenggunaJalan"><img src="{{('/Admin/dist/img/LogoDishub.png')}}" width="28" height="31"/>&nbsp;&nbsp;<b>Sistem Informasi Manajemen Rekayasa Lalu Lintas</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    </div>
    <ul class="navbar-nav me-auto mb-0 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link btn btn-outline-info" href="#" style="color:white">About Us</a>
        </li>
        <li>&nbsp;</li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-info" href="#" style="color:white">Contact Admin</a>
        </li>
        <li>&nbsp;</li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-info" href="/login" style="color:white">Login</a>
        </li>
        <li>&nbsp;</li>
      </ul>
  </div>
</nav>
<div class="test1"><?php
$hari=date('l');
$bulan=date('m');
switch ($hari) {
 case"Sunday":$hari="Minggu";break;
 case"Monday":$hari="Senin";break;
 case"Tuesday":$hari="Selasa";break;
 case"Wednesday":$hari="Rabu";break;
 case"Thursday":$hari="Kamis";break;
 case"Friday":$hari="Jumat";break;
 case"Saturday":$hari="Sabtu";break;
}

switch($bulan){
 case"1":$bulan="Januari";break;
 case"2":$bulan="Februari";break;
 case"3":$bulan="Maret";break;
 case"4":$bulan="April";break;
 case"5":$bulan="Mei";break;
 case"6":$bulan="Juni";break;
 case"7":$bulan="Juli";break;
 case"8":$bulan="Agustus";break;
 case"9":$bulan="September";break;
 case"10":$bulan="Oktober"; break;
 case"11":$bulan="Nopember";break;
 case"12":$bulan="Desember";break;
}
//menampilkan format hari dalam bahasa indonesia
$tanggal=date('d');
$tahun=date('Y');
//menampilkan hari tanggal bulan dan tahun
echo "&nbsp;$hari, $tanggal&nbsp;$bulan&nbsp;$tahun&nbsp;"; 
?><label id="clock"></label></div>
  <!-- <section> begin ============================-->
    <section class="pt-5 pt-md-9 mb-6" id="feature">
      <div class="container">
        <h3 class="fs-9 fw-bold mb-4 text-center"> Selamat Datang Di Sistem Informasi Manajemen Rekayasa Lalu Lintas <br class="d-none d-xl-block" /> Silahkan Pilih Menu Di Bawah Ini</h3>
        <div class="row">
          <div class="col-lg-3 col-sm-6 mb-2"> <img class="#" />
          <h4 class="mb-3">&nbsp;</h4>
          <p class="mb-0 fw-medium text-secondary">&nbsp;</p>
        </div>
        <div class="col-lg-3 col-sm-6 mb-2">
          <h4 class="mb-3"><a href="#">Peta Rawan Kemacetan</a></h4>
          <p class="mb-0 fw-medium text-secondary">Menampilkan Pemetaan Jalan Yang Rawan Macet Di Sekitar Kota Bandar Lampung</p>
        </div>
        <div class="col-lg-3 col-sm-6 mb-2" href="#">
          <h4 class="mb-3"><a href="#">Peta Rawan Kecelakaan</a></h4>
          <p class="mb-0 fw-medium text-secondary">Menampilkan Pemetaan Jalan Yang Rawan Laka Lantas Di Sekitar Kota Bandar Lampung</p>
        </div>
        <div class="col-lg-3 col-sm-6 mb-2"> <img class="#" />
          <h4 class="mb-3">&nbsp;</h4>
          <p class="mb-0 fw-medium text-secondary">&nbsp;</p>
        </div>
      </div><!-- end of .container-->
    </section>
  </body>

<!-- Js Plugins -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{('/Assets/js/js/bootstrap.min.js')}}"></script>
    <script src="{{('/Assets/js/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{('/Assets/js/js/jquery-ui.min.js')}}"></script>
    <script src="{{('/Assets/js/js/jquery.slicknav.js')}}"></script>
    <script src="{{('/Assets/js/js/mixitup.min.js')}}"></script>
    <script src="{{('/Assets/js/js/owl.carousel.min.js')}}"></script>
    <script src="{{('/Assets/js/js/main.js')}}"></script>
    <script src="https://kit.fontawesome.com/72ae031378.js" crossorigin="anonymous"></script>

</html>
