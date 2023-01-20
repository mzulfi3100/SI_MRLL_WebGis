

  <!-- untuk memanggil file header.blade.php -->
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
                    <div class="h5 mb-0 font-weight-bold text-gray-800">30 </div>
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
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">11 </div>
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
                      <div class="text-xs font-weight-bold text-black text-uppercase mb-1">Jumlah Jalan Rawan Kecelakaan</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">16 </div>
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin/footer')