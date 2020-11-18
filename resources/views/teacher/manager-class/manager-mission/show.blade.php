@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}}</a> - Tugas {{$mission->title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <h4>Tugas Manager</h4>
                            <a class="btn btn-primary"
                               href="{{route('teacher.manager-class.create-mission-detail',[$title,$course,$mission->id])}}">Tambah
                                Soal</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>

                                        <th>Jenis Soal</th>
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
                ajax: '{!! route('teacher.manager-class.data-mission-detail',[$title,$course,$id]) !!}',
                columns: [

                    {
                        data: null,
                        name: 'type',
                        render: function (data) {
                            return (data.type === 1) ? 'Pilihan Ganda' : (data.type === 2) ? 'Jawaban Pendek' : 'Jawaban Panjang';
                        }

                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            // const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan</a>';
                            const delete_button = '<a href="' + data.delete_url + '" class="btn btn-danger" role="button" aria-pressed="true">Hapus</a>';
                            return '<span>' + edit_button + delete_button + '<span>';
                        }
                    },
                ],
            });

        });

    </script>
@endsection

