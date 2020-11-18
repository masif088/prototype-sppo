@extends('layouts.admin-master')

@section('title')
    <a href="{{route('teacher.manager-class.index',[$title,$course])}}">Manajemen Kelas - {{$title}} - Mapel
        - {{$course}}</a> - <a href="{{route('teacher.manager-class.show-mission',[$title,$course,$mission->id])}}">Tugas {{$mission->title}}</a> - Ubah Soal {{$missionDetail->id}}
@endsection

@section('content')
    <form action="{{route('teacher.manager-class.update-mission-detail',[$title,$course,$id,$missionDetail->id])}}" method="post" role="form">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group row mb-4">
            <label
                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Mata
                Pelajaran<span style="color: red">*</span></label>
            <div class="col-sm-12 col-md-7">
                <select name="type" class="form-control" id="type_id" required>
                    <option value="1" {{$missionDetail->type==1?'selected':''}}>Pilihan Ganda</option>
                    <option value="2" {{$missionDetail->type==2?'selected':''}}>Jawaban Pendek</option>
                    <option value="3" {{$missionDetail->type==3?'selected':''}}>Jawaban Panjang</option>

                </select>
            </div>
        </div>

        <div class='form-group row mb-4'><label
                class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Soal<span
                    style='color: red'>*</span></label>
            <div class='col-sm-12 col-md-7'>
                <textarea class='summernote' name='quest' required>
                    {{$missionDetail->quest}}
                </textarea>
            </div>
        </div>
        <div id="form-1">
            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    A<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='a'>
                        {{$missionDetail->a}}
                    </textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    B<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='b'>
                        {{$missionDetail->b}}
                    </textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    C</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='c'>
                        {{$missionDetail->c}}
                    </textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    D</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='d'>
                        {{$missionDetail->d}}
                    </textarea>
                </div>
            </div>

            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    E</label>
                <div class='col-sm-12 col-md-7'>
                    <textarea class='summernote' name='e'>
                        {{$missionDetail->e}}
                    </textarea>
                </div>
            </div>


            <div class='form-group row mb-4'>
                <label
                    class='col-form-label text-md-right col-12 col-md-3 col-lg-3'>Jawaban
                    Benar<span style='color: red'>*</span></label>
                <div class='col-sm-12 col-md-7'>
                    <select name='answer' class='form-control' id='correct_answer'>
                        <option value='1' {{$missionDetail->answer==1?'selected':''}}>Jawaban A</option>
                        <option value='2' {{$missionDetail->answer==2?'selected':''}}>Jawaban B</option>
                        <option value='3' {{$missionDetail->answer==3?'selected':''}}>Jawaban C</option>
                        <option value='4' {{$missionDetail->answer==4?'selected':''}}>Jawaban D</option>
                        <option value='5' {{$missionDetail->answer==5?'selected':''}}>Jawaban E</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <input type="submit" value="Ubah" name="add"
                       class="float-right btn btn-primary">
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script>
        $(function () {

            @if($missionDetail->type!=1)
                $('#form-1').hide();
            @endif
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

