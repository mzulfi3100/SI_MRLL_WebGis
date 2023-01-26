@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Apill</h1>
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('apill.update', $apill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kecamatan</label>
                <select class="form-control" id="kecamatanId" name="kecamatanId">
                    @foreach($dataKec as $kec)
                        <?php if($kec->kecamatanId == $apill->kecamatanId){ ?>
                            <option value="<?= $kec->kecamatanId ?>"> - <?= $kec->namaKecamatan ?> - </option>
                        <?php } ?>
                    @endforeach
                    @foreach($dataKec as $kec)
                        <?php if($kec->kecamatanId == $apill->kecamatanId){ ?>

                        <?php }else{ ?>
                            <option value="<?= $kec->kecamatanId ?>"> <?= $kec->namaKecamatan ?> </option>
                        <?php } ?>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Jalan</label>
                <select class="form-control" id="jalanId" name="jalanId">
                    @foreach($data as $jln)
                        <?php if($jln->jalanId == $apill->jalanId && $jln->kecamatanId == $apill->kecamatanId){ ?>
                            <option value="<?= $jln->jalanId ?>"> - <?= $jln->namaJalan ?> - </option>
                        <?php } ?>
                    @endforeach
                    @foreach($data as $jln)
                        <?php if($jln->jalanId == $apill->jalanId){ ?>

                        <?php }else{ ?>
                            <option value="<?= $jln->jalanId ?>"> <?= $jln->namaJalan ?> </option>
                        <?php } ?>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama Simpang</label>
                <input type="text" class="form-control" name="namaSimpang" id="namaSimpang" value="{{ $apill->namaSimpang }}">
            </div>
            <div class="form-group">
                <label for="">Terkoneksi ATCS</label>
                <select class="form-control" name="terkoneksiATCS" id="terkoneksiATCS" value="{{ $apill->terkoneksiATCS }}">
                    <?php if($apill->terkoneksiATCS == 'Belum'){ ?>
                        <option value="Belum">- Belum -</option>
                    <?php }else{ ?>
                        <option value="Sudah">- Sudah -</option>
                    <?php } ?>

                    <?php if($apill->terkoneksiATCS == 'Belum' ){ ?>
                        <option value="Sudah">Sudah</option>
                    <?php }else{ ?>
                        <option value="Belum">Belum</option>
                    <?php } ?>
                </select>
            </div>
            <div id="map" style="width:900px; height:500px" class="mb-4"></div>
            <div class="form-group">
                <label for="">Geo Json Apill</label>
                <input type="text" class="form-control" name="geoJsonApill" id="geoJsonApill" value="{{ $apill->geoJsonApill }}"></input>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop
@section('script_peta')
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

        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle, 
            pmIgnore: true,
        }).addTo(map);

        var overlaysTree = 
            {
                label: 'Layers',
                selectAllCheckbox: 'Un/select all',
                children: [
                    {label: '<div id="onlysel">-Show only selected-</div>'},
                    {
                        label: 'Jalan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($jalans as $jln)
                                {
                                    label: '<?= $jln->namaJalan ?>', layer: L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                        pmIgnore: true,
                                    })
                                },
                            @endforeach
                        ]
                    },  {
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
                                        pmIgnore: true,
                                    })
                                },
                            @endforeach
                        ]
                    },
                ]
            };

        
            var lay = L.control.layers.tree(baseTree, overlaysTree, {
                    namedToggle: true,
                    selectorBack: false,
                    closedSymbol: '&#8862; &#x1f5c0;',
                    openedSymbol: '&#8863; &#x1f5c1;',
                    collapseAll: 'Collapse all',
                    collapsed: false,
                });        

        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
        L.DomEvent.on(L.DomUtil.get('onlysel'), 'click', function() {
            lay.collapseTree(true).expandSelected(true);
        });

        // add Leaflet-Geoman controls with some options to the map  
        map.pm.addControls({  
            position: 'topleft',  
            drawCircle: false,
            drawMarker: true,
            drawRectangle: false,
            drawCircleMarker: false,
            drawPolyline: false,
            drawPolygon: false,
            drawText: false,
            cutPolygon: false,
            dragMode: false,
            rotateMode: false, 
        });

        var getJalanGroup = new L.LayerGroup();
        var getKecamatanGroup = new L.LayerGroup();
        var getJalanLayer;
        var getKecamatanLayer;

        getJalanGroup.addTo(map);
        getKecamatanGroup.addTo(map);

        @foreach($kecamatans as $kec)
            if('<?= $kec->id ?>' == '<?= $apill->kecamatanId ?>'){
                getKecamatanLayer = L.geoJSON(<?= $kec->geoJsonKecamatan ?>,{
                    style: {
                        'fillOpacity': '0',
                    },
                    pmIgnore: true,
                }).addTo(getKecamatanGroup);
            }
        @endforeach

        @foreach($jalans as $jln)
            if('<?= $jln->id ?>' == '<?= $apill->jalanId ?>'){
                getJalanLayer = L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                    pmIgnore: true,
                }).addTo(getJalanGroup);
            }
        @endforeach

        //inisialisasi layergroup tempat menyimpan layer jalan yang dipilih
        var jalanGroup = new L.LayerGroup();
        var kecamatanGroup = new L.LayerGroup();
        var jalanSelected;
        var kecamatanSelected;
        

        //mengambil data jalan pada kecamatan yang diinputkan
        $('#kecamatanId').on('input', function() {
            getKecamatanGroup.removeLayer(getKecamatanLayer);
            $('#jalanId').empty();
            $('#jalanId').append($("<option>", {
                text: "- Pilih Jalan -",
            }));
            kecamatanGroup.addTo(map);
            var kecamatanId = this.value;
            @foreach($kecamatans as $kec)
                if('<?= $kec->id ?>' == kecamatanId){
                    kecamatanSelected = L.geoJSON(<?= $kec->geoJsonKecamatan ?>, {
                        style: {
                            'fillOpacity': '0',
                        },
                        pmIgnore: true,
                    }).addTo(kecamatanGroup);
                }
            @endforeach
            @foreach($data as $jln)
                if(<?= $jln->kecamatanId ?>== kecamatanId ){
                    $('#jalanId').append($("<option>", {
                        value: <?= $jln->jalanId ?>,
                        text: "<?= $jln->namaJalan ?>",
                    }));
                }
            @endforeach
        })

        //menghapus layer jalan jika mouse mengarah ke select jalan
        $('#kecamatanId').mouseenter(function() {
            if(kecamatanSelected != null){
                kecamatanGroup.removeLayer(kecamatanSelected);
            }
        });

        //mengambil id jalan yang diinputkan
        $('#jalanId').on('input', function() {
            getJalanGroup.removeLayer(getJalanLayer);
            jalanGroup.addTo(map);
            jalanId = this.value;
            @foreach($jalans as $jln)
                if('<?= $jln->id ?>' == jalanId){
                    jalanSelected = L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                        pmIgnore: true,
                    }).addTo(jalanGroup);
                }
            @endforeach
        });

        //menghapus layer jalan jika mouse mengarah ke select jalan
        $('#jalanId').mouseenter(function() {
            if(jalanSelected != null){
                jalanGroup.removeLayer(jalanSelected);
            }
        });
        
        map.on('pm:create', (e) => {
            var layer = e.layer;
            var data = e.layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonApill').val(dataString);
            e.layer.on('pm:update', function (ed) {
                var layer = e.layer;
                var data = e.layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonApill').val(dataString);
            });
        });
        
        var green = L.icon({
            iconUrl: '/marker-green.png',
            iconSize: [38, 30],
        });

        var red = L.icon({
            iconUrl: '/marker-red.png',
            iconSize: [38, 30],
        });
        
        const apillSelected = L.geoJSON(<?= $apill->geoJsonApill ?>, {
            onEachFeature: function (feature, layer) {
                layer.bindTooltip('<?= $apill->namaSimpang ?>');
                if('<?= $apill->terkoneksiATCS ?>' == 'Sudah'){
                    layer.setIcon(green);
                }else{
                    layer.setIcon(red);
                }
            }
        }).addTo(map);  
        
        apillSelected.on('pm:edit', function(e){
            var layer = e.layer;
            var data = e.layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonApill').val(dataString);
        })

        map.on('pm:remove', (e) => {
            $('#geoJsonApill').val("");
        })
    </script>
@stop