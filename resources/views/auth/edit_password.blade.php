<?php $title="Ubah Password"?>
@extends('admin/template')
@section('content')
    <div class="p-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12   ">
                    <div class="card">
                        <div class="card-header">{{ __('Ubah password') }}</div>

                        <form action="{{ route('update.password') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="oldPasswordInput" class="form-label">Password Lama</label>
                                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                        placeholder="Password Lama">
                                    @error('old_password')
                                        <span class="text-danger">Password Lama Harus Diisi</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordInput" class="form-label">Password Baru</label>
                                    <input name="new_password" type="password" class="form-control" id="newPasswordInput"
                                        placeholder="Password Baru">
                                    @error('new_password')
                                        <span class="text-danger">Konfirmasi Password Baru Tidak Cocok</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPasswordInput" class="form-label">Konfirmasi Password Baru</label>
                                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                        placeholder="Confirm Password Baru">
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-success">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script_tabel')
    <script>
        @if (Session::has('status'))
            toastr.success("{{ Session::get('status') }}");
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
@stop
