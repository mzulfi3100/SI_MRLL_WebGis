<?php $title="Data Jalan"?>
@extends('admin/template')
@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Jalan</h1>
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

    <!-- Tabel Jalan -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="p-2">
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahJalanBaru">Tambah Data</button>
        <!-- Trigger selected delete data with a button -->
        <button class="btn btn-danger d-none" id="deleteAllBtn"></button><br></br>
        
        <!-- Table Yajra -->
        <table class="table table-striped yajra-datatable table-bordered">
            <thead class="table-dark"> 
                <tr>
                <th><i class="hiddentext" style="display:none">CheckBox</i><input type="checkbox" name="main_checkbox"><label></label></th>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Kecamatan</th>
                    <th>Panjang(km)</th>
                    <th>Lebar(m)</th>
                    <th>Kapasitas(smp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!-- End Table Yajra -->
    </div>
    </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal Tambah dan Update -->
    <div id="jalanModal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Form Jalan -->
                <form id="jalanForm" name="jalanForm" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHeading"></h5>
                        <button class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" name="jalanId" id="jalanId">
                        <div class="col-12">
                            <div id="map" style="width:750px; height:450px;" class="mb-4 ml-2"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Kecamatan <span style="color:red;">&#42;</span></label>
                                <select class="form-control" name="kecamatanId" id="kecamatanId">
                                    <option value="">- Pilih Kecamatan -</option>
                                    @foreach($kecamatans as $kec)
                                        <option value="<?= $kec->id ?>"><?= $kec->namaKecamatan ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Jalan <span style="color:red;">&#42;</span></label>
                                <input type="text" class="form-control" id="namaJalan" name="namaJalan">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Fungsi Jalan</label>
                                <input type="text" class="form-control" id="fungsiJalan" name="fungsiJalan">
                            </div>
                            <div class="form-group">
                                <label>Panjang Jalan(km)</label>
                                <input type="text" class="form-control" id="panjangJalan" name="panjangJalan">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Tipe Jalan</label>
                                <input type="text" class="form-control" id="tipeJalan" name="tipeJalan">
                            </div>
                            
                            <div class="form-group">
                                <label>Lebar Jalan(m)</label>
                                <input type="text" class="form-control" id="lebarJalan" name="lebarJalan">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Kapasitas Jalan(smp)</label>
                                <input type="text" class="form-control" id="kapasitasJalan" name="kapasitasJalan">
                            </div>
                            <div class="form-group">
                                <label>Hambatan Samping</label>
                                <input type="text" class="form-control" id="hambatanSamping" name="hambatanSamping">
                            </div>
                            <div class="form-group">
                                <label>Kondisi Jalan</label>
                                <input type="text" class="form-control" id="kondisiJalan" name="kondisiJalan">
                            </div>
                            <div class="form-group">
                                <label>Geo JSON Jalan <span style="color:red;">&#42;</span></label>
                                <textarea type="text" class="form-control" id="geoJsonJalan" name="geoJsonJalan" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Simpan</button>
                    </div>
                </form>
                <!-- End Form Jalan -->
            </div>
        </div>
    </div>
    <!-- End Modal Tambah dan Update -->
@stop
@section('copyright_data')
<footer class="main-footer">
    Copyright &copy; 2023<strong> Dinas Perhubungan Bandar Lampung.</strong>
    All rights reserved.
</footer>
@stop
@section('script_peta')
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
            fullscreenControl: {
                pseudoFullscreen: false
            },
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

        

        // Geomann drawing geoJson Control
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
            drawPolyline: true,
            drawPolygon: false,
        });

        // Draw
        map.on('pm:create', (e)=> {
            var layer = e.layer;
            var data = layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonJalan').val(dataString);
            //update
            e.layer.on('pm:update', (ed)=> {
                var layer = e.layer;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonJalan').val(dataString);
            })
        })

        // Delete
        map.on('pm:remove', (e)=> {
            $('#geoJsonJalan').val('');
        })

        map.addControl(L.control.search({position: 'topleft'}));

        //layer control tree
        var lay = L.control.layers.tree(baseTree, overlaysTree, {
                    namedToggle: true,
                    selectorBack: false,
                    closedSymbol: '&#8862; &#x1f5c0;',
                    openedSymbol: '&#8863; &#x1f5c1;',
                    collapseAll: 'Collapse all',
                    collapsed: true,
                    position: 'topleft'
                });

        //menambahkan layer control tree ke map
        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

        // menampilkan batas kecamatan yang dipilih

        var kecamatanGroup = L.layerGroup(); //layer group untuk menampilkan kecamatan sesuai pilih
        var kecamatanLayer; 
        var getJalanGroup = L.layerGroup(); //layer group untuk menampilkan jalan yang diedit
        var getKecamatanGroup = L.layerGroup(); //layer group untuk menampilkan kecamatan pada jalan yang diedit
        var getKecamatanLayer;
        var getJalanLayer;
        var isClick;

        // melakukan action jika kecamatan id diinputkan 
        $('#kecamatanId').on('mouseenter', function(){
            kecamatanGroup.removeLayer(kecamatanLayer);
            getKecamatanGroup.removeLayer(getKecamatanLayer)
            
        });

        // melakukkan action jika kecamatan id telah diinputkan dan mouse mengarah ke kecamatan id
        $('#kecamatanId').on('input', function(){
            isClick = true;
            var kecamatanId = this.value;
            kecamatanGroup.addTo(map);
            @foreach($kecamatans as $kec)
                if('<?= $kec->id ?>' == kecamatanId){
                    kecamatanLayer = L.geoJSON(<?= $kec->geoJsonKecamatan ?>, {
                        style: {
                            'color': '<?= $kec->warnaKecamatan ?>',
                            'fillOpacity': '0',
                        },
                        pmIgnore: true,
                    }).addTo(kecamatanGroup);
                }
            @endforeach
        });
        
        
    </script>
@stop
@section('script_tabel')
    <script type="text/javascript">
        $(function(){
            // Setup AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Render Data
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
                    {data: 'checkbox', name: 'checkbox'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaJalan', name: 'namaJalan'},
                    {data: 'namaKecamatan', name: 'namaKecamatan'},
                    {data: 'panjangJalan', name: 'panjangJalan'},
                    {data: 'lebarJalan', name: 'lebarJalan'},
                    {data: 'kapasitasJalan', name: 'kapasitasJalan'},
                    {data: 'action', name: 'action'},
                ],
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'spacer'},
                    {extend: 'excelHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-success', text: '<i class="fas fa-file-excel" aria-hidden="true"></i> Excell'},
                    {extend: 'pdfHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-info', text: '<i class="fas fa-file-pdf" aria-hidden="true"></i> PDF'},
                    {extend: 'colvis', columnText: function ( dt, idx, title) {return (idx+1)+'. '+title;}, className: 'btn btn-warning', text: 'Filter'},
                ],
                ajax: "{{ route('jalan.index') }}",
            }).on('draw', function(){
                $('input[name="jalan_checkbox"]').each(function(){
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });
            // End Render Data

            // bagian listing checkbox
            $(document).on('click', 'input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="jalan_checkbox"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="jalan_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
            });

            //bagian listing 2 checkbox
            $(document).on('change', 'input[name="jalan_checkbox"]', function(){
                if($('input[name="jalan_checkbox"]').length == $('input[name="jalan_checkbox"]:checked').length){
                    $('input[name="main_checkbox"]').prop('checked', true);
                }else{
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn(); 
            });
            
            //bagian tampilan delete btn
            function toggledeleteAllBtn(){
                if($('input[name="jalan_checkbox"]:checked').length > 0){
                    $('button#deleteAllBtn').text('Hapus Data ('+$('input[name="jalan_checkbox"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }
            
            //bagian utama selected delete
            $(document).on('click', 'button#deleteAllBtn', function(){
                var checkedJalan = [];
                var checkedKecamatan = [];
                var checkedJalanKecamatan = [];
                var isDataLalin;
                var isDataLaka;
                var isDataMacet;
                var url = '{{ route("delete.selected.jalan")}}';
                $('input[name="jalan_checkbox"]:checked').each(function(){
                    checkedJalan.push($(this).data('id')),
                    checkedKecamatan.push($(this).data('kec'))
                    checkedJalanKecamatan.push($(this).data('jalkec'))
                });
                
                // untuk melihat id data yang dipilih/checked

                @foreach($lalulintas as $lalin)
                    for(var i = 0; i < checkedJalanKecamatan.length; i++){
                        if(<?= $lalin->jalanKecamatanId ?> == checkedJalanKecamatan[i] ){
                            isDataLalin = true;
                        }
                    }
                @endforeach
                @foreach($titikLaka as $laka)
                for(var i = 0; i < checkedJalanKecamatan.length; i++){
                    if(<?= $laka->jalanKecamatanId ?> == checkedJalanKecamatan[i]){
                        isDataLaka = true;
                    }
                }
                @endforeach
                @foreach($titikMacet as $macet)
                for(var i = 0; i < checkedJalanKecamatan.length; i++){
                    if(<?= $macet->jalanKecamatanId ?> == checkedJalanKecamatan[i]){
                        isDataMacet= true;
                    }
                }
                @endforeach
                if(checkedJalan.length > 0){
                    if(isDataLalin == true || isDataLaka == true || isDataMacet == true){
                        swal.fire({
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            title:'<h3 style ="color:orange">Peringatan!</h3>',
                            icon: 'error',
                            html:'Salah satu data jalan ini tidak bisa dihapus! silahkan hapus terlebih dahulu data <span style="color:red">lalulintas/titik kemacetan/ titik kecelakaan</span> yang terkait dengan jalan ini terlebih dahulu',
                            showCancelButton:false,
                            showCloseButton:true,
                            confirmButtonColor:'#28a745',
                            cancelButtonColor:'#d33',
                            width:500,
                            allowOutsideClick:false
                        })
                    }else{
                        var countJalan = [checkedJalan.length];
                        swal.fire({
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            title:'<h3 style ="color:red">Peringatan!</h3>',
                            icon: 'warning',
                            html:'Apakah anda yakin ingin menghapus <b>'+checkedJalan.length+'</b> data jalan yang dipilih?',
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
                                $.post(url, {jalan_id:checkedJalan, jalan_kec:checkedKecamatan, countingJalan:countJalan}, function(data){
                                    if(data.code == 1){
                                        toastr.success(data.msg);
                                        table.draw();
                                    }else{
                                        console.log(data.code);
                                        toastr.error('errors messages');
                                    }
                                },'json');
                            }
                        })
                        
                    }
                }
            });

            // Tampilkan modal jika klik tambah data baru
            $('#tambahJalanBaru').click(function(){
                $('#saveBtn').val('tambahJalan');
                $('#jalanId').val('');
                $('#jalanForm').trigger('reset');
                $('#saveBtn').html('Simpan');
                $('#modalHeading').html('Tambah Data Jalan');
                // membenarkan ukuran map dengan modal
                $('#jalanModal').on('shown.bs.modal', function(){
                    setTimeout(function(){
                        map.invalidateSize();
                    }, 0);
                })
                $('#jalanModal').modal('show');
                $('#kecamatanId').empty();
                // menghapus layer geoJSON
                map.eachLayer(function(layer){
                    if(!!layer.toGeoJSON){
                        map.removeLayer(layer);
                    }
                });
                // tambah batas kabupaten ke map
                L.geoJSON(kabupatenJson, {
                    style: kabupatenStyle,
                    pmIgnore: true,
                }).addTo(map);
                // menambahkan option pada select kecamatanId
                $('#kecamatanId').append($('<option>', {
                    text: "- Pilih Kecamatan -",
                }))
                @foreach($kecamatans as $kec)
                    $('#kecamatanId').append($('<option>', {
                        value: <?= $kec->id ?>,
                        text: "<?= $kec->namaKecamatan ?>",
                    }))
                @endforeach
            });

            // Edit Button
            $('body').on('click', '.editJalan', function () {
                var jalanId = $(this).data('id');
                var kecamatanId = $(this).data('kec');
                $('#saveBtn').html('Simpan');
                $.get("{{ route('jalan.index') }}" +'/' + jalanId + '/' + kecamatanId + '/edit', function (data) {
                    $('#modalHeading').html('Edit Data Jalan');
                    $('#saveBtn').val('editJalan');
                    $('#jalanModal').on('shown.bs.modal', function(){
                        setTimeout(function() {
                            map.invalidateSize();
                        }, 0);
                    });
                    $('#jalanModal').modal('show');
                    $('#jalanId').val(data.id);
                    $('#namaJalan').val(data.namaJalan);
                    $('#fungsiJalan').val(data.fungsiJalan);
                    $('#tipeJalan').val(data.tipeJalan);
                    $('#panjangJalan').val(data.panjangJalan);
                    $('#lebarJalan').val(data.lebarJalan);
                    $('#kapasitasJalan').val(data.kapasitasJalan);
                    $('#hambatanSamping').val(data.hambatanSamping);
                    $('#kondisiJalan').val(data.kondisiJalan);
                    $('#geoJsonJalan').val(data.geoJsonJalan);
                    $('#kecamatanId').empty();

                    // hapus layer sebelumnya
                    if(getKecamatanLayer != null && getJalanLayer != null){
                        getKecamatanGroup.removeLayer(getKecamatanLayer);
                        getJalanGroup.removeLayer(getJalanLayer);
                    }

                    // hapus layer geoJSON
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
                    
                    //menambahkan layer group menampilkan jalan dan kecamatan ke map
                    getJalanGroup.addTo(map);
                    getKecamatanGroup.addTo(map);

                    //menambah option sesuai dengan kecamatan id 
                    @foreach($kecamatans as $kec)
                        if('<?= $kec->id ?>' == data.kecamatanId ){
                            $('#kecamatanId').append($('<option>', {
                                value: <?= $kec->id ?>,
                                text: "- <?= $kec->namaKecamatan ?> -",
                            }))
                        }
                    @endforeach
                    
                    //menambah seluruh nama kecamatan 
                    @foreach($kecamatans as $kec)
                        if('<?= $kec->id ?>' == data.kecamatanId ){
                        }
                        $('#kecamatanId').append($('<option>', {
                            value: <?= $kec->id ?>,
                            text: "<?= $kec->namaKecamatan ?>",
                        }))
                    @endforeach
                    
                    //menampilkan wilayah kecamatan
                    @foreach($kecamatans as $kec)
                        if('<?= $kec->id ?>' == data.kecamatanId ){
                            getKecamatanLayer = L.geoJSON(<?= $kec->geoJsonKecamatan ?>,{
                                style: {
                                    'color': '<?= $kec->warnaKecamatan ?>',
                                    'fillOpacity': '0',
                                },
                                pmIgnore: true,
                            }).addTo(getKecamatanGroup);
                        }
                    @endforeach
                    
                    //menampilkan jalan 
                    var geoJsonJalan = JSON.parse(data.geoJsonJalan);
                    getJalanLayer = L.geoJSON(geoJsonJalan).addTo(getJalanGroup); 
                    
                    //edit jalan
                    getJalanLayer.on('pm:edit', function(e){
                        var layer = e.layer;
                        var data = e.layer.toGeoJSON();
                        var dataString = JSON.stringify(data);
                        $('#geoJsonJalan').val(dataString);
                    })

                });
            });

            // Delete Button
            $('body').on('click', '.deleteJalan', function(e){
                e.preventDefault();
                var jalanId = $(this).data("id");
                var kecamatanId = $(this).data("kec");
                var jalanKecamatanId = $(this). data("jalkec");
                var isDataLalin;
                var isDataLaka;
                var isDataMacet;

                @foreach($lalulintas as $lalin)
                    if(<?= $lalin->jalanKecamatanId ?> == jalanKecamatanId){
                        isDataLalin = true;
                    }
                @endforeach
                @foreach($titikLaka as $laka)
                    if(<?= $laka->jalanKecamatanId ?> == jalanKecamatanId){
                        isDataLaka = true;
                    }
                @endforeach
                @foreach($titikMacet as $macet)
                    if(<?= $macet->jalanKecamatanId ?> == jalanKecamatanId){
                        isDataMacet= true;
                    }
                @endforeach

                console.log(isDataLalin);
                
                if(isDataLalin == true || isDataLaka == true || isDataMacet == true){
                    swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:orange">Info!</h3>',
                        icon: 'error',
                            html:'Data jalan ini tidak bisa dihapus! silahkan hapus terlebih dahulu data <span style="color:red">lalulintas/titik kemacetan/ titik kecelakaan</span> yang terkait dengan jalan ini terlebih dahulu',
                        showCancelButton:false,
                        showCloseButton:true,
                        confirmButtonColor:'#28a745',
                        cancelButtonColor:'#d33',
                        width:500,
                        allowOutsideClick:false
                    })
                }else{
                    swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b></b> data jalan yang dipilih?',
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
                            $.post("{{ route('jalan.hapus') }}", {jalanId, kecamatanId},function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }
                            },'json');
                        }
                    })
                }
            })
        
            // Simpan perubahan
            $('#saveBtn').click(function(e){
                e.preventDefault();
                $(this).html('Mengirim .....');
                $.ajax({
                    data: $('#jalanForm').serialize(),
                    url: " {{ route('jalan.store') }} ",
                    type: "POST",
                    dataType: 'json',
                    success:function(data){
                        $('#jalanForm').trigger('reset');
                        $('#jalanModal').modal('hide');
                        toastr.success(data.msg);
                        table.draw();
                    },
                    error: function(data){
                        console.log('Error', data);
                    }
                })
            });
        });
    </script>
    <!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop