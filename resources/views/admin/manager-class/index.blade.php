@extends('layouts.admin-master')

@section('title')
    Manajemen Kelas
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-class.create')}}">Tambah Kelas</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Kelas</th>

                                        <th>Tahun Akademi</th>
                                        <th>Wali Kelas</th>
                                        <th>Status</th>
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
                ajax: '{!! route("admin.manager-class.data") !!}',
                columns: [
                    {data: 'title', name: 'title'},

                    {data: 'year', name: 'year'},
                    {data: 'user.name', name: 'user.name'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            let status;
                            if (data.status == 1) {
                                status = "Aktif"
                            } else {
                                status = "Tidak Aktif"
                            }
                            return status
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                                {{--const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';--}}
                            const show_student = '<a href="' + data.show_student_url + '" class="btn btn-primary" role="button" aria-pressed="true">Data Murid</a>';
                            const show_course = '<a href="' + data.show_course_url + '" class="btn btn-primary" role="button" aria-pressed="true">Data Mata Pelajaran</a>';
                            return '<span>' + edit_button + show_course + show_student + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
