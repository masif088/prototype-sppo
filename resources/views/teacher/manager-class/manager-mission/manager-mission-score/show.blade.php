@extends('layouts.admin-master')

@section('title')
        <a href="{{route('teacher.manager-class.index',[$title,$course])}}">
            Manajemen Kelas - {{$title}} - Mapel - {{$course}}
        </a> -
        <a href="{{route('teacher.manager-class.index-mission-score',[$title,$course,$id])}}">
            {{$missions->title}}
        </a> -
        Beri Nilai - {{$user->name}}

@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <form
                                action="{{route('teacher.manager-class.store-mission-score',[$title, $course,$id,$userid])}}"
                                method="post" role="form">
                                @csrf
                                <div class="form-group row mb-4">
                                    <h6 class="text-md-left col-12 col-md-6 col-lg-6">Soal</h6>
                                    <h6 class="col-sm-12 col-md-6">Jawaban</h6>
                                </div>

                                @foreach($mission as $md)

                                    <div class="form-group row mb-4">
                                        <h6 class="text-md-left col-12 col-md-4 col-lg-4">{!! $md->quest !!}</h6>
                                        @if($md->type==1)
                                            @php($pg++)
                                            @if(count($md->missionSubmits))
                                            @if($md->missionSubmits[0]->answer==$md->answers)
                                                @php($pgr++)
                                            @endif
                                            @endif
                                            <h6 class="text-md-left col-12 col-md-2 col-lg-2">PG</h6>
                                            <h6 class="col-sm-12 col-md-6"

                                                style="color: @if(count($md->missionSubmits)) {{($md->missionSubmits[0]->answer==$md->answers)?'green':'red'}} @endif" >
                                                @if(count($md->missionSubmits))
                                                {{($md->missionSubmits[0]->answer==$md->answers)?"Benar":"Salah"}}
                                                @endif
                                            </h6>
                                        @else
                                            <h6 class="text-md-left col-12 col-md-2 col-lg-2">Essay</h6>
                                            @if(count($md->missionSubmits))
                                            <h6 class="col-sm-12 col-md-6">{!! $md->missionSubmits[0]->answer !!}</h6>
                                            @endif
                                        @endif
                                    </div>

                                @endforeach
                                <div class="row">
                                    <h5 class="col-12 col-md-3 col-lg-3">Total Soal</h5>
                                    <div class="col-sm-12 col-md-9">
                                        <h5>: {{$count}}</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="col-12 col-md-3 col-lg-3">Soal Jawaban Tertulis</h5>
                                    <div class="col-sm-12 col-md-9">
                                        <h5>: {{$count-$pg}}</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="col-12 col-md-3 col-lg-3">Soal Pilihan Ganda</h5>
                                    <div class="col-sm-12 col-md-9">
                                        <h5>: benar : {{$pgr}} dari : {{$pg}}</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="col-12 col-md-3 col-lg-3">Nilai</h5>
                                    <div class="col-sm-12 col-md-5">
                                        <input type="number" name="score" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" value="add" name="add"
                                                class="float-right btn btn-primary">Tambah
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
