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

        var overlaysTree = 
            {
                label: 'Layers',
                selectAllCheckbox: 'Un/select all',
                children: [
                    {label: '<div id="onlysel">-Show only selected-</div>'},
                    {
                        label: 'Jalan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($jalans as $jln)
                            {
                                label: '<?= $jln->namaJalan ?>',
                                layer: L.geoJSON(<?= $jln->geoJsonJalan ?>, {
                                    onEachFeature: function (feature, layer) {
                                        layer.bindTooltip('<?= $jln->namaJalan ?>');
                                        if('<?= $jln->tingkatPelayananJalan ?>' == 'A'){
                                            layer.setStyle({color :'#3CB043'});
                                        }else if('<?= $jln->tingkatPelayananJalan ?>' == 'B'){
                                                layer.setStyle({color :'#3CB043'});
                                        }else if('<?= $jln->tingkatPelayananJalan ?>' == 'C'){
                                                layer.setStyle({color :'#3CB043'});
                                        }else if('<?= $jln->tingkatPelayananJalan ?>' == 'D'){
                                                layer.setStyle({color :'#3CB043'});
                                        }else if('<?= $jln->tingkatPelayananJalan ?>' == 'E'){
                                                layer.setStyle({color :'#FFF200'});
                                        }else if('<?= $jln->tingkatPelayananJalan ?>' == 'F'){
                                                layer.setStyle({color :'#FF0000'});
                                        }
                                    }
                                }).addTo(map),
                                name:   'Nama Jalan: ' + '<?= $jln->namaJalan ?>' + '<br>' +
                                        'Tipe Jalan: ' + '<?= $jln->tipeJalan ?>' + '<br>' +
                                        'Panjang Jalan: ' + '<?= $jln->panjangJalan ?>' + '<br>' +
                                        'Lebar Jalan: ' + '<?= $jln->lebarJalan ?>' + '<br>' +
                                        'Kapasitas Jalan: ' + '<?= $jln->kapasitasJalan ?>' + '<br>' +
                                        'Hambatan Samping: ' + '<?= $jln->hambatanJalan ?>' + '<br>' +
                                        'Kondisi Jalan :' + '<?= $jln->kondisiJalan ?>' + '<br>' +
                                        'Tingkat Pelayanan Jalan: ' + '<?= $jln->tingkatPelayananJalan ?>' + '<br>',
                            },
                            @endforeach
                        ]
                    }, {
                        label: 'Kecamatan',
                        selectAllCheckbox: true,
                        children: [
                            @foreach($kecamatans as $kec)
                                {
                                    label: '<?= $kec->namaKecamatan ?>', layer: L.geoJSON(<?= $kec->batasKecamatan ?>, {
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

    </script>
@stop