<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    
    <title>EduWell - Education HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/eduwell/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('/eduwell/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset('/eduwell/css/templatemo-eduwell-style.css')}}">
    <link rel="stylesheet" href="{{ asset('/eduwell/css/owl.css')}}">
    <link rel="stylesheet" href="{{ asset('/eduwell/css/lightbox.css')}}">
    
    <!-- leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="/L.Control.Layers.Tree.css" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />  
    <link rel="stylesheet" href="/leaflet.legend.css" crossorigin=""/>

<!--

TemplateMo 573 EduWell

https://templatemo.com/tm-573-eduwell

-->
  </head>
  <body>
    <!-- ***** Header Area Start ***** -->
   <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.html" class="logo">
                        <img src="{{('/Admin/dist/img/LogoDishub.png')}}" alt="LogoDishub" style="width: 45px; height: 45px;"></img>
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                          <li class="scroll-to-section"><a href="#services">Services</a></li>
                          <li class="scroll-to-section"><a href="#courses">Courses</a></li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">Pages</a>
                              <ul class="sub-menu">
                                  <li><a href="about-us.html">About Us</a></li>
                                  <li><a href="our-services.html">Our Services</a></li>
                                  <li><a href="contact-us.html">Contact Us</a></li>
                              </ul>
                          </li>
                          <li class="scroll-to-section"><a href="#testimonials">Testimonials</a></li> 
                          <li class="scroll-to-section"><a href="#contact-section">Contact Us</a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
    </header>
  <!-- ***** Header Area End ***** -->
    <section class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">
                        <h3>Detail Jalan</h3>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Peta Jalan</h3>
                            <div class="card-tools">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="map" style="height:550px; width: 1000px;" class="mb-4"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Jalan</h3>
                                <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama Jalan</td>
                                        <td>: <?= $jalan->namaJalan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tipe Jalan</td>
                                        <td>: <?= $jalan->tipeJalan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Panjang Jalan</td>
                                        <td>: <?= $jalan->panjangJalan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lebar Jalan:</td>
                                        <td>: <?= $jalan->lebarJalan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kapasitas Jalan:</td>
                                        <td>: <?= $jalan->kapasitasJalan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hambatan Samping</td>
                                        <td>: <?= $jalan->hambatanSamping ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kondisi Jalan</td>
                                        <td>: <?= $jalan->kondisiJalan ?></td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div>
                            <div class="card card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <h3 class="card-title mt-2 ml-4">Data Lalu Lintas</h3>
                                </div>
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <?php $count = 0 ?>
                                        @foreach($lalulintas as $lalin)
                                        <?php if($count == 0){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-one-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-one-<?= $count ?>" role="tab" aria-controls="custom-tabs-one-<?= $count ?>" aria-selected="true"><?= $lalin->tahun ?></a>
                                            </li>
                                        <?php }else{ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-one-<?= $count ?>" role="tab" aria-controls="custom-tabs-one-<?= $count ?>" aria-selected="false"><?= $lalin->tahun ?></a>
                                            </li>
                                        <?php } ?>
                                        <?php $count++ ?>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <?php $count = 0 ?>
                                    @foreach($lalulintas as $lalin)
                                    <?php if($count == 0){ ?>
                                        <div class="tab-pane fade show active" id="custom-tabs-one-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-one-<?= $count ?>-tab">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Volume Lalu Lintas</td>
                                                        <td>: <?= $lalin->volume ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecepatan Tempuh</td>
                                                        <td>: <?= $lalin->kecepatan ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="tab-pane fade" id="custom-tabs-one-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-one-<?= $count ?>-tab">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Volume Lalu Lintas</td>
                                                        <td>: <?= $lalin->volume ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecepatan Tempuh</td>
                                                        <td>: <?= $lalin->kecepatan ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                    <?php $count++ ?>
                                    @endforeach
                                    </div>
                                </div>
                            <!-- /.card -->
                            </div>
                        </div>
                        <div>
                            <div class="card card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <h3 class="card-title mt-2 ml-4">Data Kecelakaan</h3>
                                </div>
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                        <?php $count = 0 ?>
                                        @foreach($kecelakaan as $laka)
                                        <?php if($count == 0){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-two-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-two-<?= $count ?>" role="tab" aria-controls="custom-tabs-two-<?= $count ?>" aria-selected="true"><?= $laka->tahunKecelakaan ?></a>
                                            </li>
                                        <?php }else{ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-two-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-two-<?= $count ?>" role="tab" aria-controls="custom-tabs-two-<?= $count ?>" aria-selected="false"><?= $laka->tahunKecelakaan ?></a>
                                            </li>
                                        <?php } ?>
                                        <?php $count++ ?>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <?php $count = 0 ?>
                                    @foreach($kecelakaan as $laka)
                                    <?php if($count == 0){ ?>
                                        <div class="tab-pane fade show active" id="custom-tabs-two-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-two-<?= $count ?>-tab">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Korban Meninggal Dunia</td>
                                                        <td>: <?= $laka->korbanMD ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Korban Luka Berat</td>
                                                        <td>: <?= $laka->korbanLB ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Korban Luka Ringan</td>
                                                        <td>: <?= $laka->korbanLR ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Kecelakaan</td>
                                                        <td>: <?= $laka->jumlahKecelakaan ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="tab-pane fade" id="custom-tabs-two-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-two-<?= $count ?>-tab">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Korban Meninggal Dunia</td>
                                                        <td>: <?= $laka->korbanMD ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Korban Luka Berat</td>
                                                        <td>: <?= $laka->korbanLB ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Korban Luka Ringan</td>
                                                        <td>: <?= $laka->korbanLR ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Kecelakaan</td>
                                                        <td>: <?= $laka->jumlahKecelakaan ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                    <?php $count++ ?>
                                    @endforeach
                                    </div>
                                </div>
                            <!-- /.card -->
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('/eduwell/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/eduwell/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('/eduwell/js/isotope.min.js')}}"></script>
    <script src="{{ asset('/eduwell/js/owl-carousel.js')}}"></script>
    <script src="{{ asset('/eduwell/js/lightbox.js')}}"></script>
    <script src="{{ asset('/eduwell/js/tabs.js')}}"></script>
    <script src="{{ asset('/eduwell/js/video.js')}}"></script>
    <script src="{{ asset('/eduwell/js/slick-slider.js')}}"></script>
    <script src="{{ asset('/eduwell/js/custom.js')}}"></script>

    <!-- leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="/L.Control.Layers.Tree.js"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
    <script src="/leaflet.legend.js"></script>
    <script src="/leaflet.browser.print.min.js"></script>

    <script type="text/javascript">
        // Tile Layers
        var satellite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });

        var street = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });

        var hybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
        // End Tile Layaers

        // Inisialisasi map
        var map = L.map('map', {
            layers: [satellite, hybrid, street], //base layers
            center: [-5.420000, 105.292969], //koordinat bandar lampung
            zoom: 12.4,
        });

        // Add Kabupaten to Map

        var kabupatenJson; //inisialisasi 

        // mengambil data geojson kabupaten
        $.ajax({
            url: "/kabupaten.geojson",
            async: false,
            dataType: 'json',
            success:function(data){
                kabupatenJson = data
            }
        })
        
        // style batas kabupaten
        var kabupatenStyle = {
            "color": "#000000",
            "weight": 2,
            "opacity": 1,
            "fillOpacity": 0,
        };

        // tambah batas kabupaten ke map
        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle,
            pmIgnore: true,
        }).addTo(map);

        // Base Layers Group
        var baseTree = [
            {
                label: 'Street',
                layer: street,
            },
            {
                label: 'Hybrid',
                layer: hybrid,
            },
            {
                label: 'Satellite',
                layer: satellite,
            }
        ];

        // Overlayers Group
        var overlaysTree = {
        };

        // Layer Controls
        var lay = L.control.layers.tree(baseTree, overlaysTree, {
            namedToggle: true,
            selectorBack: false,
            closedSymbol: '&#8862; &#x1f5c0;',
            openedSymbol: '&#8863; &#x1f5c1;',
            collapsed: false,
        });

        //menambahkan layer control tree ke map
        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

        // menampilkan batas kecamatan yang dipilih

        L.geoJSON(<?= $jalan->geoJsonKecamatan ?>, {
            style: {
                'fillOpacity': '0',
            },
            pmIgnore: true,
        }).addTo(map);

        L.geoJSON(<?= $jalan->geoJsonJalan ?>, {
            style: {
                'fillOpacity': '0',
            },
            pmIgnore: true,
        }).addTo(map);
    </script>
  </body>

</html>