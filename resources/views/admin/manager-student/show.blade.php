@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-student.index')}}">Manajemen Siswa</a> - Info Siswa
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">

                            <form action="{{route('admin.manager-student.updateInfoStudent',$user->id)}}" method="post" role="form">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control" required value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="birth_place" class="form-control" required value="{{$user->studentInfos[0]->birth_place}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="birth_date" class="form-control datepicker" required value="{{$user->studentInfos[0]->birth_date}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Umur</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text"  class="form-control" disabled value="{{$age}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="address" class="form-control" required >
                                            {{$user->studentInfos[0]->address}}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Wali</label>
                                    <div class="col-sm-12 col-md-7">
{{--                                        {{dd()}}--}}
                                        <input type="text" name="name" class="form-control" disabled value="{{($user->studentInfos[0]->parent)?$user->studentInfos[0]->parent->name:''}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
                                    <div class="col-sm-12 col-md-7">

                                        <input type="text" name="nis" class="form-control" value="{{$user->studentInfos[0]->nis}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NISN</label>
                                    <div class="col-sm-12 col-md-7">
                                        {{--                                        {{dd()}}--}}
                                        <input type="text" name="nisn" class="form-control" value="{{$user->studentInfos[0]->nisn}}">
                                    </div>
                                </div>




                                {{--                                <div class="form-group row mb-4">--}}
{{--                                    <label--}}
{{--                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <input type="text" name="email" class="form-control" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row mb-4">--}}
{{--                                    <label--}}
{{--                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <input type="password" name="password" class="form-control" id="password"--}}
{{--                                               required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row mb-4">--}}
{{--                                    <label--}}
{{--                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi--}}
{{--                                        Password</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <input type="password" name="confirm_password" class="form-control"--}}
{{--                                               id="confirm_password" required>--}}
{{--                                        <span id='message'></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row mb-4">--}}
{{--                                    <label--}}
{{--                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Agama</label>--}}
{{--                                    <div class="col-sm-12 col-md-7">--}}
{{--                                        <select name="role" class="form-control" required>--}}
{{--                                            <option value="0"{{()}}>Tidak disebutkan</option>--}}
{{--                                            <option value="1">Islam</option>--}}
{{--                                            <option value="2">Katolik</option>--}}
{{--                                            <option value="3">Kristen</option>--}}
{{--                                            <option value="4">Buddha</option>--}}
{{--                                            <option value="5">Hindu</option>--}}
{{--                                            <option value="6">Konghucu</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" value="add" name="add"
                                                class="float-right btn btn-primary">Tambah
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
