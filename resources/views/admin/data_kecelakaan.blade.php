@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kecelakaan</h1>
          </div><!-- /.row -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a id="clock"></a></li>
            </ol>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a >
              <?php 
              $hari=date('l');
              $bulan=date('m');
              switch ($hari) {
                case"Sunday":$hari="Minggu";break;
                case"Monday":$hari="Senin";break;
                case"Tuesday":$hari="Selasa";break;
                case"Wednesday":$hari="Rabu";break;
                case"Thursday":$hari="Kamis";break;
                case"Friday":$hari="Jumat";break;
                case"Saturday":$hari="Sabtu";break;
              }
              //menampilkan translate hari ke bahasa indonesia
              $tanggal=date('d');
              $tahun=date('y');
              //menampilkan hari tanggal bulan dan tahun
              echo "$hari, $tanggal/$bulan/$tahun&nbsp;|&nbsp;"; 
              ?></a></li>
            </ol>
          </div>
        </div><!-- /.container-fluid -->
      </div>
          

    <!-- /.content-header -->
    <div class="p-4">
        <!-- <a href="{{ route('kecelakaan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecelakaan</a> -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKecelakaan">Tambah Data </button>
        <!-- Trigger modal hapus all data with a button -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapusSemuaKecelakaan">Hapus Semua</button>
            <div id="modalHapusSemuaKecelakaan" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" style ="color:red" id="hapus-jalan">Peringatan! </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Apakah anda yakin semua Data Kecelakaan akan dihapus?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="{{ route('kecamatan.delete.all.truncate') }}" class="btn btn-danger">Lanjutkan</a>
                  </div>
                </div>
              </div>
            </div>
        <!-- Modal -->
        <div id="modalTambahKecelakaan" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewJurnalLabel">Tambah Data Kecelakaan </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                    <span aria-hidden="true">&times;</span>
                  </button>   
                </div>
                <form action="{{ route('kecelakaan.store') }}" method="POST">
                  @csrf
                  <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div>&nbsp;
          </div>
          <!-- table -->
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark"> 
                <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Vatalitas Kecelakaan</th>
                    <th>Penyebab Kecelakaan</th>
                    <th>Jumlah Kecelakaan</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@stop
@section('script_tabel')
<script type="text/javascript">
  $(function () {
    var table = $('.yajra-datatable').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('administrator.getKecelakaan') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'namaJalan', name: 'namaJalan'},
            {data: 'vatalitasKecelakaan', name: 'vatalitasKecelakaan'},
            {data: 'penyebabKecelakaan', name: 'penyebabKecelakaan'},
            {data: 'jumlahKecelakaan', name: 'jumlahKecelakaan'},
            {data: 'tahunKecelakaan', name: 'tahunKecelakaan'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });
  });
</script>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
