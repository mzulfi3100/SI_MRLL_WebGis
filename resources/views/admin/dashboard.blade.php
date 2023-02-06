

  <!-- untuk memanggil file header.blade.php -->
  <?php $title="Dashboard"?>
  @include('admin/header')

  <!-- untuk memanggil file sidebar.blade.php -->
  @include('admin/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
              <div class="card-body" >
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Jalan</div>
                    <?php
                      $count = 0;
                    ?>
                    @foreach($jalans as $jln)
                      <?php
                        $count++;
                      ?>
                    @endforeach
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count ?> </div>
                  </div>
                  <div class="col-auto">
                    <i class= "fas fa-fw fa-road fa-3x text-gray-300" ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Menampilkan Jumlah Kecamatan -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
              <div class="card-body" >
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Kecamatan</div>
                      <?php
                        $count = 0;
                      ?>
                      <div class="row no-gutters align-items-center">
                        @foreach($kecamatans as $kec)
                          <?php
                            $count++;
                          ?>
                        @endforeach
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?= $count ?>  </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-landmark fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Menampilkan Jumlah Jalan Rawan Kemacetan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card shadow h-100 py-2" style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Jalan Rawan Kemacetan</div>
                      <div class="row no-gutters align-items-center">
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
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count ?> </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-car-side fa-3x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Menampilkan Jumlah Jalan Rawan Kecelakaan -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card shadow h-100 py-2" style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
                <div class="card-body" >
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Titik Rawan Kecelakaan</div>
                      <div class="row no-gutters align-items-center">
                        <?php
                          $count = 0;
                        ?>
                        @foreach($kecelakaan as $laka)
                          <?php
                            $count++;
                          ?>
                        @endforeach
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count ?> </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-fw fa-car-crash fa-3x text-gray-300"></i>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- /.row -->
       <div class="row">
          <!-- Menampilkan Jumlah Apill -->
          <div class="col-xl-3 col-md-6 mb-4 ml-3">
            <div class="card shadow h-100 py-2" style="background-color: #7ddef2; background-image: linear-gradient(0deg, #7ddef2 0%, #1474f5 100%);">
              <div class="card-body" >
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Apill (ATCS) </div>
                    <div class="row no-gutters align-items-center">
                      <?php
                        $count = 0;
                      ?>
                      @foreach($apill as $apil)
                        <?php
                          if($apill->terkoneksiATCS  = "Sudah"){
                            $count++;
                          }
                        ?>
                      @endforeach
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count ?> </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-fw fa-traffic-light fa-3x text-gray-300"></i>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       </div>
      </div><!-- /.container-fluid -->
      <!-- <div id="bca"></div> -->
    </div>
    <!-- /.content -->\
    </div>
  <!-- /.content-wrapper -->
  <script src="https://code.highcharts.com/highcharts.js"></script>

<script>
  Highcharts.chart('bca', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Data Volume Lalu Lintas dan Kemacetan 2023'
    }, 
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Frekuensi Data'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Kecelakaan',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
            194.1, 95.6, 54.4]

    }, {
        name: 'Kemacetan',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
            106.6, 92.3]

    },]
  });
</script>

  @include('admin/footer')