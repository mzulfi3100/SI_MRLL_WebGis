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
        <div class="col-lg-6 align-self-center">
          <div class="header-text">
            <h6>Welcome to our school</h6>
            <h2>Best Place To Learn Graphic <em>Design!</em></h2>
            <div class="main-button-gradient">
              <div class="scroll-to-section"><a href="#contact-section">Join Us Now!</a></div>
            </div>
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

  <section class="services" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h6>Our Services</h6>
            <h4>Provided <em>Services</em></h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel">
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-01.png') }}" alt="">
                </div>
                <h4>Useful Tricks</h4>
                <p>EduWell is the professional HTML5 template for your school or university websites.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-02.png') }}" alt="">
                </div>
                <h4>Creative Ideas</h4>
                <p>You can download and use this EduWell Template for your teaching and learning stuffs.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-03.png') }}" alt="">
                </div>
                <h4>Ready Target</h4>
                <p>Please tell your friends about the best CSS template website that is TemplateMo.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-04.png') }}" alt="">
                </div>
                <h4>Technology</h4>
                <p>Aenean bibendum consectetur ex eu porttitor. Pellentesque id ultrices metus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-01.png') }}" alt="">
                </div>
                <h4>Useful Tricks</h4>
                <p>In non nisi eget magna efficitur ultricies non quis sapien. Pellentesque tellus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-02.png') }}" alt="">
                </div>
                <h4>Creative Ideas</h4>
                <p>Aenean bibendum consectetur ex eu porttitor. Pellentesque id ultrices metus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-03.png') }}" alt="">
                </div>
                <h4>Ready Target</h4>
                <p>In non nisi eget magna efficitur ultricies non quis sapien. Pellentesque tellus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-04.png') }}" alt="">
                </div>
                <h4>Technology</h4>
                <p>Aenean bibendum consectetur ex eu porttitor. Pellentesque id ultrices metus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-01.png') }}" alt="">
                </div>
                <h4>Useful Tricks</h4>
                <p>In non nisi eget magna efficitur ultricies non quis sapien. Pellentesque tellus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-02.png') }}" alt="">
                </div>
                <h4>Creative Ideas</h4>
                <p>Aenean bibendum consectetur ex eu porttitor. Pellentesque id ultrices metus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-03.png') }}" alt="">
                </div>
                <h4>Ready Target</h4>
                <p>In non nisi eget magna efficitur ultricies non quis sapien. Pellentesque tellus.</p>
              </div>
            </div>
            <div class="item">
              <div class="service-item">
                <div class="icon">
                  <img src="{{ asset('/eduwell/images/service-icon-04.png') }}" alt="">
                </div>
                <h4>Technology</h4>
                <p>Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading">
            <h6>OUR COURSES</h6>
            <h4>What You Can <em>Learn</em></h4>
            <p>You just think about TemplateMo whenever you need free CSS templates for your business website</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="naccs">
            <div class="tabs">
              <div class="row">
                <div class="col-lg-3">
                  <div class="menu">
                    <div class="active gradient-border"><span>Web Development</span></div>
                    <div class="gradient-border"><span>Graphic Design</span></div>
                    <div class="gradient-border"><span>Web Design</span></div>
                    <div class="gradient-border"><span>WordPress</span></div>
                  </div>
                </div>
                <div class="col-lg-9">
                  <ul class="nacc">
                    <li class="active">
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/courses-01.jpg') }}" alt="">
                          <div class="price"><h6>$128</h6></div>
                        </div>
                        <div class="right-content">
                          <h4>Web Development</h4>
                          <p>Did you know that you can visit <a rel="nofollow" href="https://www.toocss.com/" target="_blank">TooCSS website</a> for latest listing of HTML templates and a variety of useful templates. 
                          <br><br>You just need to go and visit that website right now. IF you have any suggestion or comment about this template, you can feel free to go to contact page for our email address.</p>
                          <span>36 Hours</span>
                          <span>4 Weeks</span>
                          <span class="last-span">3 Certificates</span>
                          <div class="text-button">
                            <a href="contact-us.html">Subscribe Course</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/courses-02.jpg') }}" alt="">
                          <div class="price"><h6>$156</h6></div>
                        </div>
                        <div class="right-content">
                          <h4>Creative Graphic Design</h4>
                          <p>You are not allowed to redistribute this template ZIP file on any other website without a permission from us.<br><br>There are some unethical people on this world copied and reposted our templates without any permission from us. Their Karma will hit them really hard. Yeah!</p>
                          <span>48 Hours</span>
                          <span>6 Weeks</span>
                          <span class="last-span">1 Certificate</span>
                          <div class="text-button">
                            <a href="contact-us.html">Subscribe Course</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/courses-03.jpg') }}" alt="">
                          <div class="price"><h6>$184</h6></div>
                        </div>
                        <div class="right-content">
                          <h4>Web Design</h4>
                          <p>Quinoa roof party squid prism sustainable letterpress cray hammock tumeric man bun mixtape tofu subway tile cronut. Deep v ennui subway tile organic seitan.<br><br>Kogi VHS freegan bicycle rights try-hard green juice probably haven't heard of them cliche la croix af chillwave.</p>
                          <span>28 Hours</span>
                          <span>4 Weeks</span>
                          <span class="last-span">1 Certificate</span>
                          <div class="text-button">
                            <a href="contact-us.html">Subscribe Course</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div>
                        <div class="left-image">
                          <img src="{{ asset('/eduwell/images/courses-04.jpg') }}" alt="">
                          <div class="price"><h6>$76</h6></div>
                        </div>
                        <div class="right-content">
                          <h4>WordPress Introduction</h4>
                          <p>Quinoa roof party squid prism sustainable letterpress cray hammock tumeric man bun mixtape tofu subway tile cronut. Deep v ennui subway tile organic seitan.<br><br>Kogi VHS freegan bicycle rights try-hard green juice probably haven't heard of them cliche la croix af chillwave.</p>
                          <span>48 Hours</span>
                          <span>4 Weeks</span>
                          <span class="last-span">2 Certificates</span>
                          <div class="text-button">
                            <a href="contact-us.html">Subscribe Course</a>
                          </div>
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

  <section class="simple-cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1">
          <div class="left-image">
            <img src="{{ asset('/eduwell/images/cta-left-image.png') }}" alt="">
          </div>
        </div>
        <div class="col-lg-5 align-self-center">
          <h6>Get the sale right now!</h6>
          <h4>Up to 50% OFF For 1+ courses</h4>
          <p>Kogi VHS freegan bicycle rights try-hard green juice probably haven't heard of them cliche la croix af chillwave.</p>
          <div class="white-button">
            <a href="contact-us.html">View Courses</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials" id="testimonials">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h6>Testimonials</h6>
            <h4>What They <em>Think</em></h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-testimonials owl-carousel" style="position: relative; z-index: 5;">
            <div class="item">
              <p>“just think about TemplateMo if you need free CSS templates for your website”</p>
                <h4>Catherine Walk</h4>
                <span>CEO &amp; Founder</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“think about our website first when you need free HTML templates for your website”</p>
                <h4>David Martin</h4>
                <span>CTO of Tech Company</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“just think about our website wherever you need free templates for your website”</p>
                <h4>Sophia Whity</h4>
                <span>CEO and Co-Founder</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                <h4>Helen Shiny</h4>
                <span>Tech Officer</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                <h4>George Soft</h4>
                <span>Gadget Reviewer</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                <h4>Andrew Hall</h4>
                <span>Marketing Manager</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                <h4>Maxi Power</h4>
                <span>Fashion Designer</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
            <div class="item">
              <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                <h4>Olivia Too</h4>
                <span>Creative Designer</span>
                <img src="{{ asset('/eduwell/images/quote.png') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div id="map" style="height:650px; width: 1050px;"></div>
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
                                                                '<td>' + '<a href="/administrator/jalan/<?= $titik->jalanKecamatanId ?>/show" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
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
                            @foreach($data as $jln)
                            {
                                label: '<?= $jln->namaJalan ?>',
                                layer: L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                    onEachFeature: function (feature, layer) {
                                        layer.bindTooltip('<?= $jln->namaJalan ?>');
                                        if('<?= $jln->tingkatKemacetan ?>' == "Rendah"){
                                            layer.setStyle({color :'#3CB043'});
                                        }else if('<?= $jln->tingkatKemacetan ?>' == "Sedang"){
                                                layer.setStyle({color :'#FFF200'});
                                        }else if('<?= $jln->tingkatKemacetan ?>' == "Tinggi"){
                                                layer.setStyle({color :'#FF0000'});
                                        }
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
                                                            '<th>Data Lalu Lintas</th>' +
                                                            '<tr>' +
                                                                '<td>Volume Lalu Lintas</td>' +
                                                                '<td>:' + '<?= $jln->volume ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kecepatan Tempuh</td>' +
                                                                '<td>:' + '<?= $jln->kecepatan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>' + '<a href="/administrator/jalan/<?= $jln->jalanKecamatanId ?>/show" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                            '</tr>' +
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
            }]
        }).addTo(map);

        L.control.browserPrint().addTo(map);

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