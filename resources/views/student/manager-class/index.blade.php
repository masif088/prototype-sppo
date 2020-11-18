@extends('layouts.admin-master')
@section('title')
    {{Auth::user()->studentInfos[0]->ManagerClass->title}} - {{$title}}
@endsection

@section('content')
    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <h2>Module</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($modules as $module)
            <a href="{{route('student.manager-class.show-detail-module',[$title,$module->id])}}"
               class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 rounded  ">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <h3>{{$module->title}}</h3>
                        </div>
                        <div class="card-stats-title">
                            {{$module->short_description}}
                        </div>
                        <div class="card-stats-title">
                            dibuat : {{$module->user->name}} - {{date('d M Y', strtotime($module->created_at))}}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="section-body">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <h2>Tugas</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($missions as $mission)
            <a href="{{route('student.manager-class.show-mission',[$title,$mission->id])}}"
               class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            <h3>{{$mission->title}}</h3>
                        </div>
                        <div class="card-stats-title">
                            dimulai : {{$mission->start}}
                        </div>
                        <div class="card-stats-title">
                            terakhir :{{$mission->end}}
                        </div>
                        <div class="card-stats-title">
                            <div class="progress" data-height="4" data-toggle="tooltip"
                                 title="{{Helper::getMissionProgress($mission->id)}}%">
                                <div
                                    class="progress-bar {{Helper::getMissionProgress($mission->id)==100?'bg-success':'bg-warning'}}"
                                    data-width="{{Helper::getMissionProgress($mission->id)}}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
