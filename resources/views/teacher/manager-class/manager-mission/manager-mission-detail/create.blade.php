@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}}</a> - <a href="{{route('teacher.manager-class.show-mission',[$title,$course,$mission->id])}}">Tugas {{$mission->title}}</a> - Tambah Soal
@endsection

@section('content')
    <form action="{{route('teacher.manager-class.store-mission-detail',[$title,$course,$id])}}" method="post" role="form">
        @csrf
{{--        <div class="form-group row mb-4">--}}
{{--            <label--}}
{{--                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul--}}
{{--                Soal<span style="color: red">*</span></label>--}}
{{--            <div class="col-sm-12 col-md-7">--}}
{{--                <input type="text" name="title" class="form-control" required>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mata
                Pelajaran<span style="color: red">*</span></label>
            <div class="col-sm-12 col-md-7">
                <select name="type" class="form-control" id="type_id" required>
                    <option value="1">Pilihan Ganda</option>
                    <option value="2">Jawaban Pendek</option>
                    <option value="3">Jawaban Panjang</option>

                </select>
            </div>
        </div>

        <div class='form-group row mb-4'><label
                class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Soal<span
                    style='color: red'>*</span></label>
            <div class='col-sm-12 col-md-7'><textarea class='summernote' name='quest'
                                                      required></textarea></div>
        </div>
        <div id="form-1">
            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    A<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='a'></textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    B<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='b'></textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    C</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='c'></textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    D</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='d'></textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    E</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='e'></textarea>
                </div>
            </div>


            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    Benar<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <select name='correct_answer' class='form-control' id='correct_answer'
                    >
                        <option value='1'>Jawaban A</option>
                        <option value='2'>Jawaban B</option>
                        <option value='3'>Jawaban C</option>
                        <option value='4'>Jawaban D</option>
                        <option value='5'>Jawaban E</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <input type="submit" value="Tambah" name="add"
                       class="float-right btn btn-primary">
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script>
        $(function () {
            // $('#form-1').hide();
            $('#type_id').change(function () {
                if (this.value == 1) {
                    $('#form-1').show();
                } else {
                    $('#form-1').hide();
                }
            })
        });
    </script>
@endsection




{{--@extends('layouts.admin-master')--}}

{{--@section('title')--}}
{{--    Dashboard--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    <section class="section">--}}
{{--        <div class="section-header">--}}
{{--            <h1>Membuat Soal</h1>--}}
{{--        </div>--}}

{{--        <div class="section-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                        </div>--}}
{{--                        <div class="card-body p-0">--}}
{{--                            <div class="">--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--@endsection--}}
{{--@section('scripts')--}}

{{--@endsection--}}
