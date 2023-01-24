@extends('admin/template')
@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data APILL</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Content Header -->

    <div class="p-4">
        <a href="{{ route('apill.create') }}" class="tambah btn btn-primary mb-2">Tambah Data Apill</a>
        <table class="table table-striped yajra-datatable p-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Simpang</th>
                    <th>Terkoneksi ATCS</th>
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
            ajax: "{{ route('administrator.getApill') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'namaSimpang', name: 'namaSimpang'},
                {data: 'terkoneksiATCS', name: 'terkoneksiATCS'},
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
@stop