

@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-user.index')}}">Manajemen User</a> - Ubah User - {{$user->name}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
    <form action="{{route('admin.manager-user.update',$user->id)}}" method="post" role="form">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="email" class="form-control" value="{{$user->email}}" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
            <div class="col-sm-12 col-md-7">
                <input type="password" name="password" class="form-control" id="password" value="">
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
            <div class="col-sm-12 col-md-7">
                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                <span id='message'></span>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button type="submit" value="add" name="add"
                        class="float-right btn btn-primary">Ubah
                </button>
            </div>
        </div>
    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>
@endsection
