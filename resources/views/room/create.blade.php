@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create room</div>

                    <div class="panel-body">
                        {{ Form::open(['url' => 'rooms', 'method' => 'post']) }}
                        {{ Form::hidden('olympiad', Auth::user()->activeOlympiad->id) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="room" class="col-md-4 control-label">Room ID</label>

                            <div class="col-md-6">
                                <input id="room" type="text" class="form-control" name="room" value="{{ old('room') }}" required autofocus>

                                @if ($errors->has('room'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('room') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
                            <label for="seats" class="col-md-4 control-label">Seats</label>

                            <div class="col-md-6">
                                <input id="seats" type="text" class="form-control" name="seats" value="{{ old('seats') }}" required>

                                @if ($errors->has('seats'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seats') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
