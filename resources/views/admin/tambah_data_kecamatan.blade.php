@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Kecamatan</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop
@section('other')
    <div class="p-2">
        <form action="{{ route('kecamatan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Kecamatan</label>
                <input type="text" class="form-control" id="namaKecamatan" name="namaKecamatan">
            </div>
            <div class="form-group">
                <label>Warna Kecamatan</label>
                <input type="color" class="form-control" id="colorpicker"> 
                <input type="hidden" class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="hexcolor" name="warnaKecamatan">
            </div>
            <div class="form-group">
                <label>Batas Kecamatan</label>
                <input type="text" class="form-control" id="batasKecamatan" name="batasKecamatan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop 
@section('script_warna')
<script>
     $('#colorpicker').on('input', function() {
        $('#hexcolor').val(this.value);
        $('#hexcolor').value(this.value);
    });
</script>
@stop