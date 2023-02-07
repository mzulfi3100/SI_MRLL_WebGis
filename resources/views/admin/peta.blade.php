<?php $title="Peta"?>
@extends('admin/template')
@section('content')
    <div id="map" style="height:650px; width: 1050px;"></div>
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

        var macet = L.icon({
            iconUrl: '/macet.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var laka = L.icon({
            iconUrl: '/laka.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var atcs = L.icon({
            iconUrl: '/ATCS.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var apill = L.icon({
            iconUrl: '/apill.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41] 
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

        var blue = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

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
                        label: "Apill",
                        selectAllCheckbox: true,
                        children: [
                            @foreach($apills as $apill)
                                {
                                    label: '<?= $apill->namaSimpang ?>',
                                    layer: L.geoJSON(<?= $apill->geoJsonApill ?>, {
                                        onEachFeature: function(feature, layer){
                                            layer.bindTooltip('<?= $apill->namaSimpang ?>');
                                            if('<?= $apill->terkoneksiATCS ?>' == 'Sudah'){
                                                layer.setIcon(atcs);
                                            }else{
                                                layer.setIcon(apill);
                                            }
                                        }
                                    }).addTo(map),
                                    name:   '<div style="max-height: 200px; overflow-y: auto"' +
                                                '<div class="card">' +
                                                    '<div class="card-header">' +
                                                        '<h3 class="card-title" style="text-align: center" >' + '<?= $apill->namaSimpang ?>' +'</h3>' +
                                                    '</div>' +
                                                    '<div class="card-body">' +
                                                        '<table class="table">' +
                                                            '<tbody>' +
                                                                '<tr>' +
                                                                    '<td>Terkoneksi ATCS</td>' +
                                                                    '<td>: ' + '<?= $apill->terkoneksiATCS ?>' + '</td>' +
                                                                '</tr>' +
                                                            '</tbody>' +
                                                        '</table>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' 
                                },
                            @endforeach
                        ]
                    },  {
                        label: 'Titik Kecelakaan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($titikLaka as $titik)
                            {
                                label: '<?= $titik->lokasiKecelakaan ?>',
                                layer: L.geoJSON(<?= $titik->geoJsonKecelakaan ?>, {
                                            onEachFeature: function(feature, layer){
                                                layer.bindTooltip('<?= $titik->lokasiKecelakaan ?>');
                                                layer.setIcon(laka);
                                            }
                                        }).addTo(map),
                                name:   '<div style="max-height: 200px;  max-width: 400px; overflow-y: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title" style="text-align: center" >' + '<?= $titik->lokasiKecelakaan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<table class="table">' +
                                                        '<tbody>' +
                                                            '<th>Data Jalan</th>' +
                                                            '<tr>' +
                                                                '<td>Kecamatan</td>' +
                                                                '<td>:'  + '<?= $titik->namaKecamatan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Nama Jalan</td>' +
                                                                '<td>:' + '<?= $titik->namaJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Tipe Jalan</td>' +
                                                                '<td>:' + '<?= $titik->tipeJalan ?>' + '</td>'+
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Panjang Jalan</td>' +
                                                                '<td>:' + '<?= $titik->panjangJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Lebar Jalan:</td>' +
                                                                '<td>:' + '<?= $titik->lebarJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kapasitas Jalan:</td>' +
                                                                '<td>:' + '<?= $titik->kapasitasJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Hambatan Samping</td>' +
                                                                '<td>:' + '<?= $titik->hambatanSamping ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kondisi Jalan</td>' +
                                                                '<td>:' + '<?= $titik->kondisiJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<th>Data Kecelakaan</th>' +
                                                            '<tr>' +
                                                                '<td>Penyebab Kecelakaan</td>' +
                                                                '<td>:' +" <?= $titik->penyebabKecelakaan ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Ringan</td>' +
                                                                '<td>:' +" <?= $titik->korbanLR ?>" +'</td>' + 
                                                             '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Berat</td>' +
                                                                '<td>:' +" <?= $titik->korbanLB ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Meninggal Dunia</td>' +
                                                                '<td>:' +" <?= $titik->korbanMD ?>" +'</td>' + 
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>' + '<a href="/administrator/jalan/<?= $titik->jalanKecamatanId ?>/show" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                            '</tr>' +
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' 
                                        
                            },
                            @endforeach
                        ]
                    },  {
                        label: 'Titik Kemacetan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($titikMacet as $titik)
                            {
                                label: '<?= $titik->lokasiKemacetan ?>',
                                layer: L.geoJSON(<?= $titik->geoJsonKemacetan ?>, {
                                    onEachFeature: function(feature, layer){
                                        layer.bindTooltip('<?= $titik->lokasiKemacetan ?>');
                                        layer.setIcon(macet);
                                    }
                                }).addTo(map),
                                name:   '<div style="max-height: 200px;  max-width: 400px; overflow-x: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title" style="text-align: center" >' + '<?= $titik->lokasiKemacetan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<h8><b>Deskripsi Kemacetan</b></h8><br><br>' +
                                                    '<?= $titik->deskripsiKemacetan ?>' + 
                                                '</div>' +
                                            '</div>' +
                                        '</div>' 
                            },
                            @endforeach
                        ]
                    },  {
                        label: 'Jalan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($jalans as $jln)
                            {
                                label: '<?= $jln->namaJalan ?>',
                                layer: L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                    onEachFeature: function (feature, layer) {
                                        layer.bindTooltip('<?= $jln->namaJalan ?>');
                                        @foreach($data as $lalin)
                                            if('<?= $lalin->jalanKecamatanId ?>' == '<?= $jln->jalanKecamatanId ?>'){
                                                if('<?= $lalin->tingkatKemacetan ?>' == "Rendah"){
                                                layer.setStyle({color :'#3CB043'});
                                                }else if('<?= $lalin->tingkatKemacetan ?>' == "Sedang"){
                                                        layer.setStyle({color :'#FFF200'});
                                                }else if('<?= $lalin->tingkatKemacetan ?>' == "Tinggi"){
                                                        layer.setStyle({color :'#FF0000'});
                                                }
                                            }
                                        @endforeach
                                    }
                                }).addTo(map),
                                name:   '<div style="max-height: 200px; overflow-y: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title">' + '<?= $jln->namaJalan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<table class="table">' +
                                                        '<tbody>' +
                                                            '<th>Data Jalan</th>' +
                                                            '<tr>' +
                                                                '<td>Kecamatan</td>' +
                                                                '<td>:'  + '<?= $jln->namaKecamatan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Nama Jalan</td>' +
                                                                '<td>:'  + '<?= $jln->namaJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Tipe Jalan</td>' +
                                                                '<td>:'  + '<?= $jln->tipeJalan ?>' + '</td>'+
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Panjang Jalan</td>' +
                                                                '<td>:'  + '<?= $jln->panjangJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Lebar Jalan:</td>' +
                                                                '<td>:'  + '<?= $jln->lebarJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kapasitas Jalan:</td>' +
                                                                '<td>: ' + '<?= $jln->kapasitasJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Hambatan Samping</td>' +
                                                                '<td>: ' + '<?= $jln->hambatanSamping ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kondisi Jalan</td>' +
                                                                '<td>: ' + '<?= $jln->kondisiJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            @foreach($data as $lalin)
                                                                <?php if($lalin->jalanKecamatanId ==  $jln->jalanKecamatanId){ ?>
                                                                '<th>Data Lalu Lintas</th>' +
                                                                        '<tr>' +
                                                                    '<td>Volume Lalu Lintas</td>' +
                                                                        '<td>: ' + '<?= $lalin->volume ?>' +'</td>' +
                                                                    '</tr>' +
                                                                    '<tr>' +
                                                                        '<td>Kecepatan Tempuh</td>' +
                                                                        '<td>: ' + '<?= $lalin->kecepatan ?>' +'</td>' +
                                                                    '</tr>' +
                                                                    '<tr>' +
                                                                        '<td>' + '<a href="/detail_jalan/<?= $jln->jalanKecamatanId ?>" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                                    '</tr>' +
                                                                <?php } ?>
                                                            @endforeach
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>'            
                            },
                            @endforeach
                        ]
                    }, {
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
                                    }),
                                    name: '<?= $kec->namaKecamatan ?>'
                                },
                            @endforeach
                        ]
                    },
                ]
            };

        

        var makePopups = function(node) {
            if (node.layer) {
                node.layer.bindPopup(node.name);
            }
            if (node.children) {
                node.children.forEach(function(element) { makePopups(element); });
            }
        };
        makePopups(overlaysTree);


        map.addControl(L.control.search({position: 'topleft'}));

        L.control.Legend({
            position: "bottomleft",
            collapsed: false,
            symbolWidth: 15,
            opacity: 1,
            column: 2,
            collapsed: true,
            legends: [{
                label: "Kemacetan Tinggi",
                type: "polyline",
                color: "#FF0000",
                weight: 2,
            },  {
                label: "Kemacetan Sedang",
                type: "polyline",
                color: "#FFF200",
                weight: 2,
            },  {
                label: "Kemacetan Rendah",
                type: "polyline",
                color: "#3CB043",
                weight: 2,
            },  {
                label: "Kemacetan Tidak Diketahui",
                type: "polyline",
                color: "lightblue",
                weight: 2,
            },  {
                label: "Rawan Laka",
                type: "image",
                url: '/laka.png',
            },  {
                label: "Titik Kemacetan",
                type: "image",
                url: '/macet.png',
            },  {
                label: "Terkoneksi ATCS",
                type: "image",
                url: "/ATCS.png"
            },  {
                label: "Tidak Terkoneksi ATCS",
                type: "image",
                url: "/apill.png"
            }]
        }).addTo(map);

        L.control.browserPrint().addTo(map);

        var lay = L.control.layers.tree(baseTree, overlaysTree, {
                    namedToggle: true,
                    selectorBack: false,
                    closedSymbol: '&#8862; &#x1f5c0;',
                    openedSymbol: '&#8863; &#x1f5c1;',
                    collapseAll: 'Collapse all',
                    collapsed: true,
                    position: 'topleft',
                });

        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
            L.DomEvent.on(L.DomUtil.get('onlysel'), 'click', function() {
            lay.collapseTree(true).expandSelected(true);
        });

        map.on("browser-print-start", function(e){
            /*on print start we already have a print map and we can create new control and add it to the print map to be able to print custom information */
            L.control.Legend({
                position: "bottomleft",
                collapsed: false,
                symbolWidth: 15,
                opacity: 1,
                column: 2,
                collapsed: false,
                legends: [{
                    label: "Kemacetan Tinggi",
                    type: "polyline",
                    color: "#FF0000",
                    weight: 2,
                },  {
                    label: "Kemacetan Sedang",
                    type: "polyline",
                    color: "#FFF200",
                    weight: 2,
                },  {
                    label: "Kemacetan Rendah",
                    type: "polyline",
                    color: "#3CB043",
                    weight: 2,
                },  {
                    label: "Kemacetan Tidak Diketahui",
                    type: "polyline",
                    color: "lightblue",
                    weight: 2,
                },  {
                    label: "Rawan Laka",
                    type: "image",
                    url: '/laka.png',
                },  {
                    label: "Titik Kemacetan",
                    type: "image",
                    url: '/macet.png',
                },  {
                    label: "Terkoneksi ATCS",
                    type: "image",
                    url: "/ATCS.png"
                },  {
                    label: "Tidak Terkoneksi ATCS",
                    type: "image",
                    url: "/apill.png"
                }]
            }).addTo(e.printMap);
        });

    </script>
@stop