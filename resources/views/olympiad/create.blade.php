@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.olympiad.create')</div>
                    <div class="panel-body">
                        @include('snippets.errors')
                        {{ Form::open(['route' => 'olympiads.store', 'method' => 'post']) }}
                            <div class="form-group">
                                {{ Form::label('name', trans('labels.olympiad.name'), ['class' => 'control-label']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('date', trans('labels.olympiad.date'), ['class' => 'control-label']) }}
                                {{ Form::text('date', null, ['class' => 'form-control', 'required', 'placeholder' => 'YYYY-MM-DD']) }}
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
