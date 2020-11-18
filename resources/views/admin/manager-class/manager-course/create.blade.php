@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - <a href="{{route('admin.manager-class.show-course',$title)}}">Mapel {{$title}}</a>  - Tambah Mapel
@endsection

@section('content')

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Mata pelajaran</th>
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
                ajax: '{!! route("admin.manager-class.data-not-course",$title) !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    // {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const show_button = '<a href="' + data.add_course_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tambah Mata Pelajaran</a>';
                            return '<span>' + show_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
