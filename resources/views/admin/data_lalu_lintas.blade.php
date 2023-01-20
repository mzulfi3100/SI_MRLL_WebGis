@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Lalu Lintas</h1>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="p-4">
        <a href="{{ route('lalulinta.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Lalu Lintas</a>
        <table class="table table-striped yajra-datatable p-3">
            <thead> 
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
@stop
