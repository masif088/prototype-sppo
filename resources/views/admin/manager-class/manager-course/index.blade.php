@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - Mapel {{$title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
    <a class="btn btn-primary" href="{{route('admin.manager-class.create-course',$title)}}">Tambah Mata Pelajaran</a>
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
                ajax: '{!! route("admin.manager-class.data-course",$title) !!}',
                columns: [
                    {data: 'course.title', name: 'course.title'},
                    // {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan Guru Pengajar</a>';
                            {{--const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';--}}
                            return '<span>' + show_button  + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
