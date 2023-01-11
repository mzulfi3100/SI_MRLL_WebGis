@extends('admin/template')
@section('content')
<div id="mapid" style="width: 1050px; height: 600px"></div>
@stop
@section('script_peta')
<script>
    var mymap = L.map("mapid").setView([ -5.390000, 105.292969], 12.4);

    L.tileLayer(
        'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
        {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
        }
    ).addTo(mymap);

    var myStyle = {
        "color": '#000000',
        "weight": 2,
        "opacity": 1,
        "fillOpacity": 0 ,
    };

    $.getJSON('/kabupaten.geojson', function(json){
        L.geoJSON(json, {
            style: myStyle
        }).addTo(mymap);
    });
    
        
</script>
@stop
