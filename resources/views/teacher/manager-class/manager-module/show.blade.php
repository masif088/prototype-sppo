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
                            <h4>Module Manager</h4>

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
            $('#table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('teacher.manager-class.data-not-module',[$title,$course]) !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'user.name', name: 'user.name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            {{--const edit_button = {{Auth::user()->id}}==--}}
                            {{--data.user_id ? '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>' : '';--}}
                            const show_button = '<a href="' + data.add_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tambahkan</a>';
                            // const delete_button = '<a href="' + data.delete_url + '" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>';
                            return '<span>' + show_button + '<span>';
                        }
                    },
                ],
            });
        });

    </script>
@endsection

