<?php $title="Detail Jalan"?>
@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Jalan</h1>
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
    <div class="mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Peta Jalan</h3>
                <div class="card-tools">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="map" style="height:550px; width: 1000px;" class="mb-4"></div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jalan</h3>
                    <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama Jalan</td>
                            <td>: <?= $jalan->namaJalan ?></td>
                        </tr>
                        <tr>
                            <td>Tipe Jalan</td>
                            <td>: <?= $jalan->tipeJalan ?></td>
                        </tr>
                        <tr>
                            <td>Panjang Jalan</td>
                            <td>: <?= $jalan->panjangJalan ?></td>
                        </tr>
                        <tr>
                            <td>Lebar Jalan:</td>
                            <td>: <?= $jalan->lebarJalan ?></td>
                        </tr>
                        <tr>
                            <td>Kapasitas Jalan:</td>
                            <td>: <?= $jalan->kapasitasJalan ?></td>
                        </tr>
                        <tr>
                            <td>Hambatan Samping</td>
                            <td>: <?= $jalan->hambatanSamping ?></td>
                        </tr>
                        <tr>
                            <td>Kondisi Jalan</td>
                            <td>: <?= $jalan->kondisiJalan ?></td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div>
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1">
                        <h3 class="card-title mt-2 ml-4">Data Lalu Lintas</h3>
                    </div>
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <?php $count = 0 ?>
                            @foreach($lalulintas as $lalin)
                            <?php if($count == 0){ ?>
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-one-<?= $count ?>" role="tab" aria-controls="custom-tabs-one-<?= $count ?>" aria-selected="true"><?= $lalin->tahun ?></a>
                                </li>
                            <?php }else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-one-<?= $count ?>" role="tab" aria-controls="custom-tabs-one-<?= $count ?>" aria-selected="false"><?= $lalin->tahun ?></a>
                                </li>
                            <?php } ?>
                            <?php $count++ ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                        <?php $count = 0 ?>
                        @foreach($lalulintas as $lalin)
                        <?php if($count == 0){ ?>
                            <div class="tab-pane fade show active" id="custom-tabs-one-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-one-<?= $count ?>-tab">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Volume Lalu Lintas</td>
                                            <td>: <?= $lalin->volume ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kecepatan Tempuh</td>
                                            <td>: <?= $lalin->kecepatan ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{ ?>
                            <div class="tab-pane fade" id="custom-tabs-one-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-one-<?= $count ?>-tab">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Volume Lalu Lintas</td>
                                            <td>: <?= $lalin->volume ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kecepatan Tempuh</td>
                                            <td>: <?= $lalin->kecepatan ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                        <?php $count++ ?>
                        @endforeach
                        </div>
                    </div>
                <!-- /.card -->
                </div>
            </div>
            <div>
                <div class="card card-tabs">
                    <div class="card-header p-0 pt-1">
                        <h3 class="card-title mt-2 ml-4">Data Kecelakaan</h3>
                    </div>
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <?php $count = 0 ?>
                            @foreach($kecelakaan as $laka)
                            <?php if($count == 0){ ?>
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-two-<?= $count ?>" role="tab" aria-controls="custom-tabs-two-<?= $count ?>" aria-selected="true"><?= $laka->tahunKecelakaan ?></a>
                                </li>
                            <?php }else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-<?= $count ?>-tab" data-toggle="pill" href="#custom-tabs-two-<?= $count ?>" role="tab" aria-controls="custom-tabs-two-<?= $count ?>" aria-selected="false"><?= $laka->tahunKecelakaan ?></a>
                                </li>
                            <?php } ?>
                            <?php $count++ ?>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                        <?php $count = 0 ?>
                        @foreach($kecelakaan as $laka)
                        <?php if($count == 0){ ?>
                            <div class="tab-pane fade show active" id="custom-tabs-two-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-two-<?= $count ?>-tab">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Korban Meninggal Dunia</td>
                                            <td>: <?= $laka->korbanMD ?></td>
                                        </tr>
                                        <tr>
                                            <td>Korban Luka Berat</td>
                                            <td>: <?= $laka->korbanLB ?></td>
                                        </tr>
                                        <tr>
                                            <td>Korban Luka Ringan</td>
                                            <td>: <?= $laka->korbanLR ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Kecelakaan</td>
                                            <td>: <?= $laka->jumlahKecelakaan ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{ ?>
                            <div class="tab-pane fade" id="custom-tabs-two-<?= $count ?>" role="tabpanel" aria-labelledby="custom-tabs-two-<?= $count ?>-tab">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Korban Meninggal Dunia</td>
                                            <td>: <?= $laka->korbanMD ?></td>
                                        </tr>
                                        <tr>
                                            <td>Korban Luka Berat</td>
                                            <td>: <?= $laka->korbanLB ?></td>
                                        </tr>
                                        <tr>
                                            <td>Korban Luka Ringan</td>
                                            <td>: <?= $laka->korbanLR ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Kecelakaan</td>
                                            <td>: <?= $laka->jumlahKecelakaan ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                        <?php $count++ ?>
                        @endforeach
                        </div>
                    </div>
                <!-- /.card -->
                </div>
            </div>
            
        </div>
    </div>
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
        };

        // Layer Controls
        var lay = L.control.layers.tree(baseTree, overlaysTree, {
            namedToggle: true,
            selectorBack: false,
            closedSymbol: '&#8862; &#x1f5c0;',
            openedSymbol: '&#8863; &#x1f5c1;',
            collapsed: false,
        });

        //menambahkan layer control tree ke map
        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);

        // menampilkan batas kecamatan yang dipilih

        L.geoJSON(<?= $jalan->geoJsonKecamatan ?>, {
            style: {
                'fillOpacity': '0',
            },
            pmIgnore: true,
        }).addTo(map);

        L.geoJSON(<?= $jalan->geoJsonJalan ?>, {
            style: {
                'fillOpacity': '0',
            },
            pmIgnore: true,
        }).addTo(map);
    </script>
    <!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop