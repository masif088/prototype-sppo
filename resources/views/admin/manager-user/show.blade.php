@extends('layouts.admin-master')

@section('title')
    Manager Kelas - Tampilkan - {{$class->title}}
@endsection

@section('content')
    <form action="" method="post" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kelas</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" name="title" class="form-control" required>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tingkat</label>
            <div class="col-sm-12 col-md-7">
                <select name="level" class="form-control" required>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Akademik</label>
            <div class="col-sm-12 col-md-7">
                <select name="year" class="form-control" required>
                    <option value="2020/2021">2020/2021</option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Wali Kelas</label>
            <div class="col-sm-12 col-md-7">
                <select name="user_id" class="form-control" required>

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
