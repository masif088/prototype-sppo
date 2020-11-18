@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}} </a> - Rekap Nilai
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
                                        <th>Nama</th>
                                        @foreach($mission as $m)
                                            <th>{{$m->title}}</th>
                                        @endforeach
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
                paging: false,
                // pagingType: "full_numbers",
                buttons: [
                    {extend: 'excel', text: "Unduh Rekap Nilai", title: 'Rekap Nilai {{$course}} kelas {{$title}}'}],
                ajax: '{!! route('teacher.manager-class.data',[$title,$course]) !!}',
                columns: [
                    {data: 'name', name: 'name'},
                        @foreach($mission as $m)
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        {{--name:{{$m->id}}--}}
                        render: function (data) {
                            {{--if(data.{{$m->id}}){--}}
                                return (data[{{$m->id}}]) ? data[{{$m->id}}] : '-'
                            // }
                        }
                    },
                    @endforeach
                ],
            });

        });

    </script>
@endsection

