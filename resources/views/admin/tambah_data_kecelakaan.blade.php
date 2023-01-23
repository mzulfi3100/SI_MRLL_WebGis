@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Kecelakaan</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.Content Header -->

    <div class="p-2">
        <!-- Forms -->
        <form action="{{ route('kecelakaan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Jalan</label>
                <select class="form-control" id="jalanId" name="jalanId">
                    <option value=""> - Pilih Jalan - </option>
                    @foreach($jalans as $jln)
                        <option value="<?= $jln->id ?>"> <?= $jln->namaJalan ?> </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">   
                <label for="">Vatalitas Kecelakaan</label>
                <input class="form-control" type="text" name="vatalitasKecelakaan" id="vatalitasKecelakaan">
            </div>
            <div class="form-group">   
                <label for="">Penyebab Kecelakaan</label>
                <input class="form-control" type="text" name="penyebabKecelakaan" id="penyebabKecelakaan">
            </div>
            <div class="form-group">   
                <label for="">Jumlah Kecelakaan</label>
                <input class="form-control" type="text" name="jumlahKecelakaan" id="jumlahKecelakaan">
            </div>
            <div class="form-group">   
                <label for="">Tahun</label>
                <input class="form-control" type="text" name="tahunKecelakaan" id="tahunKecelakaan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /.Forms -->
    </div>
@stop