@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.student.create')</div>
                    <div class="panel-body">
                        @if(count($errors))
                            <div class="panel">
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
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
                            {{ Form::select('school', \App\School::pluck('name', 'id'), null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('grade', trans('labels.student.grade'), ['class' => 'control-label']) }}
                            {{ Form::select('grade', ['6' => trans('labels.student.grades.6'), '5' => trans('labels.student.grades.5'), '4' => trans('labels.student.grades.4'), '3' => trans('labels.student.grades.3')], null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit(trans('labels.add'), ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
