@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.room.import')</div>
                    <div class="panel-body">
                        @include('snippets.errors')
                        {{ Form::open(['route' => 'rooms.import', 'method' => 'post', 'files' => 'true']) }}
                        <div class="form-group">
                            {{ Form::label('olympiad', trans('labels.olympiad.select_olympiad'), ['class' => 'control-label']) }}
                            @if(Auth::user()->activeOlympiad)
                                {{ Form::select('olympiad', \App\Olympiad::orderBy('date')->pluck('name', 'id'),  Auth::user()->activeOlympiad, ['class' => 'form-control']) }}
                            @else
                                {{ Form::select('olympiad', \App\Olympiad::orderBy('date')->pluck('name', 'id'),  null, ['class' => 'form-control', 'placeholder' => trans('labels.olympiad.select_olympiad')]) }}
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('room_list', trans('labels.room.file'), ['class' => 'control-label']) }}
                            {{ Form::file('room_list', ['class' => 'form-control', 'accept' => 'text/csv']) }}
                        </div>
                        {{ Form::submit(trans('labels.submit'), ['class' => 'form-control btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
