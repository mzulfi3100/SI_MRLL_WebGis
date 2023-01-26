@extends('admin/template')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Kecamatan</h1>
      </div><!-- /.row -->

      <!-- Tampil Tanggal dan Jam -->
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
      </div><!-- End Tampil Tanggal dan Jam -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Tabel Data Kecamatan -->
  <div class="p-4">
      <a href="{{ route('kecamatan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a>
      <!-- <a href="{{ route('kecamatan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a> -->
        <!-- Trigger modal tambah data with a button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahKecamatan">Tambah Data</button>
        <!-- Trigger modal hapus all data with a button -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapusSemuaKecamatan">&nbsp;Hapus Semua</button>
            <div id="modalHapusSemuaKecamatan" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" style ="color:red" id="hapus-jalan">Peringatan! </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Apakah anda yakin semua Data Kecamatan akan dihapus?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="{{ route('kecamatan.delete.all.truncate') }}" class="btn btn-danger">Lanjutkan</a>
                  </div>
                </div>
              </div>
            </div>
        <!-- Modal -->
        <div id="modalTambahKecamatan" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewJurnalLabel">Tambah Data Kecamatan </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                    <span aria-hidden="true">&times;</span>
                  </button>   
                </div>
                <form action="{{ route('kecamatan.store') }}" method="POST">
                  @csrf
                  <div class="modal-body">
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
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              @section('script_warna')
              <script>
              $('#colorpicker').on('input', function() {
                $('#hexcolor').val(this.value);
                $('#hexcolor').value(this.value);
              });
              </script>
              @stop
            </div>
          </div>
        <div>&nbsp;
        </div>
        
        <!-- table -->
      <table class="table table-striped yajra-datatable p-3">
          <thead class="table-dark"> 
              <tr>
                <th>No</th>
                <th>Nama Kecamatan</th>
                <th>Warna Kecamatan</th>
                <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
  <!-- End Tabel Data Kecamatan -->
@stop
@section('script_tabel')
  <!-- DataTable -->
  <script type="text/javascript">
    $(function () {
      var table = $('.yajra-datatable').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('administrator.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'namaKecamatan', name: 'namaKecamatan'},
            {
                data: 'warna', 
                name: 'warna', 
                orderable: false, 
                searchable: false
            },
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
  <!-- End DataTable -->
  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
