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
        <a href="{{ route('lalulinta.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Lalu Lintas</a>
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
