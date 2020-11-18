@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - <a
        href="{{route('admin.manager-class.show-course',$title)}}">Mapel {{$title}}</a>  - Tambah Guru Mapel
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <form action="{{route('admin.manager-class.update-teacher',[$title,$course,$id])}}"
                                  method="post" role="form">
                                @csrf
                                {{method_field('PUT')}}

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tag blogs</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="user_id[]" class="form-control select2" multiple="" required>
                                            @foreach($users as $user)
                                                <option
                                                    value="{{$user->id}}"@foreach($teachers as $teacher) {{($user->id==$teacher->user_id)?'selected':''}} @endforeach>{{$user->name}}</option>
                                            @endforeach
                                        </select>
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

@endsection
