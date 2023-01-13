@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Kecamatan</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop
@section('other')
    <div class="p-2">
        <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kecamatan</label>
                <input type="text" class="form-control" id="namaKecamatan" name="namaKecamatan" value="{{ $kecamatan->namaKecamatan }}">
            </div>
            <div class="form-group">
                <label>Warna Kecamatan</label>
                <input type="color" class="form-control" id="colorpicker" value="{{ $kecamatan->warnaKecamatan }}"> 
                <input type="hidden" class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="hexcolor" name="warnaKecamatan" value="{{ $kecamatan->warnaKecamatan }}">
            </div>
            <div class="form-group">
                <label>Batas Kecamatan</label>
                <input type="text" class="form-control" id="batasKecamatan" name="batasKecamatan" value="{{ $kecamatan->batasKecamatan }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop
@section('script_warna')
<script>
    $('#colorpicker').on('input', function() {
        $('#hexcolor').val(this.value);
    });
</script>
@stop