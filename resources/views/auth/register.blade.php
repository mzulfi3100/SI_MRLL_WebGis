<?php $title="Tambah Admin"?>
@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
<div class="p-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12   ">
                    <div class="card">
                        <div class="card-header">{{ __('Tambah Akun Admin') }}</div>

                        <form action="{{ route('register.process') }}", method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin/footer')