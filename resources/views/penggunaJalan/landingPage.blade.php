<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <title>SI MRLL</title>
    <link rel="icon" href="{!! asset('/Admin/dist/img/LogoDishub.png') !!}"/>

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
                      <a href="/" class="logo" >
                        <img src="{{('/Admin/dist/img/LogoDishub.png')}}"  style="width: 45px; height: 45px; font-size:16px; color:red;">&nbsp;&nbsp;Sistem Informasi MRLL</img>
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#home" class="active">Home</a></li>
                          <li class="scroll-to-section"><a href="#info-web">Info</a></li> 
                          <li class="scroll-to-section"><a href="#peta">Peta</a></li> 
                          <li class="border px-3 rounded border-white"><a href="login" >Login</a></li> 
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
  <section class="main-banner" id="home" >
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="header-text">
            <h6><b>SELAMAT DATANG DI</b></h6>&nbsp;
            <h3><b>Sistem Informasi </b></h3><h3><b>Manajemen Rekayasa Lalu Lintas</b></h3>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="# " alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->

  <section class="our-courses" id="info-web" style="margin-top: 140px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>Informasi Umum</h6>
            <h4>Deskripsi Terkait Sistem Informasi<em></em></h4>
            <p>Sebagai pengguna jalan diperlukan pengetahuan dan wawasan terkait beberapa informasi MRLL sebagai sarana pendukung transportasi dan kegiatan berkendara. </p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="tabs">
              <div class="row">
                <div class="col-lg-3">
                  <div class="menu">
                    <div class="active gradient-border"><span>MRLL</span></div>
                    <div class="gradient-border"><span>ATCS & APILL</span></div>
                    <div class="gradient-border"><span>Titik Kecelakaan</span></div>
                    <div class="gradient-border"><span>Titik Kemacetan</span></div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/p1.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                          <h4>MRLL</h4>
                          <p>MRLL digunakan untuk mendapatkan atau memberikan kondisi lalu lintas yang selancar dan seaman mungkin tanpa biaya yang besar bagi pergerakan manusia, barang dan jasa. Dengan kondisi jaringan dan lalu lintas yang memadai melalui system pengaturan, penataan dan regulasi.</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/p6.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                          <h4>ATCS</h4>
                          <p>Sistem Kendali Lalu lintas Kendaraan atau Area Traffic Control System adalah pengendalian lalu lintas dengan menyelaraskan waktu lampu merah pada jaringan jalan raya dari sebuah kota.</p>
                          <h4>APILL</h4>
                          <p>APILL merupakan peralatan yang menggunakan isyarat lampu untuk mengatur lalu lintas orang serta kendaraan di persimpangan atau pada ruas jalan.</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/p4.png') }}" alt="" >
                        </div>
                        <div class="right-content">
                          <h4>Titik Kecelakaan</h4>
                          <p>Lokasi rawan kecelakaan adalah suatu lokasi dimana angka kecelakaan tinggi dengan kejadian kecelakaan berulang dalam suatu ruang dan rentang waktu yang relatif sama yang diakibatkan oleh suatu penyebab tertentu.</p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/p5.jpg') }}" alt="">
                        </div>
                        <div class="right-content">
                          <h4>Titik Kemacetan</h4>
                          <p>Kemacetan Lalu lintas merupakan suatu keadaan kondisi jalan bila tidak ada keseimbangan antara kapasitas jalan dengan jumlah kendaraan yang lewat. Gejala ini ditandai dengan kecepatan yang rendah hingga terjadinya penumpukan kendaran, jarak antara kendaraan yang satu dengan kendaraan yang lain menjadi rapat, sehingga pengemudi tidak dapat menjalankan kendaraan dengan kecepatan yang diinginkannya.</p>
                        </div>
                      </div>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="peta" >
    <div class="container">
      <!-- <div class="section-heading" style >
      <center><h6>Peta</h6> </center>
      </div> -->
      <div class="row">
        <div class="col-lg-12">
          <div id="map" style="height:550px; width: 1050px;"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
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

        var macet = L.icon({
            iconUrl: '/macet.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var laka = L.icon({
            iconUrl: '/laka.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var atcs = L.icon({
            iconUrl: '/ATCS.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var apill = L.icon({
            iconUrl: '/apill.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41] 
        });

        var map = L.map('map', {
            layers: [street, hybrid, satellite],
            center: [-5.420000, 105.292969],
            zoom: 12.4
        });

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
            },
        ];

        var kabupatenJson;

        $.ajax({
            url: "/kabupaten.geojson",
            async: false,
            dataType: 'json',
            success: function(data){
                kabupatenJson = data
            }
        });

        var kabupatenStyle = {
            "color": '#000000',
            "weight": 2,
            "opacity": 1,
            "fillOpacity": 0 ,
        };

        var blue = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle
        }).addTo(map);

        var overlaysTree = 
            {
                label: 'Layers',
                selectAllCheckbox: 'Un/select all',
                children: [
                    {label: '<div id="onlysel">-Show only selected-</div>'},
                    {
                        label: "Apill",
                        selectAllCheckbox: true,
                        children: [
                            @foreach($apills as $apill)
                                {
                                    label: '<?= $apill->namaSimpang ?>',
                                    layer: L.geoJSON(<?= $apill->geoJsonApill ?>, {
                                        onEachFeature: function(feature, layer){
                                            layer.bindTooltip('<?= $apill->namaSimpang ?>');
                                            if('<?= $apill->terkoneksiATCS ?>' == 'Sudah'){
                                                layer.setIcon(atcs);
                                            }else{
                                                layer.setIcon(apill);
                                            }
                                        }
                                    }).addTo(map),
                                    name:   '<div style="max-height: 200px; overflow-y: auto"' +
                                                '<div class="card">' +
                                                    '<div class="card-header">' +
                                                        '<h3 class="card-title" style="text-align: center" >' + '<?= $apill->namaSimpang ?>' +'</h3>' +
                                                    '</div>' +
                                                    '<div class="card-body">' +
                                                        '<table class="table">' +
                                                            '<tbody>' +
                                                                '<tr>' +
                                                                    '<td>Terkoneksi ATCS</td>' +
                                                                    '<td>: ' + '<?= $apill->terkoneksiATCS ?>' + '</td>' +
                                                                '</tr>' +
                                                            '</tbody>' +
                                                        '</table>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' 
                                },
                            @endforeach
                        ]
                    },  {
                        label: 'Titik Kecelakaan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($titikLaka as $titik)
                            {
                                label: '<?= $titik->lokasiKecelakaan ?>',
                                layer: L.geoJSON(<?= $titik->geoJsonKecelakaan ?>, {
                                            onEachFeature: function(feature, layer){
                                                layer.bindTooltip('<?= $titik->lokasiKecelakaan ?>');
                                                layer.setIcon(laka);
                                            }
                                        }).addTo(map),
                                name:   '<div style="max-height: 200px;  max-width: 400px; overflow-y: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title" style="text-align: center" >' + '<?= $titik->lokasiKecelakaan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<table class="table">' +
                                                        '<tbody>' +
                                                            '<th>Data Jalan</th>' +
                                                            '<tr>' +
                                                                '<td>Nama Jalan</td>' +
                                                                '<td>:' + '<?= $titik->namaJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Tipe Jalan</td>' +
                                                                '<td>:' + '<?= $titik->tipeJalan ?>' + '</td>'+
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Panjang Jalan</td>' +
                                                                '<td>:' + '<?= $titik->panjangJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Lebar Jalan:</td>' +
                                                                '<td>:' + '<?= $titik->lebarJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kapasitas Jalan:</td>' +
                                                                '<td>:' + '<?= $titik->kapasitasJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Hambatan Samping</td>' +
                                                                '<td>:' + '<?= $titik->hambatanSamping ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kondisi Jalan</td>' +
                                                                '<td>:' + '<?= $titik->kondisiJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<th>Data Kecelakaan</th>' +
                                                            '<tr>' +
                                                                '<td>Penyebab Kecelakaan</td>' +
                                                                '<td>:' +" <?= $titik->penyebabKecelakaan ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Ringan</td>' +
                                                                '<td>:' +" <?= $titik->korbanLR ?>" +'</td>' + 
                                                             '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Berat</td>' +
                                                                '<td>:' +" <?= $titik->korbanLB ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Meninggal Dunia</td>' +
                                                                '<td>:' +" <?= $titik->korbanMD ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>' + '<a href="/detail_jalan/<?= $titik->jalanKecamatanId ?>" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                            '</tr>' +
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' 
                                        
                            },
                            @endforeach
                        ]
                    },  {
                        label: 'Titik Kemacetan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($titikMacet as $titik)
                            {
                                label: '<?= $titik->lokasiKemacetan ?>',
                                layer: L.geoJSON(<?= $titik->geoJsonKemacetan ?>, {
                                    onEachFeature: function(feature, layer){
                                        layer.bindTooltip('<?= $titik->lokasiKemacetan ?>');
                                        layer.setIcon(macet);
                                    }
                                }).addTo(map),
                                name:   '<div style="max-height: 200px;  max-width: 400px; overflow-x: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title" style="text-align: center" >' + '<?= $titik->lokasiKemacetan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<h8><b>Deskripsi Kemacetan</b></h8><br><br>' +
                                                    '<?= $titik->deskripsiKemacetan ?>' + 
                                                '</div>' +
                                            '</div>' +
                                        '</div>' 
                            },
                            @endforeach
                        ]
                    },  {
                        label: 'Jalan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($jalans as $jln)
                            {
                                label: '<?= $jln->namaJalan ?>',
                                layer: L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                    onEachFeature: function (feature, layer) {
                                        layer.bindTooltip('<?= $jln->namaJalan ?>');
                                        @foreach($data as $lalin)
                                            if('<?= $lalin->jalanKecamatanId ?>' == '<?= $jln->jalanKecamatanId ?>'){
                                                if('<?= $lalin->tingkatKemacetan ?>' == "Rendah"){
                                                layer.setStyle({color :'#3CB043'});
                                                }else if('<?= $lalin->tingkatKemacetan ?>' == "Sedang"){
                                                        layer.setStyle({color :'#FFF200'});
                                                }else if('<?= $lalin->tingkatKemacetan ?>' == "Tinggi"){
                                                        layer.setStyle({color :'#FF0000'});
                                                }
                                            }
                                        @endforeach
                                    }
                                }).addTo(map),
                                name:   '<div style="max-height: 200px; overflow-y: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title">' + '<?= $jln->namaJalan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<table class="table">' +
                                                        '<tbody>' +
                                                            '<th>Data Jalan</th>' +
                                                            '<tr>' +
                                                                '<td>Nama Jalan</td>' +
                                                                '<td>:' + '<?= $jln->namaJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Tipe Jalan</td>' +
                                                                '<td>:' + '<?= $jln->tipeJalan ?>' + '</td>'+
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Panjang Jalan</td>' +
                                                                '<td>:' + '<?= $jln->panjangJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Lebar Jalan:</td>' +
                                                                '<td>:' + '<?= $jln->lebarJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kapasitas Jalan:</td>' +
                                                                '<td>:' + '<?= $jln->kapasitasJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Hambatan Samping</td>' +
                                                                '<td>:' + '<?= $jln->hambatanSamping ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kondisi Jalan</td>' +
                                                                '<td>:' + '<?= $jln->kondisiJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            @foreach($data as $lalin)
                                                                <?php if($lalin->jalanKecamatanId ==  $jln->jalanKecamatanId){ ?>
                                                                '<th>Data Lalu Lintas</th>' +
                                                                        '<tr>' +
                                                                    '<td>Volume Lalu Lintas</td>' +
                                                                        '<td>:' + '<?= $lalin->volume ?>' +'</td>' +
                                                                    '</tr>' +
                                                                    '<tr>' +
                                                                        '<td>Kecepatan Tempuh</td>' +
                                                                        '<td>:' + '<?= $lalin->kecepatan ?>' +'</td>' +
                                                                    '</tr>' +
                                                                    '<tr>' +
                                                                        '<td>' + '<a href="/detail_jalan/<?= $jln->jalanKecamatanId ?>" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                                    '</tr>' +
                                                                <?php } ?>
                                                            @endforeach
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>'             
                            },
                            @endforeach
                        ]
                    }, {
                        label: 'Kecamatan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($kecamatans as $kec)
                                {
                                    label: '<?= $kec->namaKecamatan ?>', layer: L.geoJSON(<?= $kec->geoJsonKecamatan ?>, {
                                        style: {
                                            "color": "<?= $kec->warnaKecamatan ?>",
                                            "weight": 0,
                                            "opacity": 1,
                                            "fillOpacity": 0.5 ,
                                        },
                                    }),
                                    name: '<?= $kec->namaKecamatan ?>'
                                },
                            @endforeach
                        ]
                    },
                ]
            };

        

        var makePopups = function(node) {
            if (node.layer) {
                node.layer.bindPopup(node.name);
            }
            if (node.children) {
                node.children.forEach(function(element) { makePopups(element); });
            }
        };
        makePopups(overlaysTree);


        map.addControl(L.control.search({position: 'topleft'}));

        L.control.Legend({
            position: "bottomleft",
            collapsed: false,
            symbolWidth: 15,
            opacity: 1,
            column: 2,
            collapsed: true,
            legends: [{
                label: "Kemacetan Tinggi",
                type: "polyline",
                color: "#FF0000",
                weight: 2,
            },  {
                label: "Kemacetan Sedang",
                type: "polyline",
                color: "#FFF200",
                weight: 2,
            },  {
                label: "Kemacetan Rendah",
                type: "polyline",
                color: "#3CB043",
                weight: 2,
            },  {
                label: "Kemacetan Tidak Diketahui",
                type: "polyline",
                color: "lightblue",
                weight: 2,
            },  {
                label: "Rawan Laka",
                type: "image",
                url: '/laka.png',
            },  {
                label: "Titik Kemacetan",
                type: "image",
                url: '/macet.png',
            },  {
                label: "Terkoneksi ATCS",
                type: "image",
                url: "/ATCS.png"
            },  {
                label: "Tidak Terkoneksi ATCS",
                type: "image",
                url: "/apill.png"
            }]
        }).addTo(map);

        var lay = L.control.layers.tree(baseTree, overlaysTree, {
                    namedToggle: true,
                    selectorBack: false,
                    closedSymbol: '&#8862; &#x1f5c0;',
                    openedSymbol: '&#8863; &#x1f5c1;',
                    collapseAll: 'Collapse all',
                    collapsed: true,
                    position: 'topleft',
                });

        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
            L.DomEvent.on(L.DomUtil.get('onlysel'), 'click', function() {
            lay.collapseTree(true).expandSelected(true);
        });

        map.on("browser-print-start", function(e){
            /*on print start we already have a print map and we can create new control and add it to the print map to be able to print custom information */
            L.control.Legend({position: "bottomleft",
            collapsed: false,
            symbolWidth: 15,
            opacity: 1,
            column: 2,
            legends: [{
                label: "Kemacetan Tinggi",
                type: "polyline",
                color: "#FF0000",
                weight: 2,
            },  {
                label: "Kemacetan Sedang",
                type: "polyline",
                color: "#FFF200",
                weight: 2,
            },  {
                label: "Kemacetan Rendah",
                type: "polyline",
                color: "#3CB043",
                weight: 2,
            },  {
                label: "Rawan Laka",
                type: "image",
                url: '/laka.png',
            },  {
                label: "Titik Kemacetan",
                type: "img",
                url: '/macet.png',
            },  {
                label: "Terkoneksi ATCS",
                type: "image",
                url: "/ATCS.png"
            },  {
                label: "Tidak Terkoneksi ATCS",
                type: "image",
                url: "/apill.png"
            }]}).addTo(e.printMap);
        });

    </script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>

</html>