<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
  <!-- untuk memanggil file footer.blade.php -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@yield('script_peta')
<!-- jQuery -->
<script src="{{ asset('Admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
