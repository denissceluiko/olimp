@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.olympiad.edit')</div>
                    <div class="panel-body">
                        {{ Form::open(['route' => ['olympiads.update', $olympiad->id], 'method'=> 'put', 'class' => '']) }}
                            <div class="form-group">
                                {{ Form::label('name', trans('labels.olympiad.name'), ['control-label']) }}
                                {{ Form::text('name', $olympiad->name, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('date', trans('labels.olympiad.date'), ['control-label']) }}
                                {{ Form::text('date', $olympiad->date->toDateString(), ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit(trans('labels.save'), ['class' => 'form-control btn btn-primary']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
