@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data APILL</h1>
            </div>
            <!-- Tampil Tanggal dan Jam -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a id="clock"></a></li>
                </ol>
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a >
                <?php 
                $hari=date('l');
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
                //menampilkan translate hari ke bahasa indonesia
                $tanggal=date('d');
                $tahun=date('y');
                //menampilkan hari tanggal bulan dan tahun
                echo "$hari, $tanggal/$bulan/$tahun&nbsp;|&nbsp;"; 
                ?></a></li>
                </ol>
            </div>
            <!-- End Tampil Tanggal dan Jam -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- End Content Header -->           
    <!-- Tabel Apill -->
    <div class="p-4">
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahApillBaru">Tambah Data</button>
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Simpang</th>
                    <th>Terkoneksi ATCS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- End Tabel Apill -->
    <!-- Modal -->
    <div id="apillModal" class="modal fade" aria-hidden="true">
      <div class="modal-dialog modal-xl" s>
        <div class="modal-content">
          <form id="apillForm" name="apillForm">
            <div class="modal-header">
              <h5 class="modal-title" id="modalHeading"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                <span aria-hidden="true">&times;</span>
              </button>   
            </div>
            <div class="modal-body">
                <input type="hidden" name="apillId" id="apillId">
                <div class="form-group">
                    <label>Nama Kecamatan</label>
                    <select class="form-control" id="kecamatanId" name="kecamatanId">
                        <option value=""> - Pilih Kecamatan - </option>
                        @foreach($dataKec as $kec)
                            <option value="<?= $kec->kecamatanId ?>"> <?= $kec->namaKecamatan ?> </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Jalan</label>
                    <select class="form-control" id="jalanId" name="jalanId">
                        <option value=""> - Pilih Jalan - </option>
                    </select>
                </div>
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
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" id="saveBtn" value="create" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@stop
@section('script_peta')
    <!-- Tampil Map -->
    <script type="text/javascript">
        //Base Layer
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
        //End Base Layer

        
        var map = L.map('map', {
            layers: [satellite, hybrid, street], //base layers
            center: [-5.420000, 105.292969], //koordinat bandar lampung
            zoom: 12.4,
        })

        //inisialisasi base tree
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

        //Mengambil data json kabupaten dari file kabupaten.geojson
        var kabupatenJson;

        $.ajax({
            url: "/kabupaten.geojson",
            async: false,
            dataType: 'json',
            success: function(data){
                kabupatenJson = data
            }
        });
        //End mengambil data json kabupaten dari file kabupaten.geojson

        //Style untuk kabupaten
        var kabupatenStyle = {
            "color": "#000000",
            "weight": 2,
            "opacity": 1,
            "fillOpacity": 0,
        };

        //memasukkan json kabupatan ke dalam map
        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle, 
            pmIgnore: true, //diabaikan oleh geomann
        }).addTo(map);

        //inisialisasi overlays tree
        var overlaysTree = {
            label: 'Layers',
            selectAllCheckbox: 'Un/select all',
            children: [
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

        //layer control tree
        var lay = L.control.layers.tree(baseTree, overlaysTree, {
            namedToggle: true,
            selectorBack: false,
            closedSymbol: '&#8862; &#x1f5c0;',
            openedSymbol: '&#8863; &#x1f5c1;',
            collapseAll: 'Collapse All',
            collapsed: false,
        });

        //menambahkan layer control tree ke map
        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

        //control draw geomann
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

        //inisialisasi layergroup tempat menyimpan layer jalan yang dipilih
        var jalanGroup = new L.LayerGroup();
        var kecamatanGroup = new L.LayerGroup();
        var getJalanGroup = new L.LayerGroup();
        var getKecamatanGroup = new L.LayerGroup();
        var getApillGroup = new L.LayerGroup();
        var getJalanLayer;
        var getKecamatanLayer;
        var apillSelected;
        var jalanSelected;
        var kecamatanSelected;

        //mengambil data jalan pada kecamatan yang diinputkan
        $('#kecamatanId').on('input', function() {
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
                getKecamatanGroup.removeLayer(getKecamatanLayer);
            }
        });

        //mengambil id jalan yang diinputkan
        $('#jalanId').on('input', function() {
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
                getJalanGroup.removeLayer(getJalanLayer);
            }
        });

        var drawnItem = L.featureGroup();
        //meggambar 
        map.on('pm:create', (e)=> {
            var layer = e.layer;
            var data = layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonApill').val(dataString);
            drawnItem.addLayer(layer);
            console.log(drawnItem);
            //update
            e.layer.on('pm:update', (ed)=> {
                var layer = e.layer;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonApill').val(dataString);
                drawnItem.addLayer(layer);
            })
        })

        //icon marker hijau
        var green = L.icon({
            iconUrl: '/marker-green.png',
            iconSize: [38, 30],
        });
        
        //icon marker merah
        var red = L.icon({
            iconUrl: '/marker-red.png',
            iconSize: [38, 30],
        });

        //hapus
        map.on('pm:remove', (e)=> {
            $('#geoJsonApill').val('');
        })
    </script>
    <!-- End Tampil Map -->
@stop
@section('script_tabel')
    <!-- DataTable -->
    <script type="text/javascript">
        $(function(){
            
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.yajra-datatable').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('apill.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaSimpang', name: 'namaSimpang'},
                    {
                        data: 'terkoneksiATCS', 
                        name: 'terkoneksiATCS', 
                        orderable: false, 
                        searchable: false
                    },
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ]
            });

            $('#tambahApillBaru').click(function(){
                $('#saveBtn').val('tambahApill');
                $('#apillId').val('');
                $('#apillForm').trigger('reset');
                $('#saveBtn').html('Simpan');
                $('#modalHeading').html('Tambah Data Apill');
                $('#apillModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 0);
                });
                $('#apillModal').modal('show');
                $('#kecamatanId').empty();
                $('#jalanId').empty();
                $('#terkoneksiATCS').empty();
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        console.log(layer);
                        map.removeLayer(layer);
                    }
                });

                if(getKecamatanLayer != null && getJalanLayer != null && apillSelected != null){
                    getKecamatanGroup.removeLayer(getKecamatanLayer);
                    getJalanGroup.removeLayer(getJalanLayer);
                    getApillGroup.removeLayer(apillSelected);
                }
                
                //memasukkan json kabupatan ke dalam map
                L.geoJSON(kabupatenJson, {
                    style: kabupatenStyle, 
                    pmIgnore: true, //diabaikan oleh geomann
                }).addTo(map);
                $('#kecamatanId').append($('<option>', {
                    text: "- Pilih Kecamatan -",
                }));
                
                @foreach($dataKec as $kec)
                    $('#kecamatanId').append($('<option>', {
                        value: <?= $kec->kecamatanId ?>,
                        text: "<?= $kec->namaKecamatan ?>",
                    }));
                @endforeach

                $('#jalanId').append($('<option>', {
                    text: "- Pilih Jalan -",
                }));
                
                @foreach($dataJln as $jln)
                    $('#jalanId').append($('<option>', {
                        value: <?= $jln->jalanId ?>,
                        text: "<?= $jln->namaJalan ?>",
                    }));
                @endforeach

                $('#terkoneksiATCS').append($('<option>', {
                    text: "- Pilih -",
                }));
                $('#terkoneksiATCS').append($('<option>', {
                    value: "Belum",
                    text: "Belum",
                }));
                $('#terkoneksiATCS').append($('<option>', {
                    value: "Sudah",
                    text: "Sudah",
                }));
            });

            $('body').on('click', '.editApill', function () {
                var apillId = $(this).data('id');
                $('#saveBtn').html('Simpan');
                $.get("{{ route('apill.index') }}" +'/' + apillId +'/edit', function (data) {
                    $('#modalHeading').html('Edit Data Apill');
                    $('#saveBtn').val('editApill');
                    $('#apillModal').on('shown.bs.modal', function(){
                        setTimeout(function() {
                            map.invalidateSize();
                        }, 0);
                    });
                    $('#apillModal').modal('show');
                    $('#apillId').val(data.id);
                    $('#namaSimpang').val(data.namaSimpang);
                    $('#terkoneksiATCS').val(data.terkoneksiATCS);
                    $('#geoJsonApill').val(data.geoJsonApill);
                    $('#kecamatanId').empty();
                    $('#jalanId').empty();
                    $('#terkoneksiATCS').empty();
                    if(getKecamatanLayer != null && getJalanLayer != null && apillSelected != null){
                        getKecamatanGroup.removeLayer(getKecamatanLayer);
                        getJalanGroup.removeLayer(getJalanLayer);
                        getApillGroup.removeLayer(apillSelected);
                    }
                    map.eachLayer(function(layer) {
                        if (!!layer.toGeoJSON) {
                            console.log(layer);
                            map.removeLayer(layer);
                        }
                    });
                    //memasukkan json kabupatan ke dalam map
                    L.geoJSON(kabupatenJson, {
                        style: kabupatenStyle, 
                        pmIgnore: true, //diabaikan oleh geomann
                    }).addTo(map);
                    
                    getJalanGroup.addTo(map);
                    getKecamatanGroup.addTo(map);
                    getApillGroup.addTo(map);
                    @foreach($dataKec as $kec)
                        if(<?= $kec->kecamatanId ?> == data.kecamatanId){
                            $('#kecamatanId').append($('<option>', {
                                value: <?= $kec->kecamatanId ?>,
                                text: "- <?= $kec->namaKecamatan ?> -",
                            }));
                        }
                    @endforeach
                    @foreach($dataKec as $kec)
                        if(<?= $kec->kecamatanId ?> == data.kecamatanId){
                            
                        }else{
                            $('#kecamatanId').append($('<option>', {
                                value: <?= $kec->kecamatanId ?>,
                                text: " <?= $kec->namaKecamatan ?> ",
                            }));
                        }
                    @endforeach
                    @foreach($dataJln as $jln)
                        if(<?= $jln->jalanId ?> == data.jalanId){
                            $('#jalanId').append($('<option>', {
                                value: <?= $jln->jalanId ?>,
                                text: "- <?= $jln->namaJalan?> -",
                            }));
                        }
                    @endforeach
                    @foreach($dataJln as $jln)
                        if(<?= $jln->jalanId ?> == data.jalanId){
                            
                        }else{
                            $('#jalanId').append($('<option>', {
                                value: <?= $jln->jalanId ?>,
                                text: "<?= $jln->namaJalan?>",
                            }));
                        }
                    @endforeach
                    var terkoneksiATCS = data.terkoneksiATCS;
                    $('#terkoneksiATCS').append($('<option>', {
                        value: data.terkoneksiATCS,
                        text: "- " + terkoneksiATCS.toString() +" -",
                    }));
                    if(terkoneksiATCS.toString() == 'Sudah'){
                        $('#terkoneksiATCS').append($('<option>', {
                            value: 'Belum',
                            text: "Belum",
                        }));
                    }else{
                        $('#terkoneksiATCS').append($('<option>', {
                            value: 'Sudah',
                            text: "Sudah",
                        }));
                    };
                   

                    

                    @foreach($kecamatans as $kec)
                        if('<?= $kec->id ?>' == data.kecamatanId ){
                            getKecamatanLayer = L.geoJSON(<?= $kec->geoJsonKecamatan ?>,{
                                style: {
                                    'fillOpacity': '0',
                                },
                                pmIgnore: true,
                            }).addTo(getKecamatanGroup);
                        }
                    @endforeach

                    @foreach($jalans as $jln)
                        if('<?= $jln->id ?>' == data.jalanId ){
                            getJalanLayer = L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                pmIgnore: true,
                            }).addTo(getJalanGroup);
                        }
                    @endforeach
                    var geoJsonApill = JSON.parse(data.geoJsonApill);
                    apillSelected = L.geoJSON(geoJsonApill).addTo(getApillGroup); 

                    apillSelected.on('pm:edit', function(e){
                        var layer = e.layer;
                        var data = e.layer.toGeoJSON();
                        var dataString = JSON.stringify(data);
                        $('#geoJsonApill').val(dataString);
                    })

                });
            });

            $('#saveBtn').click(function(e){
                console.log('tes');
                e.preventDefault();
                $(this).html('Mengirim ....');

                $.ajax({
                data: $('#apillForm').serialize(),
                url: "{{ route('apill.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data){
                    console.log('save');
                    $('#apillForm').trigger('reset');
                    $('#apillModal').modal('hide');
                    table.draw();
                },
                errror: function(data){
                    console.log('erorr');
                    console.log('Error', data);
                    $('#saveBtn').html('Simpan');
                }
                });
            });

            $('body').on('click', '.deleteApill', function () {
                var apillId = $(this).data("id");
                confirm("Are You sure want to delete !");
                
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('apill.store') }}"+'/'+apillId,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
            
        });
    </script>
    <!-- End DataTable -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
