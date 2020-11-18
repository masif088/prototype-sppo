@extends('layouts.admin-master')

@section('title')
    Manager Kelas - Tambah
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul tugas atau ujian</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="title" class="form-control" required value="{{$mission->title}}" disabled>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dimulai</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="start" class="form-control datetimepicker" disabled value="{{$mission->start}}">
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Berakhir</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="end" class="form-control datetimepicker" disabled value="{{$mission->end}}">
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <a href="{{route('student.manager-class.start-mission',[$title,$id])}}" class="btn btn-primary">Mulai Mengerjakan</a>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
