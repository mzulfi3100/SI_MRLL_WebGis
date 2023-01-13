@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
    @yield('content')
</div>
@yield('other')
@include('admin/footer')