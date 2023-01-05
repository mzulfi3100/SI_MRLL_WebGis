@extends('admin/template')
@section('content')
<div id="mapid" style="width: 1050px; height: 600px"></div>
@stop
@section('script_peta')
<script>
    var mymap = L.map("mapid").setView([ -5.390000, 105.292969], 12.4);

    L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
    {
        maxZoom: 18,
        attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: "mapbox/streets-v12",
        tileSize: 512,
        zoomOffset: -1,
        }
    ).addTo(mymap);
</script>
@stop
