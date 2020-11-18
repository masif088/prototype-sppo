@extends('layouts.admin-master')

@section('title')
    Manajemen Kelas - {{$title}} - Mapel - {{$course}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a href="{{route('teacher.manager-class.show',[$title,$course])}}" class="btn btn-primary">Rekap Nilai</a>
{{--                            <a href="{{route('teacher.manager-class.show',[$title,$course])}}" class="btn btn-primary">Input Nilai Akhir</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <h4>Module</h4>
                            <a class="btn btn-primary" href="{{route('teacher.manager-class.create-module',[$title,$course])}}">
                                Tambah Module
                            </a>
                            <a class="btn btn-primary" href="{{route('teacher.manager-class.show-module',[$title,$course])}}">
                                Import Module dari db sekolah
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

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <h4>Tugas</h4>
                            <a class="btn btn-primary" href="{{route('teacher.manager-class.create-mission',[$title,$course])}}">
                                Tambah Tugas
                            </a>
                            {{--    <a class="btn btn-primary" href="{{route('teacher.manager-class.create-module',[$title,$course])}}">Import Module dari db sekolah</a>--}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-mission">
                                    <thead>
                                    <tr>
                                        <th>Judul Tugas</th>
                                        <th>Mulai</th>
                                        <th>Berakhir</th>
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
                ajax: '{!! route('teacher.manager-class.data-module',[$title,$course]) !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'user.name', name: 'user.name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = {{Auth::user()->id}}==data.user_id ? '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>' : '';
                            // const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan</a>';
                            const delete_button = '<a href="' + data.delete_url + '" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>';
                            return '<span>' + edit_button + delete_button + '<span>';
                        }
                    },
                ],
            });

            $('#table-mission').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('teacher.manager-class.data-mission',[$title,$course]) !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan</a>';
                            const score_button = '<a href="' + data.score_url + '" class="btn btn-primary" role="button" aria-pressed="true">Memberi Nilai</a>';
                            const delete_button = '<a href="' + data.delete_url + '" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>';
                            return '<span>' + show_button + score_button + edit_button + delete_button + '<span>';
                        }
                    },
                ],
            });
        });

    </script>
@endsection

