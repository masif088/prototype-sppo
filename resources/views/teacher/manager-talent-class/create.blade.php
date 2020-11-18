@extends('layouts.admin-master')

@section('title')
    Manager Talent Class - Tambah Siswa
@endsection

@section('content')
    <form action="{{route('teacher.manager-talent-class.store')}}" method="post" role="form">
        @csrf
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Umur</label>
            <div class="col-sm-12 col-md-7">
                <input type="number" name="age" class="form-control" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Desa</label>
            <div class="col-sm-12 col-md-7">
                <select name="village" class="form-control" required>
                    <option value="Lembengan">Lembengan</option>
                    <option value="Slateng">Slateng</option>
{{--                    <option value="12">12</option>--}}
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
            <div class="col-sm-12 col-md-7">
                <select name="district" class="form-control" required>
                    <option value="Ledokombo">Ledokombo</option>
{{--                    <option value="Slateng">Slateng</option>--}}
                    {{--                    <option value="12">12</option>--}}
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button type="submit" value="add" name="add"
                        class="float-right btn btn-primary">Tambah
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')

@endsection
