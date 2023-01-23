@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kecamatan</h1>
        </div><!-- /.row -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a id="clock"></a></li>
            </ol>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a >
              <?php $hari=date('l');
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

//menampilkan format hari dalam bahasa indonesia
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
        <a href="{{ route('kecamatan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a>
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
@stop
@section('script_tabel')
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
@stop
