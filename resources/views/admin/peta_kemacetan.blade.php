@extends('admin/template')
@section('content')
<div id="mapid" style="width: 1050px; height: 600px"></div>
@stop
@section('script_peta')
<script>
    var street = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var hybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var satellite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

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

    var batasKabupaten = L.geoJSON(kabupatenJson, {
        style: kabupatenStyle
    });

    var batasKecamatan = L.layerGroup();

    var myMap = L.map('mapid', {
        center: [-5.420000, 105.292969],
        zoom: 12.4,
        layers: [street, hybrid, satellite, batasKabupaten, batasKecamatan]
    });

    var baseMaps = {
        "Street": street,
        "Hybrid": hybrid,
        "Satellite": satellite,
    };

    var overlayMaps = {
        "Kabupaten": batasKabupaten,
        "Kecamatan": batasKecamatan
    };

    @foreach($kecamatans as $kec)
        var kecamatanStyle = {
            "color": "<?= $kec->warnaKecamatan ?>",
            "weight": 0,
            "opacity": 1,
            "fillOpacity": 0.5 ,
        };
        L.geoJSON(<?= $kec->batasKecamatan ?>,{
            style: kecamatanStyle    
        }).addTo(batasKecamatan).bindPopup(" <?= $kec->namaKecamatan ?> ");
    @endforeach
    
    var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(myMap);  

</script>
@stop
