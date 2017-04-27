@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.user.create')</div>
                    <div class="panel-body">
                        @include('snippets.errors')
                        {{ Form::open(['route' => 'users.store', 'method' => 'post', 'class' => '']) }}
                        <div class="form-group">
                            {{ Form::label('name', trans('labels.user.name'), ['class' => 'control-label']) }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', trans('labels.user.password'), ['class' => 'control-label']) }}
                            {{ Form::text('password', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('labels.user.email'), ['class' => 'control-label']) }}
                            {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('role', trans('labels.user.role'), ['class' => 'control-label']) }}
                            {{ Form::select('role', \App\Role::all()->pluck('label', 'id'),  null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit(trans('labels.add'), ['class' => 'btn btn-primary form-control']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
