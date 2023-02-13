<?php $title="List Akun Admin"?>
@extends('admin/template')
@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Akun</h1>
            </div>
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
            </div>
            <!-- End Tampil Tanggal dan Jam -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="p-2">
                        <a type="button" class="btn btn-primary mb-4" href="/administrator/register" >Tambah Akun</a>
                        <!-- Table Yajra -->
                        <table class="table table-striped yajra-datatable table-bordered">
                            <thead class="table-dark"> 
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- End Table Yajra -->
                        </div>
    </div>
          </div>
        </div>
      </div>
    </section>
@stop
@section('script_tabel')
    <script>
         @if (Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
    <script type="text/javascript">
        // Render Data
        var table = $('.yajra-datatable').DataTable({
                processing: false,
                serverSide: true,
                columnDefs: [
                ],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'username', name: 'username'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            })
            // End Render Data
       
    </script>
@stop
