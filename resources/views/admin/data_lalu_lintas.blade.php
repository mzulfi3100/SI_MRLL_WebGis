@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Lalu Lintas</h1>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="p-4">
        <!-- <a href="{{ route('lalulinta.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Lalu Lintas</a> -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahLalinBaru">Tambah Data</button>
        <!-- Trigger modal hapus all data with a button -->
        <a href="#" type="button" class="btn btn-danger" >Hapus Semua</a>
        <!-- Trigger selected delete data with a button -->
        <button class="btn btn-danger d-none" id="deleteAllBtn"></button>

        <!-- Modal -->
        <div id="lalinModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="lalinForm" name="lalinForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHeading"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <div id="map" style="width:750px; height:450px;" class="mb-4 ml-2"></div>
                            </div>
                            <input type="hidden" name="lalinId" id="lalinId">
                            <input type="hidden" name="jalanKecamatanId" id="jalanKecamatanId">
                            <div class="col-12 col-sm-6">
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
                                    <label for="">Volume Lalu lintas</label>
                                    <input type="text" class="form-control" name="volume" id="volume">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Nama Jalan</label>
                                    <select class="form-control" id="jalanId" name="jalanId">
                                        <option value=""> - Pilih Jalan - </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kapasitas Jalan</label>
                                    <input type="text" class="form-control" name="kapasitasJalan" id="kapasitasJalan" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tingkat Pelayanan</label>
                                    <select class="form-control" id="tingkatPelayanan" name="tingkatPelayanan">
                                        <option value="">- Pilih Tingkat Pelayanan -</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tingkat Kemacetan</label>
                                    <select class="form-control" id="tingkatKemacetan" name="tingkatKemacetan">
                                        <option value="">- Pilih Tingkat Kemacetan -</option>
                                        <option value="Rendah">Rendah</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Tinggi">Tinggi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kecepatan Tempuh</label>
                                    <input type="text" class="form-control" name="kecepatan" id="kecepatan">
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" id="tahun">
                                </div>
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
        <div> &nbsp; </div>
        <!-- DataTable -->
        <table class="table table-striped yajra-datatable p-0">
            <thead class="table-dark"> 
                <tr>
                <th><i class="hiddentext" style="display:none">CheckBox</i><input type="checkbox" name="main_checkbox"><label></label></th>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Kecamatan</th>
                    <th>Volume</th>
                    <th>Kecepatan</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
                var jalannId = this.value;
                console.log(kecamatanId);
                console.log(jalanId);
                @foreach($data as $kap)
                    if('<?= $kap->kecamatanId ?>' ==  kecamatanId && '<?= $kap->jalanId ?>' ==  jalanId){
                        $('#kapasitasJalan').val('<?= $kap->kapasitasJalan ?>')
                    }
                @endforeach
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
                "lengthMenu": [ [10, 15, 25, 50, -1], [10, 15, 25, 50, "All"] ],
                'order': [[2, 'asc']],
                columnDefs: [
                    {"className": "dt-center", "targets": [0, 1, 4, 5, 6, 7]},
                    {orderable: false, searchable: false, targets: [0, 1, 7]},
                ],
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false,
                        searchable: false,},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaJalan', name: 'namaJalan'},
                    {data: 'namaKecamatan', name: 'namaKecamatan'},
                    {data: 'volume', name: 'volume'},
                    {data: 'kecepatan', name: 'kecepatan'},
                    {data: 'tahun', name: 'tahun'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'spacer'},
                    {extend: 'excelHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-success'},
                    {extend: 'pdfHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-info'},
                    {extend: 'colvis', columnText: function ( dt, idx, title) {return (idx+1)+'. '+title;}, className: 'btn btn-warning'},
                ],
                ajax: "{{ route('lalulinta.index') }}",
            }).on('draw', function(){
                $('input[name="lalin_checkbox"]').each(function(){
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            // bagian listing checkbox
            $(document).on('click', 'input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="lalin_checkbox"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="lalin_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
            });

            //bagian listing 2 checkbox
            $(document).on('change', 'input[name="lalin_checkbox"]', function(){
                if($('input[name="lalin_checkbox"]').length == $('input[name="lalin_checkbox"]:checked').length){
                    $('input[name="main_checkbox"]').prop('checked', true);
                }else{
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn(); 
            });
            
            //bagian tampilan delete btn
            function toggledeleteAllBtn(){
                if($('input[name="lalin_checkbox"]:checked').length > 0){
                    $('button#deleteAllBtn').text('Hapus Data ('+$('input[name="lalin_checkbox"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }
            
            //bagian utama selected delete
            $(document).on('click', 'button#deleteAllBtn', function(){
                var checkedLalin = [];
                var url = '{{ route("delete.selected.lalin")}}';
                $('input[name="lalin_checkbox"]:checked').each(function(){
                    checkedLalin.push($(this).data('id'))
                });
                
                // untuk melihat id data yang dipilih/checked
                // alert(checkedLalin);
                if(checkedLalin.length > 0){
                    var countLalin = [checkedLalin.length];
                    swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b>'+checkedLalin.length+'</b> data lalu lintas yang dipilih?',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Lanjutkan',
                        cancelButtonText:'Kembali',
                        confirmButtonColor:'#28a745',
                        cancelButtonColor:'#d33',
                        width:500,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){
                            $.post(url, {lalin_id:checkedLalin, countingLalin:countLalin}, function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }
                            },'json');
                        }
                    })
                }
            });

            // tambah data
            $('#tambahLalinBaru').click(function(){
                $('#saveBtn').val('tambahLalin');
                $('#lalinId').val('');
                $('#lalinForm').trigger('reset');
                $('#saveBtn').html('Simpan');
                $('#modalHeading').html('Tambah Data Lalin');
                $('#lalinModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 0);
                });
                $('#lalinModal').modal('show');
                $('#kecamatanId').empty();
                $('#jalanId').empty();
                $('#tingkatPelayanan').empty();
                $('#tingkatKemacetan').empty();

                //hapus layer geoJSON
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        console.log(layer);
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

                $('#tingkatPelayanan').append($('<option>', {
                    text: "- Pilih Tingkat Pelayanan -",
                }));

                var tingPelayan = ['A', 'B', 'C', 'D', 'E', 'F'];

                for(var i = 0; i < 6; i++){
                    $('#tingkatPelayanan').append($('<option>', {
                        value: tingPelayan[i],
                        text: tingPelayan[i],
                    }));
                }

                $('#tingkatKemacetan').append($('<option>', {
                    text: "- Pilih Tingkat Kemacetan -",
                }));

                var tingKec = ['Rendah', 'Sedang', 'Tinggi'];

                for(var i = 0; i < 3; i++){
                    $('#tingkatKemacetan').append($('<option>', {
                        value: tingKec[i],
                        text: tingKec[i],
                    }));
                }
            });

            // edit data
            $('body').on('click', '.editLalin', function () {
                var lalinId = $(this).data('id');
                console.log(lalinId);
                $('#saveBtn').html('Simpan');
                $.get("{{ route('lalulinta.index') }}" +'/' + lalinId +'/edit', function (data) {
                    $('#modalHeading').html('Edit Data Apill');
                    $('#saveBtn').val('editLalin');
                    $('#lalinModal').on('shown.bs.modal', function(){
                        setTimeout(function() {
                            map.invalidateSize();
                        }, 0);
                    });
                    $('#lalinModal').modal('show');
                    $('#lalinId').val(data.id);
                    $('#volume').val(data.volume);
                    $('#kecepatan').val(data.kecepatan);
                    $('#kapasitasJalan').val(data.kapasitasJalan);
                    $('#tingkatPelayanan').val(data.tingkatPelayanan);
                    $('#tingkatKemacetan').val(data.tingkatKemacetan);
                    $('#tahun').val(data.tahun);
                    $('#jalanKecamatanId').val(data.jalanKecamatanId);
                    $('#kecamatanId').empty();
                    $('#jalanId').empty();
                    $('#tingkatPelayanan').empty();
                    $('#tingkatKemacetan').empty();

                    //hapus kecamatan dan jalan layer yang tersimpan
                    if(getKecamatanLayer != null && getJalanLayer != null){
                        getKecamatanGroup.removeLayer(getKecamatanLayer);
                        getJalanGroup.removeLayer(getJalanLayer);
                    }

                    //hapus layer geoJSON
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


                    var tingPelayan = ['A', 'B', 'C', 'D', 'E', 'F'];

                    for(var i = 0; i < 6; i++){
                        if(tingPelayan[i] == data.tingkatPelayanan){
                            $('#tingkatPelayanan').append($('<option>', {
                                value: tingPelayan[i],
                                text: '- ' + tingPelayan[i] + ' -',
                            }));
                        }
                    }

                    for(var i = 0; i < 6; i++){
                        if(tingPelayan[i] == data.tingkatPelayanan){
                        }else{
                            $('#tingkatPelayanan').append($('<option>', {
                                value: tingPelayan[i],
                                text: tingPelayan[i],
                            }));
                        }
                    }

                    var tingKec = ['Rendah', 'Sedang', 'Tinggi'];

                    for(var i = 0; i < 3; i++){
                        if(tingKec[i] == data.tingkatKemacetan){
                            $('#tingkatKemacetan').append($('<option>', {
                                value: tingKec[i],
                                text: '- ' + tingKec[i] + ' -',
                            }));
                        }
                    }

                    for(var i = 0; i < 3; i++){
                        if(tingKec[i] == data.tingkatKemacetan){
                        }else{
                            $('#tingkatKemacetan').append($('<option>', {
                                value: tingKec[i],
                                text: tingKec[i],
                            }));
                        }
                    }
                });
            });

            // simpan button
            $('#saveBtn').click(function(e){
                console.log('tes');
                e.preventDefault();
                $(this).html('Mengirim ....');

                $.ajax({
                data: $('#lalinForm').serialize(),
                url: "{{ route('lalulinta.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data){
                    console.log('save');
                    toastr.success(data.msg);
                    $('#lalinForm').trigger('reset');
                    $('#lalinModal').modal('hide');
                    table.draw();
                },
                error: function(data){
                    console.log('erorr');
                    console.log('Error', data);
                    $('#saveBtn').html('Simpan');
                }
                });
            });

            // delete data
            $('body').on('click', '.deleteLalin', function () {
                var lalinId = $(this).data("id");
                
                swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b></b> data lalu lintas yang dipilih?',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Lanjutkan',
                        cancelButtonText:'Kembali',
                        confirmButtonColor:'#28a745',
                        cancelButtonColor:'#d33',
                        width:500,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){
                            $.post("{{ route('lalulinta.destroy') }}", {lalinId},function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }
                            },'json');
                        }
                    })
            });


        });
    </script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
