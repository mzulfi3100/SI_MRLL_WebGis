<?php $title="Tambah Admin"?>
@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
    <div class="p-4">
        <h3 class="mb-4">REGISTER ADMIN</h3>
        <form action="{{ route('register.process') }}", method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="username" name="username" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@include('admin/footer')