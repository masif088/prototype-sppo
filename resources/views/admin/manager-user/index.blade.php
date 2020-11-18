@extends('layouts.admin-master')

@section('title')
    Manajemen User
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-user.create')}}">Tambah User</a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aktor</th>
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
                ajax: '{!! route("admin.manager-user.data") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: null,
                        name: 'role',
                        render: function (data) {
                            let role;
                            if (data.role == 1) {
                                role = 'Super admin'
                            } else if (data.role == 2) {
                                role = 'Guru'
                            } else {
                                role = 'Siswa'
                            }
                            return role
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            const delete_button = '<form style="display:inline-block" action="' + data.delete_url + '" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>';
                            const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Tampilkan</a>';
                            if (data.id === {{Auth::user()->id}}) {
                                return '<span>' + edit_button + show_button + '<span>';
                            } else {
                                return '<span>' + delete_button + edit_button + show_button + '<span>';
                            }
                        }
                    },
                ],
            });
        });
    </script>
@endsection
