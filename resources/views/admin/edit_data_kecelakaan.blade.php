@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Kecelakaan</h1>
                <div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="p-2">
        <form action="{{ route('kecelakaan.update', $kecelakaan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Jalan</label>
                <select class="form-control" id="jalanId" name="jalanId">

                    @foreach($jalans as $jln)
                        <?php if($jln->id == $kecelakaan->jalanId){ ?>
                            <option value="<?= $jln->id ?>"> - <?= $jln->namaJalan ?> - </option>
                        <?php } ?> 
                    @endforeach
                    @foreach($jalans as $jln)
                        <?php if($jln->id == $kecelakaan->jalanId){ ?>

                        <?php }else {?>
                            <option value="<?= $jln->id ?>"> <?= $jln->namaJalan ?> </option>
                        <?php }?> 
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Vatalitas Kecelakaan</label>
                <input type="text" class="form-control" id="vatalitasKecelakaan" name="vatalitasKecelakaan" value="{{ $kecelakaan->vatalitasKecelakaan }}">
            </div>
            <div class="form-group">
                <label>Penyebab Kecelaakan</label>
                <input type="text" class="form-control" id="penyebabKecelakaan" name="penyebabKecelakaan" value="{{ $kecelakaan->penyebabKecelakaan }}">
            </div>
            <div class="form-group">
                <label>Jumlah Kecelaakan</label>
                <input type="text" class="form-control" id="jumlahKecelakaan" name="jumlahKecelakaan" value="{{ $kecelakaan->jumlahKecelakaan }}">
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" class="form-control" id="tahunKecelakaan" name="tahunKecelakaan" value="{{ $kecelakaan->tahunKecelakaan }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop