@extends('layouts.admin-master')

@section('title')
    Manager Talent Class - Tambah soal ci
@endsection

@section('content')
    <form action="{{route('teacher.manager-talent-class.store-ci')}}" method="post" role="form">
        @csrf
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">pilihan a</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="a" class="summernote"></textarea>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">nilai a</label>
            <div class="col-sm-12 col-md-7">
                <select name="v_a" class="form-control" required>
                    <option value="1">eksistensial</option>
                    <option value="2">interpersonal</option>
                    <option value="3">intrapersonal</option>
                    <option value="4">kinestetik</option>
                    <option value="5">linguistik</option>
                    <option value="6">matematis</option>
                    <option value="7">musikal</option>
                    <option value="8">naturalis</option>
                    <option value="9">ruang</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">pilihan b</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="b" class="summernote"></textarea>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">nilai b</label>
            <div class="col-sm-12 col-md-7">
                <select name="v_b" class="form-control" required>
                    <option value="1">eksistensial</option>
                    <option value="2">interpersonal</option>
                    <option value="3">intrapersonal</option>
                    <option value="4">kinestetik</option>
                    <option value="5">linguistik</option>
                    <option value="6">matematis</option>
                    <option value="7">musikal</option>
                    <option value="8">naturalis</option>
                    <option value="9">ruang</option>
                </select>
            </div>
        </div>


        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">pilihan c</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="c" class="summernote"></textarea>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">nilai c</label>
            <div class="col-sm-12 col-md-7">
                <select name="v_c" class="form-control" required>
                    <option value="1">eksistensial</option>
                    <option value="2">interpersonal</option>
                    <option value="3">intrapersonal</option>
                    <option value="4">kinestetik</option>
                    <option value="5">linguistik</option>
                    <option value="6">matematis</option>
                    <option value="7">musikal</option>
                    <option value="8">naturalis</option>
                    <option value="9">ruang</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">pilihan d</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="d" class="summernote"></textarea>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">nilai d</label>
            <div class="col-sm-12 col-md-7">
                <select name="v_d" class="form-control" required>
                    <option value="1">eksistensial</option>
                    <option value="2">interpersonal</option>
                    <option value="3">intrapersonal</option>
                    <option value="4">kinestetik</option>
                    <option value="5">linguistik</option>
                    <option value="6">matematis</option>
                    <option value="7">musikal</option>
                    <option value="8">naturalis</option>
                    <option value="9">ruang</option>
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
