@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Lalu Lintas</h1>
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
        <!-- <a href="{{ route('lalulinta.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Lalu Lintas</a> -->
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahLaluLintas">Tambah Data </button>
        <!-- Trigger modal hapus all data with a button -->
        <a href="#" type="button" class="btn btn-danger" >Hapus Semua</a>
        <!-- Modal -->
        <div id="modalTambahLaluLintas" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewJurnalLabel">Tambah Data Lalu Lintas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red" >
                    <span aria-hidden="true">&times;</span>
                  </button>   
                </div>
                <form action="{{ route('lalulinta.store') }}" method="POST">
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
                <label>Volume Lalu Lintas</label>
                <input type="text" class="form-control" id="volumeLaluLintas" name="volumeLaluLintas">
            </div>
            <div class="form-group">
                <label>Kecepatan Rata-Rata</label>
                <input type="text" class="form-control" id="kecepatanLaluLintas" name="kecepatanLaluLintas">
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
        
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark"> 
                <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Volume Lalu Lintas</th>
                    <th>Kecepatan Rata-Rata</th>
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
        ajax: "{{ route('administrator.getLaluLinta') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'namaJalan', name: 'namaJalan'},
            {data: 'volumeLaluLintas', name: 'volumeLaluLintas'},
            {data: 'kecepatanLaluLintas', name: 'kecepatanLaluLintas'},
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
