@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}}</a> - Nilai {{$mission->title}}
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
                                        <th>Nama Siswa</th>
                                        <th>Progress</th>
                                        <th>Score</th>
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
                dom: 'Bfrtip',
                buttons:[
                    {extend:'csv',exportOptions: {
                            columns: [ 0,1,2,3]
                        }}
                ],
                ajax: '{!! route('teacher.manager-class.data-mission-score',[$title,$course,$id]) !!}',
                columns: [
                    {data: 'user.name', name: 'user.name'},
                    {
                        data: null,
                        name: "value_progress",
                        render: function (data) {
                            const a = "<div class='progress' data-height='1' data-toggle='tooltip' title='" + data.value_progress + "'>" +
                                "<div class='progress-bar " + ((data.value_progress === '100%') ? 'bg-success' : 'bg-warning') + "' " +
                                "data-width='" + data.value_progress + "' style='width:" + data.value_progress + " ' >" +data.value_progress
                                "</div>" +
                                "</div>";
                            return a;
                        }
                    },
                    {data: 'score', name: 'score'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return '<a href="' + data.score_url + '" class="btn btn-primary" role="button" aria-pressed="true">Beri Nilai</a>';
                        }
                    },
                ],
            });
        });

    </script>
@endsection

