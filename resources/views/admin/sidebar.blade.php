<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-dark bg-blue elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{('/Admin/dist/img/LogoDishub.png')}}" alt="LogoDishub" class="brand-image img-circle elevation-3" style="opacity: .9">
      <span class="brand-text font-weight-light">MRLL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
        <div class="sidebar-heading" style="font-size:14px;color:black;"><b>
            ADMIN</b>
        </div>
        <!-- Menu Kelola Data Kecamatan -->
        <li class="nav-item">
            <a href="/kecamatan" class="nav-link">
            <i class="fas fa-landmark" style="color:black"></i>
              <p style="color:white;">
              &nbsp;&nbsp;Data Kecamatan
              </p>
            </a>
          </li>

          <!-- Menu Kelola Data Apill -->
          <li class="nav-item">
            <a href="/administrator/apill" class="nav-link">
            <i class="fas fa-traffic-light" style="color:black"></i>
              <p style="color:white">
              &nbsp;&nbsp;&nbsp;Data APILL
              </p>
            </a>
          </li>

          <!-- Menu Kelola Data Jalan -->
          <li class="nav-item">
            <a href="/administrator/jalan" class="nav-link">
            <i class="fas fa-road" style="color:black"></i>
              <p style="color:white">
              &nbsp;&nbsp;Data Jalan
              </p>
            </a>
          </li>

          <!-- Menu Kelola Data Lalu Lintas -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-car-side" style="color:black"></i>
              <p style="color:white">
              &nbsp;&nbsp;Lalu Lintas
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrator/lalulinta" class="nav-link">
                  <i class="far fa-circle" style="color:black"></i>
                  <p style="color:white">
                  &nbsp;&nbsp;Data Lalu Lintas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/administrator/titik_kemacetan" class="nav-link">
                  <i class="far fa-circle" style="color:black"></i>
                  <p style="color:white">
                  &nbsp;&nbsp;Data Titik Kemacetan
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Menu Kelola Data Kecelakaan -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-car-crash" style="color:black"></i>
              <p style="color:white">
              &nbsp;&nbsp;Kecelakaan
              <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/administrator/kecelakaan" class="nav-link">
                <i class="far fa-circle" style="color:black"></i>
                  <p style="color:white">
                  &nbsp;&nbsp;Data Kecelakaan
                </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/administrator/titik_kecelakaan" class="nav-link">
                  <i class="far fa-circle" style="color:black"></i>
                  <p style="color:white">
                  &nbsp;&nbsp;Data Titik Kecelakaan
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <div class="sidebar-heading" style="font-size:14px;color:black;"><b>
            PETA</b>
          </div>
          <!-- Menu Melihat Peta Rawan Kemacetan-->
          <li class="nav-item">
            <a href="/administrator/peta_kemacetan" class="nav-link">
            <i class="fas fa-map-marked-alt" style="color:red"></i>
              <p style="color:white">
              &nbsp;&nbsp;Peta Rawan Kemacetan
              </p>
            </a>
          </li>

          <!-- Menu Melihat Peta Rawan Kecelakaan-->
          <li class="nav-item">
            <a href="/administrator/peta_kecelakaan" class="nav-link">
            <i class="fas fa-map-marked-alt" style="color:yellow"></i>
              <p style="color:white;">
              &nbsp;&nbsp;Peta Rawan Kecelakaan
              </p>
            </a>
          </li>

          <!-- Menu Melihat Peta APILL-->
          <li class="nav-item">
            <a href="/administrator/peta_apill" class="nav-link">
            <i class="fas fa-map-marked-alt" style="color:green"></i>
              <p style="color:white;">
              &nbsp;&nbsp;Peta APILL
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    
    <!-- /.sidebar -->
  </aside>