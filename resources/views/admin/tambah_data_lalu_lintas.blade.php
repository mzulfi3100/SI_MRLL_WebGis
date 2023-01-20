@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Lalu Lintas</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('lalulinta.store') }}" method="POST">
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
                <label>Volume Lalu Lintas</label>
                <input type="text" class="form-control" id="volumeLaluLintas" name="volumeLaluLintas">
            </div>
            <div class="form-group">
                <label>Kecepatan Rata-Rata</label>
                <input type="text" class="form-control" id="kecepatanLaluLintas" name="kecepatanLaluLintas">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop