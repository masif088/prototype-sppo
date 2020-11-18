@extends('layouts.admin-master')

@section('title')
    Manager Student &mdash; {{$title}}
@endsection

@section('content')
    <a class="btn btn-primary" href="{{route('admin.manager-class.create')}}">Tambah Kelas</a>
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
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route("admin.manager-student.data",$title) !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';
                            return '<span>' + delete_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
