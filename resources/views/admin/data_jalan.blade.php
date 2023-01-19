@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Jalan</h1>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="p-4">
        <a href="{{ route('jalan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Jalan</a>
        <table class="table table-striped yajra-datatable p-3">
            <thead> 
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
                processing:true,
                serverSide:true,
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
                        orderable:true,
                        searchable:true,
                    },
                ]
            });
        });
    </script>
@stop