@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.student.create')</div>
                    <div class="panel-body">
                        @if(Auth::user()->activeOlympiad)
                            @include('snippets.errors')
                            {{ Form::open(['route' => 'students.store', 'method' => 'post', 'class' => '']) }}
                            <div class="form-group">
                                {{ Form::label('name', trans('labels.student.name'), ['class' => 'control-label']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('surname', trans('labels.student.surname'), ['class' => 'control-label']) }}
                                {{ Form::text('surname', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('school', trans('labels.student.school'), ['class' => 'control-label']) }}
                                {{ Form::select('school', \App\School::orderBy('name')->pluck('name', 'id'), null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('grade', trans('labels.student.grade'), ['class' => 'control-label']) }}
                                {{ Form::select('grade', ['6' => trans('labels.student.grades.6'), '5' => trans('labels.student.grades.5'), '4' => trans('labels.student.grades.4'), '3' => trans('labels.student.grades.3')], null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('olympiad_id', trans('labels.student.olympiad'), ['class' => 'control-label']) }}
                                @if(Auth::user()->activeOlympiad)
                                    {{ Form::select('olympiad_id', \App\Olympiad::orderBy('date')->pluck('name', 'id'),  Auth::user()->activeOlympiad, ['class' => 'form-control']) }}
                                @else
                                    {{ Form::select('olympiad_id', \App\Olympiad::orderBy('date')->pluck('name', 'id'),  null, ['class' => 'form-control', 'placeholder' => trans('labels.olympiad.select_olympiad')]) }}
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::submit(trans('labels.add'), ['class' => 'btn btn-primary']) }}
                            </div>
                            {{ Form::close() }}
                        @else
                            <div class=""><a href="{{ route('olympiads.index') }}">@lang('labels.olympiad.select_olympiad')</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
