@extends('layouts.admin-master')

@section('title')
    Manager Talent Class - 9 Kecerdasan Anak
@endsection

@section('content')
    <form action="{{route('teacher.manager-talent-class.exam-ci-store',[$id,$number])}}" method="post" class="clearfix">
        @csrf
        <label class="form-control text-left " style="height: 100%">
            <div class="row">
                <div class="col-md-1">
                    <input type="radio" name="answer" value="{{$quest->v_a}}" class="" checked>
                </div>
                <div class="col-md-11">
                    {!! $quest->a !!}
                </div>
            </div>
        </label>
        <label class="form-control text-left " style="height: 100%">
            <div class="row">
                <div class="col-md-1">
                    <input type="radio" name="answer" value="{{$quest->v_b}}" class="">
                </div>
                <div class="col-md-11">
                    {!! $quest->b !!}
                </div>
            </div>
        </label>

        <label class="form-control text-left " style="height: 100%">
            <div class="row">
                <div class="col-md-1">
                    <input type="radio" name="answer" value="{{$quest->v_c}}" class="">
                </div>
                <div class="col-md-11">
                    {!! $quest->c !!}
                </div>
            </div>
        </label>

        <label class="form-control text-left " style="height: 100%">
            <div class="row">
                <div class="col-md-1">
                    <input type="radio" name="answer" value="{{$quest->v_d}}" class="">
                </div>
                <div class="col-md-11">
                    {!! $quest->d !!}
                </div>
            </div>
        </label>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button type="submit" value="add" name="add"
                        class="float-right btn btn-primary">Lanjut
                </button>
            </div>
        </div>
    </form>

    <div class="form-group row mb-4">

        <label class="col-form-label text-center col-6 col-md-6 col-lg-6">
            <h2>

            </h2>
        </label>
    </div>
    {{--    <a href="{{route('teacher.manager-talent-class.exam-tkd-show', [$id, $number+1])}}"--}}
    {{--       class="btn btn-primary col-md-12"> berhasil</a>--}}
    {{--    <a href="{{route('teacher.manager-talent-class.exam-tkd-store',[$id, $number])}}" class="btn btn-danger col-md-12">--}}
    {{--        gagal</a>--}}

@endsection

@section('scripts')

@endsection
