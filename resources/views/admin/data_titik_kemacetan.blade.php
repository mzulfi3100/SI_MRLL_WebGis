<?php $title="Data Titik Kemacetan"?>
@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Titik Kemacetan</h1>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="p-2">
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahTitikMacetBaru">Tambah Data</button>
        <!-- Trigger selected delete data with a button -->
        <button class="btn btn-danger d-none" id="deleteAllBtn"></button><br></br>
        
        <table class="table table-striped yajra-datatable table-bordered">
            <thead class="table-dark">
                <tr>
                    <th><i class="hiddentext" style="display:none">CheckBox</i><input type="checkbox" name="main_checkbox"><label></label></th>
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
                </div>
                </div>
                </div>
                </div>
                </section>
    <!-- End Tabel Apill -->
    <!-- Modal -->
    <div id="titikMacetModal" class="modal fade" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="titikMacetForm" name="titikMacetForm">
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
                <input type="hidden" name="titikMacetId" id="titikMacetId">
                <input type="hidden" name="jalanKecamatanId" id="jalanKecamatanId">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Nama Kecamatan <span style="color:red;">&#42;</span></label>
                        <select class="form-control" id="kecamatanId" name="kecamatanId">
                            <option value=""> - Pilih Kecamatan - </option>
                            @foreach($dataKec as $kec)
                                <option value="<?= $kec->kecamatanId ?>"> <?= $kec->namaKecamatan ?> </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Nama Jalan <span style="color:red;">&#42;</span></label>
                        <select class="form-control" id="jalanId" name="jalanId">
                            <option value=""> - Pilih Jalan - </option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Lokasi <span style="color:red;">&#42;</span></label>
                        <input type="text" class="form-control" name="lokasiKemacetan" id="lokasiKemacetan">
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsiKemacetan" id="deskripsiKemacetan">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Geo Json Titik Kemacetan <span style="color:red;">&#42;</span></label>
                        <textarea type="text" class="form-control" name="geoJsonKemacetan" id="geoJsonKemacetan" readonly></textarea>
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
@stop
@section('copyright_data')
<footer class="main-footer">
    Copyright &copy; 2023<strong> Universitas Lampung.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
    </div>
</footer>
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
            fullscreenControl: {
                pseudoFullscreen: false
            },
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
                    collapseAll: 'Collapse all',
                    collapsed: true,
                    position: 'topleft'
                });

        

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
        var getTitikMacetGroup = new L.LayerGroup();
        var getJalanLayer;
        var getKecamatanLayer;
        var titikMacetSelected;
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
                            'color': '<?= $kec->warnaKecamatan ?>',
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
        $('#kecamatanId').on('contextmenu', function(){
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
        $('#jalanId').on('contextmenu', function(){
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
            $('#geoJsonKemacetan').val(dataString);
            //update
            e.layer.on('pm:update', (ed)=> {
                var layer = e.layer;
                var data = layer.toGeoJSON();
                var dataString = JSON.stringify(data);
                $('#geoJsonKemacetan').val(dataString);
                drawnItem.addLayer(layer);
            })
        })

        //hapus
        map.on('pm:remove', (e)=> {
            $('#geoJsonKemacetan').val('');
        })
        
        map.addControl(L.control.search({position: 'topleft'}));

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

        //menambahkan layer control tree ke map
        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
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
                "lengthMenu": [ [10, 15, 25, 50, -1], [10, 15, 25, 50, "All"] ],
                'order': [[2, 'asc']],
                columnDefs: [
                    {"className": "dt-center", "targets": [0, 1, 6]},
                    {orderable: false, searchable: false, targets: [0, 1, 6]},
                    {width: 10, targets: 0},
                    {width: 20, targets: 1},
                    {width: 140, targets: 2},
                    {width: 120, targets: 3},
                    {width: 200, targets: 4},
                    {width: 140, targets: 5},
                    {width: 50, targets: 6},
                ],
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaJalan', name: 'namaJalan'},
                    {data: 'namaKecamatan', name: 'namaKecamatan'},
                    {data: 'lokasiKemacetan', name: 'lokasiKemacetan'},
                    {data: 'deskripsiKemacetan', name: 'deskripsiKemacetan'},
                    {data: 'action', name: 'action'},
                ],
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'spacer'},
                    {extend: 'excelHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-success', text: '<i class="fas fa-file-excel" aria-hidden="true"></i> Excell'},
                    {extend: 'pdfHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-info', text: '<i class="fas fa-file-pdf" aria-hidden="true"></i> PDF'},
                    {extend: 'colvis', columnText: function ( dt, idx, title) {return (idx+1)+'. '+title;}, className: 'btn btn-warning', text: 'Filter'},
                ],
                ajax: "{{ route('titik_kemacetan.index') }}",
            }).on('draw', function(){
                $('input[name="titikKemacetan_checkbox"]').each(function(){
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            // bagian listing checkbox
            $(document).on('click', 'input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="titikKemacetan_checkbox"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="titikKemacetan_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
            });

            //bagian listing 2 checkbox
            $(document).on('change', 'input[name="titikKemacetan_checkbox"]', function(){
                if($('input[name="titikKemacetan_checkbox"]').length == $('input[name="titikKemacetan_checkbox"]:checked').length){
                    $('input[name="main_checkbox"]').prop('checked', true);
                }else{
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn(); 
            });
            
            //bagian tampilan delete btn
            function toggledeleteAllBtn(){
                if($('input[name="titikKemacetan_checkbox"]:checked').length > 0){
                    $('button#deleteAllBtn').text('Hapus Data ('+$('input[name="titikKemacetan_checkbox"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }
            
            //bagian utama selected delete
            $(document).on('click', 'button#deleteAllBtn', function(){
                var checkedTitikKemacetan = [];
                var url = '{{ route("delete.selected.titikKemacetan")}}';
                $('input[name="titikKemacetan_checkbox"]:checked').each(function(){
                    checkedTitikKemacetan.push($(this).data('id'))
                });
                
                // untuk melihat id data yang dipilih/checked
                // alert(checkedTitikKemacetan);
                if(checkedTitikKemacetan.length > 0){
                    var countTitikKemacetan= [checkedTitikKemacetan.length];
                    swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b>'+checkedTitikKemacetan.length+'</b> data titik kemacetan yang dipilih?',
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
                            $.post(url, {titikKemacetan_id:checkedTitikKemacetan, countingTitikKemacetan:countTitikKemacetan}, function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }
                            },'json');
                        }
                    })
                }
            });

            $('#tambahTitikMacetBaru').click(function(){
                $('#saveBtn').val('tambahTitikMacet');
                $('#titikMacetId').val('');
                $('#titikMacetForm').trigger('reset');
                $('#saveBtn').html('Simpan');
                $('#modalHeading').html('Tambah Data Titik Kemacetan');
                $('#titikMacetModal').on('shown.bs.modal', function(){
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 0);
                });
                $('#titikMacetModal').modal('show');
                $('#kecamatanId').empty();
                $('#jalanId').empty();
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        console.log(layer);
                        map.removeLayer(layer);
                    }
                });

                if(getKecamatanLayer != null && getJalanLayer != null && titikMacetSelected != null){
                    getKecamatanGroup.removeLayer(getKecamatanLayer);
                    getJalanGroup.removeLayer(getJalanLayer);
                    getTitikMacetGroup.removeLayer(titikMacetSelected);
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
            });

            $('body').on('click', '.editTitikMacet', function () {
                var titikMacetId = $(this).data('id');
                $('#saveBtn').html('Simpan');
                $.get("{{ route('titik_kemacetan.index') }}" +'/' + titikMacetId +'/edit', function (data) {
                    $('#modalHeading').html('Edit Data Titik Kemacetan');
                    $('#saveBtn').val('editTitikMacet');
                    $('#titikMacetModal').on('shown.bs.modal', function(){
                        setTimeout(function() {
                            map.invalidateSize();
                        }, 0);
                    });
                    $('#titikMacetModal').modal('show');
                    $('#titikMacetId').val(data.id);
                    $('#lokasiKemacetan').val(data.lokasiKemacetan);
                    $('#deskripsiKemacetan').val(data.deskripsiKemacetan);
                    $('#geoJsonKemacetan').val(data.geoJsonKemacetan);
                    $('#jalanKecamatanId').val(data.jalanKecamatanId);
                    $('#kecamatanId').empty();
                    $('#jalanId').empty();

                    if(getKecamatanLayer != null && getJalanLayer != null && titikMacetSelected != null){
                        getKecamatanGroup.removeLayer(getKecamatanLayer);
                        getJalanGroup.removeLayer(getJalanLayer);
                        getTitikMacetGroup.removeLayer(titikMacetSelected);
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
                    getTitikMacetGroup.addTo(map);
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
                            
                        }else if(<?= $jln->kecamatanId ?> == data.kecamatanId){
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
                                    'color': '<?= $kec->warnaKecamatan ?>',
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
                    var geoJsonKemacetan = JSON.parse(data.geoJsonKemacetan);
                    titikMacetSelected = L.geoJSON(geoJsonKemacetan).addTo(getTitikMacetGroup); 

                    titikMacetSelected.on('pm:edit', function(e){
                        var layer = e.layer;
                        var data = e.layer.toGeoJSON();
                        var dataString = JSON.stringify(data);
                        $('#geoJsonKemacetan').val(dataString);
                    })

                });
            });

            $('#saveBtn').click(function(e){
                e.preventDefault();
                $(this).html('Mengirim ....');

                $.ajax({
                data: $('#titikMacetForm').serialize(),
                url: "{{ route('titik_kemacetan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data){
                    console.log('save');
                    $('#titikMacetForm').trigger('reset');
                    $('#titikMacetModal').modal('hide');
                    toastr.success(data.msg);
                    table.draw();
                },
                error: function(data){
                    console.log('erorr');
                    console.log('Error', data);
                    $('#saveBtn').html('Simpan');
                }
                });
            });

            $('body').on('click', '.deleteTitikMacet', function () {
                var titikKemacetanId = $(this).data("id");
                
                swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b></b> data titik kemacetan yang dipilih?',
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
                            $.post("{{ route('titikKemacetan.destroy') }}", {titikKemacetanId},function(data){
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
    <!-- End DataTable -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
