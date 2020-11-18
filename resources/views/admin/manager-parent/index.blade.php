@extends('layouts.admin-master')

@section('title')
    Manajemen Orang Tua
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <a class="btn btn-primary" href="{{route('admin.manager-parent.create')}}">Tambah Orang Tua</a>
                            <a class="btn btn-primary" href="{{route('admin.manager-parent.downloadTemplateExcel')}}">Download Template excel</a>
                            <form style="display: inline-block" method="post" action="{{route('admin.manager-parent-importParent')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="submit" value="Import Orang Tua" class="btn btn-primary" style="display: inline">
                                <input type="file" id="customFile" name="file" required>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th>Nama Orang Tua</th>
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
                ajax: '{!! route("admin.manager-parent.data") !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const edit_button = '<a href="' + data.edit_url + '" class="btn btn-primary" role="button" aria-pressed="true">Ubah</a>';
                            // const show_button = '<a href="' + data.show_url + '" class="btn btn-primary" role="button" aria-pressed="true">Info Orang Tua</a>';
                            return '<span>' + edit_button + show_button + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection
