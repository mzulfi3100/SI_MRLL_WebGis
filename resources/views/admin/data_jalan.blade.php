@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Jalan</h1>
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
        <a href="{{ route('jalan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data</a>
        <!-- Trigger modal hapus all data with a button -->
        <a href="#" type="button" class="btn btn-danger" >Hapus Semua</a>
        <table class="table table-striped yajra-datatable p-3">
            <thead class="table-dark"> 
                <tr>
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Panjang Jalan </th>
                    <th>Lebar Jalan </th>
                    <th>Kapasitas Jalan </th>
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
        $(function(){
            var table = $('.yajra-datatable').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('administrator.getJalan') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'namaJalan', name: 'namaJalan'},
                    {data: 'panjangJalan', name: 'panjangJalan'},
                    {data: 'lebarJalan', name: 'lebarJalan'},
                    {data: 'kapasitasJalan', name: 'kapasitasJalan'},
                    {
                        data: 'action', 
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });
        });
    </script>
    <!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop