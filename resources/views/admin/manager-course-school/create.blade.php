@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-course-school.index')}}">Manajemen Mapel Sekolah</a> - Tambah Mapel Sekolah
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <form action="{{route('admin.manager-course-school.store')}}" method="post" role="form">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mata
                                        Pelajaran</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control" required>
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
