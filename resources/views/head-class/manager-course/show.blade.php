@extends('layouts.admin-master')

@section('title')

    Manager Courses - {{$title}} - {{$courses->course->title}}
@endsection

@section('content')
    <a class="btn btn-primary" href="{{route('admin.manager-course.create',$title)}}">Tambah Kelas</a>
    <div class="table-responsive">
        <table class="table table-striped" id="table">
            <thead>
            <tr>
                <th>Nama Guru Mapel</th>
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
                ajax: '{!! route("admin.manager-course.dataCourse",[$title,$id]) !!}',
                columns: [
                    {data: 'user.name', name: 'name'},
                    // {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan</a>';
                            const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';
                            return '<span>' + show_button + delete_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
