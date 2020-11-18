@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}}</a> - Tambah Tugas
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <form action="{{route('teacher.manager-class.store-mission',[$title,$course])}}"
                                  method="post" role="form">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul tugas atau
                                        ujian</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dimulai</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="start" class="form-control datetimepicker" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Berakhir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="end" class="form-control datetimepicker" required>
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
