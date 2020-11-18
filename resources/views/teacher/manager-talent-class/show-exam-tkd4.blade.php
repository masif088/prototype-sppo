@extends('layouts.admin-master')

@section('title')
    Manager Talent Class - TKD 4
@endsection

@section('content')
        <div class="form-group row mb-4">

            <label class="col-form-label text-center col-12 col-md-12 col-lg-12">
                <h2>
                    {!! $quest->quest !!}
                </h2>
            </label>
        </div>
<a href="{{route('teacher.manager-talent-class.exam-tkd4-show', [$id, $number+1])}}" class="btn btn-primary col-md-12"> berhasil</a>
<a href="{{route('teacher.manager-talent-class.exam-tkd4-store',[$id, $number])}}" class="btn btn-danger col-md-12"> gagal</a>

@endsection

@section('scripts')

@endsection
