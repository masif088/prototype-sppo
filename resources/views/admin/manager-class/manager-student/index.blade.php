@extends('layouts.admin-master')

@section('title')
    <a href="{{route('admin.manager-class.index')}}">Manajemen Kelas</a> - Siswa {{$title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
    <a class="btn btn-primary" href="{{route('admin.manager-class.create-student',$title)}}">Tambah Siswa</a>
    <div class="table-responsive">
        <table class="table table-striped" id="table">
            <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Email</th>
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
                ajax: '{!! route("admin.manager-class.data-student",$title) !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            {{--const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';--}}
                            const delete_button = '<a href="' + data.delete_url + '" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>';
                            return '<span>' + delete_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
