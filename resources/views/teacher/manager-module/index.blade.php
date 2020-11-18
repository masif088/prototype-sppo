@extends('layouts.admin-master')

@section('title')
    Manajemen Module
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" style="margin-bottom: 20px" href="{{route('teacher.manager-module.create')}}">
                                Tambah Module
                            </a>

                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Judul Materi</th>
                                        <th>Author</th>
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons:[
                    {extend:'csv',exportOptions: {
                            columns: [ 0, 1 ]
                        }}
                ],
                ajax: '{!! route('teacher.manager-module.data') !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'user.name', name: 'user.name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = {{Auth::user()->id}}== data.user_id ? '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>' : '';
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Lihat</a>';
                            return '<span>' + edit_button + show_button + '<span>';
                        }
                    },
                ],
            });

        });

    </script>
@endsection

