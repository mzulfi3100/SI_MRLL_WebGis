@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Apill</h1>
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('apill.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="">Nama Simpang</label>
                <input type="text" class="form-control" name="namaSimpang" id="namaSimpang">
            </div>
            <div class="form-group">
                <label for="">Terkoneksi ATCS</label>
                <select class="form-control" name="terkoneksiATCS" id="terkoneksiATCS">
                    <option value="">- Pilih -</option>
                    <option value="Belum">Belum</option>
                    <option value="Sudah">Sudah</option>
                </select>
            </div>
            <div id="map" style="width:900px; height:500px" class="mb-4"></div>
            <div class="form-group">
                <label for="">Geo Json Apill</label>
                <textarea type="text" class="form-control" name="geoJsonApill" id="geoJsonApill"></textarea>
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
            layers: [satellite, hybrid, street],
            center: [-5.420000, 105.292969],
            zoom: 12.4,
        })

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
            "color": "#000000",
            "weight": 2,
            "opacity": 1,
            "fillOpacity": 0,
        };

        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle, 
            pmIgnore: true,
        }).addTo(map);

        var overlaysTree = {
            label: 'Layers',
            selectAllCheckbox: 'Un/select all',
            children: [
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
            collapseAll: 'Collapse All',
            collapsed: false,
        });

        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

        map.pm.addControls({
            position: 'topleft',
            drawCircle: false,
            drawMarker: true,
            drawRectangle: false,
            drawCircleMarker: false,
            drawText: false,
            cutPolygon: false,
            dragMode: false,
            rotateMode: false, 
            drawPolyline: false,
            drawPolygon: false,
        });

        map.on('pm:create', (e)=> {
            var layer = e.layer;
            var data = layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonApill').val(dataString);
            e.layer.on('pm:update', (ed)=> {
                var layer = e.layer;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonApill').val(dataString);
            })
        })

        map.on('pm:remove', (e)=> {
            $('#geoJsonApill').val('');
        })
    </script>
@stop