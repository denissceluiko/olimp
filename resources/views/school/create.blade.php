@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.school.import')</div>
                    <div class="panel-body">
                        @include('snippets.errors')
                        {{ Form::open(['route' => 'schools.import', 'method' => 'post', 'files' => 'true']) }}
                        <div class="form-group">
                            {{ Form::label('school_list', trans('labels.school.file'), ['class' => 'control-label']) }}
                            {{ Form::file('school_list', ['class' => 'form-control', 'accept' => 'text/csv']) }}
                        </div>
                        {{ Form::submit(trans('labels.submit'), ['class' => 'form-control btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
