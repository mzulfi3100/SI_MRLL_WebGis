<?php $title="Data Apill"?>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-auto">
            <div class="card">
              <div class="p-2">
        <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahApillBaru">Tambah Data</button>
        <!-- Trigger selected delete data with a button -->
        <button class="btn btn-danger d-none" id="deleteAllBtn"></button><br></br>
        
        <table class="table table-striped yajra-datatable table-bordered">
            <thead class="table-dark">
                <tr>
                <th><i class="hiddentext" style="display:none">CheckBox</i><input type="checkbox" name="main_checkbox"><label></label></th>
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
    </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Tabel Apill -->
    <!-- Modal -->
    <div id="apillModal" class="modal fade" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form id="apillForm" name="apillForm">
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="">Nama Simpang <span style="color:red;">&#42;</span></label>
                        <input type="text" class="form-control" name="namaSimpang" id="namaSimpang" required> 
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="">Terkoneksi ATCS <span style="color:red;">&#42;</span></label>
                        <select class="form-control" name="terkoneksiATCS" id="terkoneksiATCS" required>
                            <option>- Pilih -</option>
                            <option value="Belum">Belum</option>
                            <option value="Sudah">Sudah</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="apillId" id="apillId">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Geo Json Apill <span style="color:red;">&#42;</span></label>
                        <textarea type="text" class="form-control" name="geoJsonApill" id="geoJsonApill" readonly required></textarea>
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
        var getApillGroup = new L.LayerGroup();
        var apillSelected;

        //meggambar 
        map.on('pm:create', (e)=> {
            var layer = e.layer;
            var data = layer.toGeoJSON();
            var dataString = JSON.stringify(data);
            $('#geoJsonApill').val(dataString);
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
    </script>
    <!-- End Tampil Map -->
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
@section('script_tabel')
    <!-- DataTable -->
    <script type="text/javascript">
        $(function(){
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
                    {"className": "dt-center", "targets": [0, 1, 4]},
                    {orderable: false, searchable: false, targets: [0, 1, 3, 4]},
                    {width: 10, targets: 0},
                    {width: 40, targets: 1},
                    {width: 270, targets: 2},
                    {width: 220, targets: 3},
                    {width: 270, targets: 4},
                ],
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaSimpang', name: 'namaSimpang'},
                    {data: 'terkoneksiATCS', name: 'terkoneksiATCS'},
                    {data: 'action', name: 'action'},
                ],
                dom: 'lBfrtip',
                buttons: [
                    {extend: 'spacer'},
                    {extend: 'excelHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-success', text: '<i class="fas fa-file-excel" aria-hidden="true"></i> Excell'},
                    {extend: 'pdfHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-info', text: '<i class="fas fa-file-pdf" aria-hidden="true"></i> PDF'},
                    {extend: 'colvis', columnText: function ( dt, idx, title) {return (idx+1)+'. '+title;}, className: 'btn btn-warning', text: 'Filter'},
                ],
                ajax: "{{ route('apill.index') }}",
            }).on('draw', function(){
                $('input[name="apill_checkbox"]').each(function(){
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            // bagian listing checkbox
            $(document).on('click', 'input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="apill_checkbox"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="apill_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
            });

            //bagian listing 2 checkbox
            $(document).on('change', 'input[name="apill_checkbox"]', function(){
                if($('input[name="jalan_checkbox"]').length == $('input[name="apill_checkbox"]:checked').length){
                    $('input[name="main_checkbox"]').prop('checked', true);
                }else{
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn(); 
            });
            
            //bagian tampilan delete btn
            function toggledeleteAllBtn(){
                if($('input[name="apill_checkbox"]:checked').length > 0){
                    $('button#deleteAllBtn').text('Hapus Data ('+$('input[name="apill_checkbox"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }
            
            //bagian utama selected delete
            $(document).on('click', 'button#deleteAllBtn', function(){
                var checkedApill = [];
                var url = '{{ route("delete.selected.apill")}}';
                $('input[name="apill_checkbox"]:checked').each(function(){
                    checkedApill.push($(this).data('id'))
                });
                
                // untuk melihat id data yang dipilih/checked
                // alert(checkedApill);
                if(checkedApill.length > 0){
                    var countApill = [checkedApill.length];
                    swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b>'+checkedApill.length+'</b> data apill yang dipilih?',
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
                            $.post(url, {apill_id:checkedApill, countingApill:countApill}, function(data){
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
                $('#terkoneksiATCS').empty();

                //hapus layer geoJSON
                map.eachLayer(function(layer) {
                    if (!!layer.toGeoJSON) {
                        console.log(layer);
                        map.removeLayer(layer);
                    }
                });

                //jika tidak ada geoJson apill yang tersimpan
                if(apillSelected != null){
                    getApillGroup.removeLayer(apillSelected);
                }
                
                //memasukkan json kabupatan ke dalam map
                L.geoJSON(kabupatenJson, {
                    style: kabupatenStyle, 
                    pmIgnore: true, //diabaikan oleh geomann
                }).addTo(map);

                //tambah option terkoneksiATCS
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

            // edit data
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
                    $('#terkoneksiATCS').empty();

                    //hapus layer geoJSON
                    map.eachLayer(function(layer) {
                        if (!!layer.toGeoJSON) {
                            console.log(layer);
                            map.removeLayer(layer);
                        }
                    });

                    //jika tidak ada geoJson apill yang tersimpan
                    if(apillSelected != null){
                        getApillGroup.removeLayer(apillSelected);
                    }

                    //memasukkan json kabupatan ke dalam map
                    L.geoJSON(kabupatenJson, {
                        style: kabupatenStyle, 
                        pmIgnore: true, //diabaikan oleh geomann
                    }).addTo(map);
                    
                    // tambah option pada select terkoneksiATCS
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
                    
                    // menampilkan marker apill pada id yang dipilih
                    getApillGroup.addTo(map);
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

            // simpan button
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

            // delete data
            $('body').on('click', '.deleteApill', function () {
                var apillId = $(this).data("id");
                
                swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b></b> data apill yang dipilih?',
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
                            $.post("{{ route('apill.destroy') }}", {apillId},function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }else{
                                    toastr.error(data.msg);
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
