@extends('layouts.admin-master')

@section('title')
    Manager Talent Class
@endsection

@section('content')
    <h4>Student Manager</h4>
    <a class="btn btn-primary" href="{{route('teacher.manager-talent-class.create')}}">Tambah Siswa</a>
    <div class="table-responsive">
        <table class="table table-striped" id="table">
            <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Umur</th>
                <th>Desa</th>
                {{--                <th>Kecamatan</th>--}}
                <th>Hasil TKD 1</th>
                <th>Hasil TKD 2</th>
                <th>Hasil TKD 3</th>
                <th>Hasil TKD 4</th>
                <th>Hasil 9 KA</th>
                <th>Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('teacher.manager-talent-class.data') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'age', name: 'age'},
                    {data: 'village', name: 'village'},
                    // {data: 'district', name: 'district'},
                    {data: 'tkd', name: 'tkd'},
                    {data: 'tkd_2', name: 'tkd_2'},
                    {data: 'tkd_3', name: 'tkd_3'},
                    {data: 'tkd_4', name: 'tkd_4'},
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            var smart = {
                                eksistensial: 0,
                                interpersonal: 0,
                                intrapersonal: 0,
                                kinestetik: 0,
                                linguistik: 0,
                                matematis: 0,
                                musikal: 0,
                                naturalis: 0,
                                ruang: 0
                            };
                            data.ic_answers.forEach(dataic => {
                                let v = 0;
                                switch (dataic.answer) {
                                    case 1:
                                        smart.eksistensial += 1;
                                        break;
                                    case 2:
                                        smart.interpersonal += 1;
                                        break;
                                    case 3:
                                        smart.intrapersonal += 1;
                                        break;
                                    case 4:
                                        smart.kinestetik += 1;
                                        break
                                    case 5:
                                        smart.linguistik += 1;
                                        break
                                    case 6:
                                        smart.matematis += 1;
                                        break
                                    case 7:
                                        smart.musikal += 1;
                                        break
                                    case 8:
                                        smart.naturalis += 1;
                                        break
                                    case 9:
                                        smart.ruang += 1;
                                        break
                                    // case 1:
                                    //     v = dataic.ic_quest.v_a;
                                    //     break;
                                    // case 2:
                                    //     v = dataic.ic_quest.v_b;
                                    //     break;
                                    // case 3:
                                    //     v = dataic.ic_quest.v_c;
                                    //     break;
                                    // case 4:
                                    //     v = dataic.ic_quest.v_d;
                                    //     break;
                                }

                            });
                            return 'eksistensial : ' + smart.eksistensial + '<br>' + 'interpersonal : ' + smart.interpersonal + '<br>' + 'intrapersonal : ' + smart.intrapersonal + '<br>' + 'kinestetik : ' + smart.kinestetik + '<br>' + 'linguistik : ' + smart.linguistik + '<br>' + 'matematis : ' + smart.matematis + '<br>' + 'musikal : ' + smart.musikal + '<br>' + 'naturalis : ' + smart.naturalis + '<br>' + 'ruang : ' + smart.ruang + '<br>';
                        }
                    },
                    // {data: 'tkd',name: 'tkd'},

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            const tkd = (data.tkd === 0) ? '<a href="' + data.start_tkd + '" class="btn btn-primary" role="button" aria-pressed="true">Mulai Tkd 1</a>' : '';
                            const tkd2 = (data.tkd_2 === 0) ? '<a href="' + data.start_tkd2 + '" class="btn btn-primary" role="button" aria-pressed="true">Mulai Tkd 2</a>' : '';
                            const tkd3 = (data.tkd_3 === 0) ? '<a href="' + data.start_tkd3 + '" class="btn btn-primary" role="button" aria-pressed="true">Mulai Tkd 3</a>' : '';
                            const tkd4 = (data.tkd_4 === 0) ? '<a href="' + data.start_tkd4 + '" class="btn btn-primary" role="button" aria-pressed="true">Mulai Tkd 4</a>' : '';
                            const ic = (data.ic_answers.length === 0) ? '<a href="' + data.start_ci + '" class="btn btn-primary" role="button" aria-pressed="true">Mulai 9 KA</a>' : '';
                            return '<span>' + tkd + tkd2 + tkd3 + tkd4 + ic + '<span>';
                        }
                    },
                ],
            });
        });
    </script>
@endsection

