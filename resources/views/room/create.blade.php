@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.room.create')</div>
                    <div class="panel-body">
                        {{ Form::open(['url' => 'rooms', 'method' => 'post']) }}
                        {{ Form::hidden('olympiad', Auth::user()->activeOlympiad->id) }}
                        <div class="form-group">
                            {{ Form::label('room', trans('labels.room.id'), ['class' => 'control-label']) }}
                            {{ Form::text('room'), null, ['class' => 'form-control', 'required'] }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('seats', trans('labels.room.seats'), ['class' => 'control-label']) }}
                            {{ Form::number('seats'), null, ['class' => 'form-control', 'required'] }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit(trans('labels.submit'), ['class' => 'form-control btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
