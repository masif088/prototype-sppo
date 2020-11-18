@extends('layouts.admin-master')

@section('title')
    Manajemen Siswa
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-student.create')}}">Tambah Siswa</a>
                            <a class="btn btn-primary" href="{{route('admin.manager-student.downloadTemplateExcel')}}">Download Template excel</a>
                            <form style="display: inline-block" method="post" action="{{route('admin.manager-student-importStudent')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="submit" value="Import Siswa" class="btn btn-primary" style="display: inline">
                                <input type="file" id="customFile" name="file" required>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
{{--                                        <th>Kelas</th>--}}
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
                ajax: '{!! route("admin.manager-student.data") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Info Siswa</a>';
                            return '<span>' + edit_button + show_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
