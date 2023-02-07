<?php $title="Data Kecamatan"?>
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
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-auto">
            <div class="card">
              <div class="p-2">
              <!-- </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- Trigger modal tambah data with a button -->
    <button type="button" class="btn btn-primary" href="javascript:void(0)" id="tambahKecamatanBaru">Tambah Data</button>
    
    <!-- Trigger selected delete data with a button -->
    <button class="btn btn-danger d-none" id="deleteAllBtn"></button><br></br>
    
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
                  <label>Nama Kecamatan <span style="color:red;">&#42;</span></label>
                  <input type="text" class="form-control" id="namaKecamatan" value="" name="namaKecamatan">
                </div>
                <div class="form-group">
                  <label>Warna Kecamatan <span style="color:red;">&#42;</span></label>
                  <input type="color" class="form-control" id="colorpicker" value=""> 
                  <input type="hidden" class="form-control" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" id="hexcolor" name="warnaKecamatan" value="">
                </div>
                <div class="form-group">
                  <label>Geo JSON Kecamatan <span style="color:red;">&#42;</span></label>
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
    <div>
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
    <table id="myTable" class="table table-striped yajra-datatable table-bordered">
        <thead class="table-dark"> 
            <tr>
              <th><i class="hiddentext" style="display:none">CheckBox</i><input type="checkbox" name="main_checkbox"><label></label></th>
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
    </div>
          </div>
        </div>
      </div>
    </section>
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
        "lengthChange": true,
        "lengthMenu": [ [10, 15, 25, 50, -1], [10, 15, 25, 50, "All"] ],
        'order': [[2, 'asc']],
        columnDefs: [
            {"className": "dt-center", "targets": [0, 1, ,4]},
            {orderable: false, searchable: false, targets: [0, 1, 3, 4]},
            {width: 10, targets: 0},
            {width: 40, targets: 1},
            {width: 330, targets: 2},
            {width: 220, targets: 3},
            {width: 220, targets: 4},
        ],
        columns: [
            {data: 'checkbox', name: 'checkbox', value: 'checkbox'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'namaKecamatan', name: 'namaKecamatan'},
            {data: 'warna', name: 'warna',},
            {data: 'action', name: 'action',},
        ],
        dom: 'lBfrtip',
        buttons: [
            {extend: 'spacer'},
            {extend: 'excelHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-success'},
            {extend: 'pdfHtml5', exportOptions: {columns: ':visible'}, className: 'btn btn-info'},
            {extend: 'colvis', columnText: function ( dt, idx, title) {return (idx+1)+'. '+title;}, className: 'btn btn-warning'},
        ],
        ajax: "{{ route('kecamatan.index') }}",
      }).on('draw', function(){
        $('input[name="kecamatan_checkbox"]').each(function(){
          this.checked = false;
        });
        // $(".buttons-html5").addClass("btn-success");
        // $(".buttons-html5").addClass("btn");
        $('input[name="main_checkbox"]').prop('checked', false);
        $('button#deleteAllBtn').addClass('d-none');
      });

      // bagian listing checkbox //
      $(document).on('click', 'input[name="main_checkbox"]', function(){
        if(this.checked){
          $('input[name="kecamatan_checkbox"]').each(function(){
            this.checked = true;
          });
        }else{
          $('input[name="kecamatan_checkbox"]').each(function(){
            this.checked = false;
          });
        }
        toggledeleteAllBtn();
      });

      //bagian listing 2 checkbox//
      $(document).on('change', 'input[name="kecamatan_checkbox"]', function(){
        if($('input[name="kecamatan_checkbox"]').length == $('input[name="kecamatan_checkbox"]:checked').length){
          $('input[name="main_checkbox"]').prop('checked', true);
        }else{
          $('input[name="main_checkbox"]').prop('checked', false);
        }
        toggledeleteAllBtn(); 
      });

      //bagian tampilan delete btn//

      function toggledeleteAllBtn(){
        if($('input[name="kecamatan_checkbox"]:checked').length > 0){
          $('button#deleteAllBtn').text('Hapus Data ('+$('input[name="kecamatan_checkbox"]:checked').length+')').removeClass('d-none');
        }else{
          $('button#deleteAllBtn').addClass('d-none');
        }
      }

      //bagian utama selected delete
      $(document).on('click', 'button#deleteAllBtn', function(){
        var checkedKecamatan = [];
        $('input[name="kecamatan_checkbox"]:checked').each(function(){
          checkedKecamatan.push($(this).data('id'));
        });
        // untuk melihat id data yang dipilih/checked
        // alert(checkedKecamatan);
        var url='{{ route("delete.selected.kecamatan")}}';
        if(checkedKecamatan.length > 0){
          var countKecamatan = [checkedKecamatan.length];
          swal.fire({
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            title:'<h3 style ="color:red">Peringatan!</h3>',
            icon: 'warning',
            html:'Apakah anda yakin ingin menghapus <b>'+checkedKecamatan.length+'</b> data kecamatan yang dipilih?',
            showCancelButton:true,
            showCloseButton:true,
            confirmButtonText:'Lanjutkan',
            cancelButtonText:'Kembali',
            confirmButtonColor:'#28a745',
            cancelButtonColor:'#d33',
            width:500,
            allowOutsideClick:false
          }).then(function(result){
            if(result.value){
              $.post(url, {kecamatan_id:checkedKecamatan, countingKecamatan:countKecamatan}, function(data){
                if(data.code == 1){
                  toastr.success(data.msg);
                  table.draw();
                }
              },'json');
            }
          })
        }
        //menghitung nilai kecamatan didalam checkbox
        // alert(countKecamatan);
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
            toastr.success(data.msg);
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

        swal.fire({
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        title:'<h3 style ="color:red">Peringatan!</h3>',
                        icon: 'warning',
                        html:'Apakah anda yakin ingin menghapus <b></b> data kecamatan yang dipilih?',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Lanjutkan',
                        cancelButtonText:'Kembali',
                        confirmButtonColor:'#28a745',
                        cancelButtonColor:'#d33',
                        width:500,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){
                            $.post("{{ route('kecamatan.destroy') }}", {kecamatanId},function(data){
                                if(data.code == 1){
                                    toastr.success(data.msg);
                                    table.draw();
                                }
                            },'json');
                        }
                    })
      });

    });    
  </script>
  
  <!-- End DataTable -->
  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop
