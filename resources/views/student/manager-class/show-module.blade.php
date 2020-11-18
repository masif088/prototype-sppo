@extends('layouts.admin-master')
@section('title')
    <a href="{{route('student.manager-class',[$title])}}">{{Auth::user()->studentInfos[0]->ManagerClass->title}} - {{$title}}</a>  - {{$modules->title}}
@endsection
@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
    <h2>{{$modules->title}}</h2>
    <h6>Dibuat : {{$modules->user->name}} - {{date('d M Y', strtotime($modules->created_at))}}</h6>
    {!! $modules->contents !!}
    <p>watermark : {{$modules->watermark}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

