@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - <a
        href="{{route('admin.manager-class.show-course',$title)}}">Siswa {{$title}}</a>  - Tambah Siswa
@endsection

@section('content')

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-class.create')}}">Tambah Siswa</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Kelas Sekarang</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route("admin.manager-class.data-not-student",$title) !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'student_infos.0.manager_class.title', name: 'student_infos.0.manager_class.title'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const add_button = '<a href="' + data.add_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tambah</a>';
                            return '<span>' + add_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
