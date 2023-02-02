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

        L.geoJSON(kabupatenJson, {
            style: kabupatenStyle
        }).addTo(map);

        var totalKec;

        var overlaysTree = 
            {
                label: 'Layers',
                selectAllCheckbox: 'Un/select all',
                children: [
                    {label: '<div id="onlysel">-Show only selected-</div>'},
                    {
                        label: 'Titik Kecelakaan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($titikLaka as $titik)
                            {
                                label: '<?= $titik->lokasiKecelakaan ?>',
                                layer: L.geoJSON(<?= $titik->geoJsonKecelakaan ?>).addTo(map),
                                name:   'Lokasi: ' + '<?= $titik->lokasiKecelakaan ?>' + '<br>' +
                                        'Deskripsi: ' + '<?= $titik->deskripsiKecelakaan ?>' + '<br>' 
                                        
                            },
                            @endforeach
                        ]
                    },  {
                        label: 'Jalan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($perhitungan as $htg)
                            {
                                label: '<?= $htg->namaJalan ?>', 
                                layer: L.geoJSON(<?= $htg->geoJsonJalan ?>, {
                                    onEachFeature: function (feature, layer) {
                                        layer.bindTooltip('<?= $htg->namaJalan ?>');
                                        if('<?= $htg->nilai ?>' > 0){
                                            layer.setStyle({color :'#FF0000'});
                                        }else if('<?= $htg->nilai ?>' < 0){
                                            layer.setStyle({color :'#3CB043'});
                                        }
                                    }
                                }).addTo(map),
                                name:   '<div style="max-height: 200px; overflow-y: auto"' +
                                            '<div class="card">' +
                                                '<div class="card-header">' +
                                                    '<h3 class="card-title">' + '<?= $htg->namaJalan ?>' +'</h3>' +
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<table class="table">' +
                                                        '<tbody>' +
                                                            '<th>Data Jalan</th>' +
                                                            '<tr>' +
                                                                '<td>Nama Jalan</td>' +
                                                                '<td>:' + '<?= $htg->namaJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Tipe Jalan</td>' +
                                                                '<td>:' + '<?= $htg->tipeJalan ?>' + '</td>'+
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Panjang Jalan</td>' +
                                                                '<td>:' + '<?= $htg->panjangJalan ?>' + '</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Lebar Jalan:</td>' +
                                                                '<td>:' + '<?= $htg->lebarJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kapasitas Jalan:</td>' +
                                                                '<td>:' + '<?= $htg->kapasitasJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Hambatan Samping</td>' +
                                                                '<td>:' + '<?= $htg->hambatanSamping ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Kondisi Jalan</td>' +
                                                                '<td>:' + '<?= $htg->kondisiJalan ?>' +'</td>' +
                                                            '</tr>' +
                                                            '<th>Data Kecelakaan</th>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Ringan</td>' +
                                                                @foreach($totalKecelakaan as $total)
                                                                    <?php if($total->jalanKecamatanId == $htg->jalanKecamatanId){ ?>
                                                                        '<td>:' +" <?= $total->jumlahKorbanLukaRingan ?>" +'</td>' + 
                                                                    <?php } ?>
                                                                @endforeach
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Luka Berat</td>' +
                                                                @foreach($totalKecelakaan as $total)
                                                                    <?php if($total->jalanKecamatanId == $htg->jalanKecamatanId){ ?>
                                                                        '<td>:' +" <?= $total->jumlahKorbanLukaBerat ?>" +'</td>' + 
                                                                    <?php } ?>
                                                                @endforeach
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Korban Meninggal Dunia</td>' +
                                                                @foreach($totalKecelakaan as $total)
                                                                    <?php if($total->jalanKecamatanId == $htg->jalanKecamatanId){ ?>
                                                                        '<td>:' +" <?= $total->jumlahKorbanMeninggalDunia ?>" +'</td>' + 
                                                                    <?php } ?>
                                                                @endforeach
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>Total Kecelakaan</td>' +
                                                                @foreach($totalKecelakaan as $total)
                                                                    <?php if($total->jalanKecamatanId == $htg->jalanKecamatanId){ ?>
                                                                        '<td>:' +" <?= $total->totalKecelakaan ?>" +'</td>' + 
                                                                    <?php } ?>
                                                                @endforeach
                                                            '</tr>' +
                                                            '<tr>' +
                                                                '<td>' + '<a href="/administrator/jalan/<?= $htg->jalanKecamatanId ?>/show" class="btn btn-warning btn-sm">Detail Jalan</a>' + '</td>' +
                                                            '</tr>' +
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>' +
                                                '<div class="card-footer">' +
                                                    
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

        var lay = L.control.layers.tree(baseTree, overlaysTree, {
                    namedToggle: true,
                    selectorBack: false,
                    closedSymbol: '&#8862; &#x1f5c0;',
                    openedSymbol: '&#8863; &#x1f5c1;',
                    collapseAll: 'Collapse all',
                    collapsed: false,
                });

        var makePopups = function(node) {
            if (node.layer) {
                node.layer.bindPopup(node.name);
            }
            if (node.children) {
                node.children.forEach(function(element) { makePopups(element); });
            }
        };
        makePopups(overlaysTree);

        lay.addTo(map).collapseTree().expandSelected().collapseTree(true);
        L.DomEvent.on(L.DomUtil.get('onlysel'), 'click', function() {
            lay.collapseTree(true).expandSelected(true);
        });

        map.addControl(L.control.search({position: 'topleft'}));

        L.control.Legend({
            position: "bottomleft",
            collapsed: false,
            symbolWidth: 15,
            opacity: 1,
            column: 2,
            legends: [{
                label: "Rawan Kecelakaan",
                type: "polyline",
                color: "#FF0000",
                weight: 2,
            },  {
                label: "Tidak Rawan Kecelakaan",
                type: "polyline",
                color: "#3CB043",
                weight: 2,
            }]
        }).addTo(map);

        L.control.browserPrint().addTo(map);

        map.on("browser-print-start", function(e){
            /*on print start we already have a print map and we can create new control and add it to the print map to be able to print custom information */
            L.control.Legend({
                position: "bottomleft",
                collapsed: false,
                symbolWidth: 15,
                opacity: 1,
                column: 2,
                legends: [{
                    label: "Rawan Kecelakaan",
                    type: "polyline",
                    color: "#FF0000",
                    weight: 2,
                },  {
                    label: "Tidak Rawan Kecelakaan",
                    type: "polyline",
                    color: "#3CB043",
                    weight: 2,
                }]
            }).addTo(e.printMap);
        });


    </script>
@stop