@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Lalu Lintas</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('lalulinta.update', $lalulinta->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Jalan</label>
                <input type="text" class="form-control" id="jalanId" name="jalanId" value="{{ $lalulinta->jalanId }}">
            </div>
            <div class="form-group">
                <label>Volume Lalu Lintas</label>
                <input type="text" class="form-control" id="volumeLaluLintas" name="volumeLaluLintas" value="{{ $lalulinta->volumeLaluLintas }}">
            </div>
            <div class="form-group">
                <label>Kecepatan Rata-Rata</label>
                <input type="text" class="form-control" id="kecepatanLaluLintas" name="kecepatanLaluLintas" value="{{ $lalulinta->kecepatanLaluLintas }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop