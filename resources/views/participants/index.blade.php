@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.participant.list')</div>
                    <div class="panel-body">
                        <div class="panel">
                            @if(Auth::user()->activeOlympiad)
                                {{ Form::open(['route' => 'participants.search', 'method' => 'post', 'class' => 'form-inline', 'id' => 'participant-search-form']) }}
                                <div class="form-group">
                                    {{ Form::label('query_str', trans('labels.search.query'), ['class' => 'control-label']) }}
                                    {{ Form::text('query_str', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit(trans('labels.search.find'), ['class' => 'form-control btn btn-primary']) }}
                                </div>
                                {{ Form::close() }}
                            @else
                                <div class=""><a href="{{ route('olympiads.index') }}">@lang('labels.olympiad.select_olympiad')</a>
                            @endif
                        </div>
                        @if(count($students))
                            @include('snippets.participantList')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection