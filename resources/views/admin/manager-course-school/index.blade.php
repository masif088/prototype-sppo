@extends('layouts.admin-master')

@section('title')
    Manajemen Mapel Sekolah
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-course-school.create')}}">Tambah
                                Mata Pelajaran</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
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
                ajax: '{!! route("admin.manager-course-school.data") !!}',
                columns: [
                    {data: 'title', name: 'title'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            return '<span>' + edit_button + '<span>';

                        }
                    },
                ],
            });
        });
    </script>
@endsection
