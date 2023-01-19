@extends('admin/template')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kecamatan</h1>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="p-4">
        <a href="{{ route('kecamatan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a>
        <table class="table table-striped yajra-datatable p-3">
            <thead> 
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
        processing: true,
        serverSide: true,
        ajax: "{{ route('administrator.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'namaKecamatan', name: 'namaKecamatan'},
            {
                data: 'warna', 
                name: 'warna', 
                orderable: true, 
                searchable: true
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
  });
</script>
@stop
