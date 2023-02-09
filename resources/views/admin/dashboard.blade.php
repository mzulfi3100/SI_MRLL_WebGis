

  <!-- untuk memanggil file header.blade.php -->
  <?php $title="Dashboard"?>
  @extends('admin/template')
  @section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.row -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a id="clock"></a></li>
            </ol>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a >
              <?php $hari=date('l');
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
              
              //menampilkan format hari dalam bahasa indonesia
              $tanggal=date('d');
              $tahun=date('y');
              //menampilkan hari tanggal bulan dan tahun
              echo "$hari, $tanggal/$bulan/$tahun&nbsp;|&nbsp;"; 
              ?></a></li>
              </ol>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            @yield('content')
            <!-- Menampilkan Jumlah Jalan -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box"  style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                  <div class="inner">
                  <?php
                      $count = 0;
                    ?>
                    @foreach($jalans as $jln)
                      <?php
                        $count++;
                      ?>
                    @endforeach
                    <h3><?= $count ?></h3>
                    <p><b>Jumlah Jalan</b></p>
                  </div>
                  <div class="icon">
                  <i class= "fas fa-fw fa-road fa-2x text-gray-300" ></i>
                  </div>
                  <a href="/administrator/jalan" class="small-box-footer">Selengkapnya&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              
              <div class="col-lg-3 col-6">
                <div class="small-box "  style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                  <div class="inner">
                  <?php
                        $count = 0;
                      ?>
                        @foreach($kecamatans as $kec)
                          <?php
                            $count++;
                          ?>
                        @endforeach
                    <h3><?= $count ?></h3>
                    <p><b>Jumlah Kecamatan</b></p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-fw fa-landmark fa-2x text-gray-300"></i>
                  </div>
                  <a href="/kecamatan" class="small-box-footer">Selengkapnya&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              
              <div class="col-lg-3 col-6">
                <div class="small-box"  style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                  <div class="inner">
                  <?php
                          $count = 0;
                        ?>
                        @foreach($kemacetan as $macet)
                          <?php
                            if($macet->tingkatKemacetan == 'Tinggi'){
                              $count++;
                            }
                          ?>
                        @endforeach
                    <h3><?= $count ?></h3>
                    <p><b>Rawan Kemacetan</b></p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-fw fa-car-side fa-2x text-gray-300"></i>
                  </div>
                  <a href="/administrator/lalulinta" class="small-box-footer">Selengkapnya&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              
              <div class="col-lg-3 col-6">
                <div class="small-box"  style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                  <div class="inner">
                  <?php
                          $count = 0;
                        ?>
                        @foreach($kecelakaan as $laka)
                          <?php
                            $count++;
                          ?>
                        @endforeach
                    <h3><?= $count ?></h3>
                    <p><b>Rawan Kecelakaan</b></p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-fw fa-car-crash fa-2x text-gray-300"></i>
                  </div>
                  <a href="/administrator/titik_kecelakaan" class="small-box-footer">Selengkapnya&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box "  style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                  <div class="inner">
                  <?php
                        $count = 0;
                      ?>
                      @foreach($apill as $apil)
                        <?php
                          if($apil->terkoneksiATCS  == "Sudah"){
                            $count++;
                          }
                        ?>
                      @endforeach
                    <h3><?= $count ?></h3>
                    <p><b>Jumlah Apill (ATCS)</b></p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-fw fa-traffic-light fa-2x text-gray-300"></i>
                  </div>
                  <a href="/administrator/apill" class="small-box-footer">Selengkapnya&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->
          <!-- <div id="bca"></div> -->
        </div>
        <!-- /.content -->
        
      </div>
      
    </div>
    <footer class="main-footer">
      Copyright &copy; 2023<strong> Universitas Lampung.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
      </div>
  </footer>
  <!-- /.content-wrapper -->
  @stop