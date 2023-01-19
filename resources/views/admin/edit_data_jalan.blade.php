@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Data Jalan</h1>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="p-4">
        <form action="{{ route('jalan.update', $jalans->id ) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Jalan</label>
                <input type="text" class="form-control" id="namaJalan" name="namaJalan" value="{{ $jalans->namaJalan }}">
            </div>
            <div class="form-group">
                <label>Tipe Jalan</label>
                <input type="text" class="form-control" id="tipeJalan" name="tipeJalan" value="{{ $jalans->tipeJalan }}">
            </div>
            <div class="form-group">
                <label>Panjang Jalan</label>
                <input type="text" class="form-control" id="panjangJalan" name="panjangJalan" value="{{ $jalans->panjangJalan }}">
            </div>
            <div class="form-group">
                <label>Lebar Jalan</label>
                <input type="text" class="form-control" id="lebarJalan" name="lebarJalan" value="{{ $jalans->lebarJalan }}">
            </div>
            <div class="form-group">
                <label>Kapasitas Jalan</label>
                <input type="text" class="form-control" id="kapasitasJalan" name="kapasitasJalan" value="{{ $jalans->kapasitasJalan }}">
            </div>
            <div class="form-group">
                <label>Hambatan Samping</label>
                <input type="text" class="form-control" id="hambatanSamping" name="hambatanSamping" value="{{ $jalans->hambatanJalan }}">
            </div>
            <div class="form-group">
                <label>Kondisi Jalan</label>
                <input type="text" class="form-control" id="kondisiJalan" name="kondisiJalan" value="{{ $jalans->kondisiJalan }}">
            </div>
            <div class="form-group">
                <label>Tingkat Pelayanan Jalan</label>
                <input type="text" class="form-control" id="tingkatPelayananJalan" name="tingkatPelayananJalan" value="{{ $jalans->tinkatPelayananJalan }}">
            </div>
            <div id="map" style="height:500px; width: 900px;" class="mb-4"></div>
            <div class="form-group">
                <label>geoJSON Jalan</label>
                <input type="text" class="form-control" id="geoJsonJalan" name="geoJsonJalan" value="{{ $jalans->geoJsonJalan }}"></input>
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
            style: kabupatenStyle
        }).addTo(map);

        var overlaysTree = 
            {
                label: 'Layers',
                selectAllCheckbox: 'Un/select all',
                children: [
                    {label: '<div id="onlysel">-Show only selected-</div>'},
                    {
                        label: 'Kecamatan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($kecamatans as $kec)
                                {
                                    label: '<?= $kec->namaKecamatan ?>', layer: L.geoJSON(<?= $kec->batasKecamatan ?>, {
                                        style: {
                                            "color": "<?= $kec->warnaKecamatan ?>",
                                            "weight": 0,
                                            "opacity": 1,
                                            "fillOpacity": 0.5 ,
                                        },
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
                    expandAll: 'Expand all',
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
            drawMarker: false,
            drawRectangle: false,
            drawCircleMarker: false,
            drawText: false,
            cutPolygon: false,
            dragMode: false,
            rotateMode: false, 
        });
        
        map.on('pm:create', (e) => {
            var layer = e.layer;
            var data = e.layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonJalan').val(dataString);
            e.layer.on('pm:update', function (ed) {
                var layer = e.layer;
                var data = e.layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonJalan').val(dataString);
            });
        });

        const jalanSelected = L.geoJSON(<?= $jalans->geoJsonJalan ?>).addTo(map);  

        jalanSelected.on('pm:edit', function(e){
            var layer = e.layer;
            var data = e.layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonJalan').val(dataString);
        })

        map.on('pm:remove', (e) => {
            $('#geoJsonJalan').val("");
        })
    </script>
@stop
