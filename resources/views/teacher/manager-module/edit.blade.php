@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-module.index')}}">Manajemen Module</a> - Ubah {{$module->title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
    <form action="{{route('teacher.manager-module.update',[$module->id])}}" method="post" role="form" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Materi</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="title" class="form-control" value="{{$module->title}}" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Materi</label>
            <div class="col-sm-12 col-md-7">
                <textarea name="short_description" class="form-control">
                    {{$module->short_description}}
                </textarea>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi materi</label>
            <div class="col-sm-12 col-md-7">
                <textarea class="summernote" name="contents" required>
{{$module->contents}}
                </textarea>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
