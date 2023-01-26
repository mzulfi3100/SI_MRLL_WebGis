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
    <!-- Trigger modal tambah data with a button -->
    <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahKecamatanBaru">Tambah Data</button>
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
    <div id="modalKecamatan" class="modal fade" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form id="kecamatanForm" name="kecamatanForm">
            <div class="modal-header">
              <h5 class="modal-title" id="modalHeading"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                <span aria-hidden="true">&times;</span>
              </button>   
            </div>
            <div class="modal-body">
                <input type="hidden" name="kecamatanId" id="kecamatanId">
                <div class="form-group">
                  <label>Nama Kecamatan</label>
                  <input type="text" class="form-control" id="namaKecamatan" value="" name="namaKecamatan">
                </div>
                <div class="form-group">
                  <label>Warna Kecamatan</label>
                  <input type="color" class="form-control" id="colorpicker" value=""> 
                  <input type="hidden" class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="hexcolor" name="warnaKecamatan" value="">
                </div>
                <div class="form-group">
                  <label>Geo JSON Kecamatan</label>
                  <input type="text" class="form-control" id="geoJsonKecamatan" name="geoJsonKecamatan" value="">
                </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" id="saveBtn" value="create" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div>&nbsp;
    </div>
    <!-- Hapus Modal -->
    <!-- <button type="button" class="delete btn btn-danger btn-sm" data-target="#modalHapusKecamatan" data-toggle="modal" >Delete</button>            -->
    <div id="modalHapusKecamatan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus-kecamatan">Hapus Data Kecamatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini ?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="kecamatan/'.$row->id.'/delete" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
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
  <!--- Ambil Warna Terinput -->
  <script>
      $('#colorpicker').on('input', function() {
          $('#hexcolor').val(this.value);
      });
  </script>
  <!-- End Ambil Warna Terinput -->
  <!-- DataTable -->
  <script type="text/javascript">
    $(function () {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var table = $('.yajra-datatable').DataTable({
        processing: false,
        serverSide: true,
        ajax: "{{ route('kecamatan.index') }}",
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
      
      $('#tambahKecamatanBaru').click(function(){
        $('#saveBtn').val('tambahKecamatan');
        $('#kecamatanId').val('');
        $('#kecamatanForm').trigger('reset');
        $('#saveBtn').html('Simpan');
        $('#modalHeading').html('Tambah Data Kecamatan');
        $('#modalKecamatan').modal('show')
      });

      $('body').on('click', '.editKecamatan', function () {
        var kecamatanId = $(this).data('id');
        $('#saveBtn').html('Simpan');
        $.get("{{ route('kecamatan.index') }}" +'/' + kecamatanId +'/edit', function (data) {
            $('#modalHeading').html('Edit Data Kecamatan');
            $('#saveBtn').val('editKecamatan');
            $('#modalKecamatan').modal('show');
            $('#kecamatanId').val(data.id);
            $('#namaKecamatan').val(data.namaKecamatan);
            $('#colorpicker').val(data.warnaKecamatan);
            $('#hexcolor').val(data.warnaKecamatan);
            $('#geoJsonKecamatan').val(data.geoJsonKecamatan);
        });
      });

      $('#saveBtn').click(function(e){
        console.log('tes');
        e.preventDefault();
        $(this).html('Mengirim ....');

        $.ajax({
          data: $('#kecamatanForm').serialize(),
          url: "{{ route('kecamatan.store') }}",
          type: "POST",
          dataType: 'json',
          success: function(data){
            console.log('save');
            $('#kecamatanForm').trigger('reset');
            $('#modalKecamatan').modal('hide');
            table.draw();
          },
          errror: function(data){
            console.log('erorr');
            console.log('Error', data);
            $('#saveBtn').html('Save Changes');
          }
        });
      });

      $('body').on('click', '.deleteKecamatan', function () {
        var kecamatanId = $(this).data("id");
        confirm("Are You sure want to delete !");
        
        $.ajax({
            type: "DELETE",
            url: "{{ route('kecamatan.store') }}"+'/'+kecamatanId,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      });

    });    
  </script>
  <!-- End DataTable -->
  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
