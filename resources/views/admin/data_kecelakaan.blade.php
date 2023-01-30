@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kecelakaan</h1>
            </div><!-- /.row -->
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
        </div><!-- /.container-fluid -->
    </div>
          

    <!-- /.content-header -->
    <div class="p-4">
        <!-- <a href="{{ route('kecelakaan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecelakaan</a> -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahLakaBaru">Tambah Data</button>
        <!-- Trigger modal hapus all data with a button -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapusSemuaKecelakaan">Hapus Semua</button>
        <div id="modalHapusSemuaKecelakaan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" style ="color:red" id="hapus-jalan">Peringatan! </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin semua Data Kecelakaan akan dihapus?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="{{ route('kecamatan.delete.all.truncate') }}" class="btn btn-danger">Lanjutkan</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="lakaModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-xl" s>
                <div class="modal-content">
                    <form id="lakaForm" name="lakaForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeading"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="lakaId" id="lakaId">
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
                            <div id="map" style="width:900px; height:500px" class="mb-4"></div>
                            <div class="form-group">
                                <label for="">Vatalitas</label>
                                <input type="text" class="form-control" name="vatalitasKecelakaan" id="vatalitasKecelakaan">
                            </div>
                            <div class="form-group">
                                <label for="">Penyebab</label>
                                <input type="text" class="form-control" name="penyebabKecelakaan" id="penyebabKecelakaan">
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Korban</label>
                                <input type="text" class="form-control" name="jumlahKorban" id="jumlahKorban">
                            </div>
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <input type="text" class="form-control" name="tahunKecelakaan" id="tahunKecelakaan">
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
        <div>&nbsp;
        </div>
          <!-- table -->
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark"> 
                <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Nama Kecamatan</th>
                    <th>Vatalitas</th>
                    <th>Penyebab</th>
                    <th>Jumlah Korban</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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

        var jalanGroup = new L.LayerGroup();
        var kecamatanGroup = new L.LayerGroup();
        var getJalanGroup = new L.LayerGroup();
        var getKecamatanGroup = new L.LayerGroup();
        var getJalanLayer;
        var getKecamatanLayer;
        var jalanSelected;
        var kecamatanSelected;

        //mengambil data jalan pada kecamatan yang diinputkan
        $('#kecamatanId').on('input', function() {
            $('#jalanId').empty();
            $('#jalanId').append($("<option>", {
                text: "- Pilih Jalan -",
            }));
            kecamatanGroup.addTo(map);
            kecamatanId = this.value;
            @foreach($kecamatans as $kec)
                if('<?= $kec->id ?>' == kecamatanId){
                    kecamatanSelected = L.geoJSON(<?= $kec->geoJsonKecamatan ?>, {
                        style: {
                            'fillOpacity': 0,
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

        //mendapatkan jalanKecamatanId
        $('#kecamatanId').on('input', function() {
            var kecamatanId = this.value;
            $('#jalanId').on('input', function() {
                var jalanId = this.value;
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
    <script type="text/javascript">
    $(function () {
        // setup ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // render data
        var table = $('.yajra-datatable').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('kecelakaan.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namaJalan', name: 'namaJalan'},
                {data: 'namaKecamatan', name: 'namaKecamatan'},
                {data: 'vatalitasKecelakaan', name: 'vatalitasKecelakaan'},
                {data: 'penyebabKecelakaan', name: 'penyebabKecelakaan'},
                {data: 'jumlahKorban', name: 'jumlahKorban'},
                {data: 'tahunKecelakaan', name: 'tahunKecelakaan'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });

        // tambah data
        $('#tambahLakaBaru').click(function(){
            $('#saveBtn').val('tambahLaka');
            $('#lakaId').val('');
            $('#lakaForm').trigger('reset');
            $('#saveBtn').html('Simpan');
            $('#modalHeading').html('Tambah Data Kecelakaan');
            $('#lakaModal').on('shown.bs.modal', function(){
                setTimeout(function() {
                    map.invalidateSize();
                }, 0);
            });
            $('#lakaModal').modal('show');
            $('#kecamatanId').empty();
            $('#jalanId').empty();

            //hapus layer geoJSON
            map.eachLayer(function(layer) {
                if (!!layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });

            //hapus layer jalan dan kecamatan tersimpan
            if(getKecamatanLayer != null && getJalanLayer != null){
                getKecamatanGroup.removeLayer(getKecamatanLayer);
                getJalanGroup.removeLayer(getJalanLayer);
            }
            
            //memasukkan json kabupatan ke dalam map
            L.geoJSON(kabupatenJson, {
                style: kabupatenStyle, 
                pmIgnore: true, //diabaikan oleh geomann
            }).addTo(map);

            // tambah option pilih
            $('#kecamatanId').append($('<option>', {
                text: "- Pilih Kecamatan -",
            }));
            
            // tambah option kecamatan
            @foreach($dataKec as $kec)
                $('#kecamatanId').append($('<option>', {
                    value: <?= $kec->kecamatanId ?>,
                    text: "<?= $kec->namaKecamatan ?>",
                }));
            @endforeach
            
            // tambah option pilih
            $('#jalanId').append($('<option>', {
                text: "- Pilih Jalan -",
            }));
            
            // tambah option jalan
            @foreach($dataJln as $jln)
                $('#jalanId').append($('<option>', {
                    value: <?= $jln->jalanId ?>,
                    text: "<?= $jln->namaJalan ?>",
                }));
            @endforeach
        });

        // edit data
        $('body').on('click', '.editLaka', function () {
            var lakaId = $(this).data('id');
            $('#saveBtn').html('Simpan');
            $.get("{{ route('kecelakaan.index') }}" +'/' + lakaId +'/edit', function (data) {
                $('#modalHeading').html('Edit Data Kecelakaan');
                $('#saveBtn').val('editLaka');
                $('#lakaModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 0);
                });
                $('#lakaModal').modal('show');
                $('#lakaId').val(data.id);
                $('#vatalitasKecelakaan').val(data.vatalitasKecelakaan);
                $('#penyebabKecelakaan').val(data.penyebabKecelakaan);
                $('#jumlahKorban').val(data.jumlahKorban);
                $('#tahunKecelakaan').val(data.tahunKecelakaan);
                $('#jalanKecamatanId').val(data.jalanKecamatanId);
                $('#kecamatanId').empty();
                $('#jalanId').empty();

                //hapus kecamatan dan jalan layer yang tersimpan
                if(getKecamatanLayer != null && getJalanLayer != null){
                    getKecamatanGroup.removeLayer(getKecamatanLayer);
                    getJalanGroup.removeLayer(getJalanLayer);
                }

                //hapus layer geoJSON
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
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
            });
        });

        // simpan button
        $('#saveBtn').click(function(e){
            e.preventDefault();
            $(this).html('Mengirim ....');

            $.ajax({
            data: $('#lakaForm').serialize(),
            url: "{{ route('kecelakaan.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(data){
                $('#lakaForm').trigger('reset');
                $('#lakaModal').modal('hide');
                table.draw();
            },
            error: function(data){
                console.log('Error', data);
                $('#saveBtn').html('Simpan');
            }
            });
        });

        // delete data
        $('body').on('click', '.deleteLaka', function () {
            var lakaId = $(this).data("id");
            confirm("Are You sure want to delete !");
            
            $.ajax({
                type: "DELETE",
                url: "{{ route('kecelakaan.store') }}"+'/'+lakaId,
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
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
