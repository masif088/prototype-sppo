@extends('layouts.admin-master')

@section('title')
    <a href="{{route('student.manager-class',[$title])}}">{{Auth::user()->studentInfos[0]->ManagerClass->title}} - {{$title}}</a> - {{$mission->missionDetail->mission->title}} - no {{$mission->number}}
@endsection

@section('content')

    <div class="row">
        <div class="m-5 container col-md-7">

            @if($errors->any())
                <div class="alert alert-success border border-success" role="alert">
                    {{$errors->first()}}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    {!! $mission->missionDetail->quest !!}
                </div>
            </div>
            <form action="{{route('student.manager-class.store-detail-mission',[$title,$id,$mission->number])}}" method="post" class="clearfix">
                @csrf
                @if($mission->missionDetail->type==1)
                    @if($mission->missionDetail->a!=null)
                        <label class="form-control text-left " style="height: 100%">
                            <div class="row">
                                <div class="col-md-1">
                                    <input type="radio" name="answer" value="1" class="">
                                </div>
                                <div class="col-md-11">
                                    {!! $mission->missionDetail->a !!}
                                </div>
                            </div>
                        </label>
                    @endif
                        @if($mission->missionDetail->b!=null)
                            <label class="form-control text-left " style="height: 100%">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="radio" name="answer" value="1" class="">
                                    </div>
                                    <div class="col-md-11">
                                        {!! $mission->missionDetail->b !!}
                                    </div>
                                </div>
                            </label>
                        @endif
                        @if($mission->missionDetail->c!=null)
                            <label class="form-control text-left " style="height: 100%">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="radio" name="answer" value="1" class="">
                                    </div>
                                    <div class="col-md-11">
                                        {!! $mission->missionDetail->c !!}
                                    </div>
                                </div>
                            </label>
                        @endif
                        @if($mission->missionDetail->d!=null)
                            <label class="form-control text-left " style="height: 100%">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="radio" name="answer" value="1" class="">
                                    </div>
                                    <div class="col-md-11">
                                        {!! $mission->missionDetail->d !!}
                                    </div>
                                </div>
                            </label>
                        @endif
                        @if($mission->missionDetail->e!=null)
                            <label class="form-control text-left " style="height: 100%">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="radio" name="answer" value="1" class="">
                                    </div>
                                    <div class="col-md-11">
                                        {!! $mission->missionDetail->e !!}
                                    </div>
                                </div>
                            </label>
                        @endif
                @elseif($mission->missionDetail->type==2)
                    <textarea name="answer" class="form-control">
                    {{$mission->answer}}
                </textarea>
                @elseif($mission->missionDetail->type==3)
                    <textarea name="answer" class="form-control summernote">
                    {!! $mission->answer !!}
                </textarea>
                @endif
                <div class="row">
                    @if($mission->number!=1)
                        <a href="{{route('student.manager-class.show-detail-mission',[$title,$id,$mission->number-1])}}" class="btn btn-success">Kembali</a>
                    @endif
                    @if(count($allMission)!=$mission->number)
                        <a href="{{route('student.manager-class.show-detail-mission',[$title,$id,$mission->number+1])}}" class="btn btn-success">Lewati</a>
                    @endif
                    <a href="{{route('student.manager-class',[$title])}}" class="btn btn-danger">Selesai dan kembali</a>

                        <input type="submit" class="btn btn-success float-right" value="Simpan dan lanjut">
                </div>


            </form>


        </div>
        <div class="col-md-2 m-3 mt-5">
            <div class="row">
                @foreach($allMission as $aq)
                    <a href="{{route('student.manager-class.show-detail-mission',[$title,$id,$aq->number])}}" class="btn {{($aq->answer!=null)?'btn-success':'border-dark'}}">{{$aq->number}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
