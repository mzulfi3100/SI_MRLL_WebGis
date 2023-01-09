@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kecamatan</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('kecamatan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Kecamatan</label>
                <input type="text" class="form-control" id="namaKecamatan" name="namaKecamatan">
            </div>
            <div class="form-group">
                <label>Luas Kecamatan</label>
                <input type="text" class="form-control" id="luasKecamatan" name="luasKecamatan">
            </div>
            <div class="form-group">
                <label>Batas Kecamatan</label>
                <input type="text" class="form-control" id="batasKecamatan" name="batasKecamatan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@include('admin/footer')