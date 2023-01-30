@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Titik Kecelakaan</h1>
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
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahTitikLakaBaru">Tambah Data</button>
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Kecamatan</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- End Tabel Apill -->
    <!-- Modal -->
    <div id="titikLakaModal" class="modal fade" aria-hidden="true">
      <div class="modal-dialog modal-xl" s>
        <div class="modal-content">
          <form id="titikLakaForm" name="titikLakaForm">
            <div class="modal-header">
              <h5 class="modal-title" id="modalHeading"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                <span aria-hidden="true">&times;</span>
              </button>   
            </div>
            <div class="modal-body">
                <input type="hidden" name="titikLakaId" id="titikLakaId">
                <input type="hidden" name="jalanKecamatanId" id="jalanKecamatanId">
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
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" name="lokasiKecelakaan" id="lokasiKecelakaan">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <input type="text" class="form-control" name="deskripsiKecelakaan" id="deskripsiKecelakaan">
                </div>
                <div id="map" style="width:900px; height:500px" class="mb-4"></div>
                <div class="form-group">
                    <label for="">Geo Json Titik Kecelakaan</label>
                    <textarea type="text" class="form-control" name="geoJsonKecelakaan" id="geoJsonKecelakaan"></textarea>
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
        var getTitikLakaGroup = new L.LayerGroup();
        var getJalanLayer;
        var getKecamatanLayer;
        var titikLakaSelected;
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

        //meggambar 
        map.on('pm:create', (e)=> {
            var layer = e.layer;
            var data = layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonKecelakaan').val(dataString);
            //update
            e.layer.on('pm:update', (ed)=> {
                var layer = e.layer;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonKecelakaan').val(dataString);
                drawnItem.addLayer(layer);
            })
        })

        //hapus
        map.on('pm:remove', (e)=> {
            $('#geoJsonKecelakaan').val('');
        })

        //mendapatkan jalanKecamatanId
        $('#kecamatanId').on('input', function() {
            var kecamatanId = this.value;
            $('#jalanId').on('input', function() {
                var jalannId = this.value;
                console.log(kecamatanId);
                console.log(jalanId);
                @foreach($data as $d)
                    if('<?= $d->kecamatanId ?>' ==  kecamatanId && '<?= $d->jalanId ?>' ==  jalanId){
                        $('#jalanKecamatanId').val('<?= $d->id ?>')
                    }
                @endforeach
            })
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
                ajax: "{{ route('titik_kecelakaan.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaJalan', name: 'namaJalan'},
                    {data: 'namaKecamatan', name: 'namaKecamatan'},
                    {data: 'lokasiKecelakaan', name: 'lokasiKecelakaan'},
                    {data: 'deskripsiKecelakaan', name: 'deskripsiKecelakaan'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ]
            });

            $('#tambahTitikLakaBaru').click(function(){
                $('#saveBtn').val('tambahTitikLaka');
                $('#titikLakaId').val('');
                $('#titikLakaForm').trigger('reset');
                $('#saveBtn').html('Simpan');
                $('#modalHeading').html('Tambah Data Titik Kecelakaan');
                $('#titikLakaModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 0);
                });
                $('#titikLakaModal').modal('show');
                $('#kecamatanId').empty();
                $('#jalanId').empty();
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        console.log(layer);
                        map.removeLayer(layer);
                    }
                });

                if(getKecamatanLayer != null && getJalanLayer != null && titikLakaSelected != null){
                    getKecamatanGroup.removeLayer(getKecamatanLayer);
                    getJalanGroup.removeLayer(getJalanLayer);
                    getTitikLakaGroup.removeLayer(titikLakaSelected);
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
            });

            $('body').on('click', '.editTitikLaka', function () {
                var titikLakaId = $(this).data('id');
                $('#saveBtn').html('Simpan');
                $.get("{{ route('titik_kecelakaan.index') }}" +'/' + titikLakaId +'/edit', function (data) {
                    $('#modalHeading').html('Edit Data Titik Kecelakaan');
                    $('#saveBtn').val('editTitikLaka');
                    $('#titikLakaModal').on('shown.bs.modal', function(){
                        setTimeout(function() {
                            map.invalidateSize();
                        }, 0);
                    });
                    $('#titikLakaModal').modal('show');
                    $('#titikLakaId').val(data.id);
                    $('#lokasiKecelakaan').val(data.lokasiKecelakaan);
                    $('#deskripsiKecelakaan').val(data.deskripsiKecelakaan);
                    $('#geoJsonKecelakaan').val(data.geoJsonKecelakaan);
                    $('#jalanKecamatanId').val(data.jalanKecamatanId);
                    $('#kecamatanId').empty();
                    $('#jalanId').empty();

                    if(getKecamatanLayer != null && getJalanLayer != null && titikLakaSelected != null){
                        getKecamatanGroup.removeLayer(getKecamatanLayer);
                        getJalanGroup.removeLayer(getJalanLayer);
                        getTitikLakaGroup.removeLayer(titikLakaSelected);
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
                    getTitikLakaGroup.addTo(map);
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
                    var geoJsonKecelakaan = JSON.parse(data.geoJsonKecelakaan);
                    titikLakaSelected = L.geoJSON(geoJsonKecelakaan).addTo(getTitikLakaGroup); 

                    titikLakaSelected.on('pm:edit', function(e){
                        var layer = e.layer;
                        var data = e.layer.toGeoJSON();
                        var dataString = JSON.stringify(data);
                        $('#geoJsonKecelakaan').val(dataString);
                    })

                });
            });

            $('#saveBtn').click(function(e){
                e.preventDefault();
                $(this).html('Mengirim ....');

                $.ajax({
                data: $('#titikLakaForm').serialize(),
                url: "{{ route('titik_kecelakaan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data){
                    console.log('save');
                    $('#titikLakaForm').trigger('reset');
                    $('#titikLakaModal').modal('hide');
                    table.draw();
                },
                error: function(data){
                    console.log('erorr');
                    console.log('Error', data);
                    $('#saveBtn').html('Simpan');
                }
                });
            });

            $('body').on('click', '.deleteTitikLaka', function () {
                var titikLakaId = $(this).data("id");
                confirm("Are You sure want to delete !");
                
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('titik_kecelakaan.store') }}"+'/'+titikLakaId,
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
