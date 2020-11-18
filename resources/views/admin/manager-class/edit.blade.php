@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - Ubah Kelas {{$class->title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <form action="{{route('admin.manager-class.update',$class->id)}}" method="post" role="form"
                                  enctype="multipart/form-data">
                                @csrf
                                {{method_field('PUT')}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kelas</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title" class="form-control" value="{{$class->title}}"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun
                                        Akademik</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="year" class="form-control" required>
                                            <option value="2020/2021" {{($class->year=="2020/2021")?'selected':''}}>
                                                2020/2021
                                            </option>
                                            <option value="2021/2022" {{($class->year=="2021/2022")?'selected':''}}>
                                                2021/2022
                                            </option>
                                            <option value="2022/2023" {{($class->year=="2022/2023")?'selected':''}}>
                                                2022/2023
                                            </option>
                                            <option value="2023/2024" {{($class->year=="2023/2024")?'selected':''}}>
                                                2023/2024
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Wali Kelas</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="user_id" class="form-control" required>
                                            @foreach($teachers as $teacher)
                                                <option
                                                    value="{{$teacher->id}}" {{($class->user_id==$teacher->id)?'selected':''}}>{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{($class->status==1)?'selected':''}}>Aktifkan</option>
                                            <option value="0" {{($class->status==0)?'selected':''}}>Non Aktifkan
                                            </option>
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
