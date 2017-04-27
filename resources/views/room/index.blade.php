@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.room.list')</div>
                    <div class="panel-body">
                        @if(Auth::user()->activeOlympiad)
                            <div class="panel">
                                {{ Form::open(['route' => 'rooms.store', 'method' => 'post', 'class' => 'form-inline']) }}
                                {{ Form::hidden('olympiad', Auth::user()->activeOlympiad->id) }}
                                <div class="form-group">
                                    {{ Form::label('room', trans('labels.room.room_id'), ['class' => 'control-label']) }}
                                    {{ Form::text('room', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('seats', trans('labels.room.seats'), ['class' => 'control-label']) }}
                                    {{ Form::text('seats', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::submit(trans('labels.add'), ['class' => 'btn btn-primary']) }}
                                </div>
                                {{ Form::close() }}
                            </div>
                            <table class="table table-striped col-md-12">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.room.room')</th>
                                        <th>@lang('labels.room.seats')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->activeOlympiad->rooms()->orderBy('room')->get() as $room)
                                        <tr>
                                            <td>{{ $room->room }}</td>
                                            <td>{{ $room->seats }}</td>
                                            <td class="text-right">
                                                <a class="btn btn-default" href="{{ route('rooms.edit', Auth::user()->activeOlympiad->id) }}">@lang('labels.edit')</a>
                                                {{ Form::open(['method' => 'delete', 'route' => ['rooms.destroy', $room->id], 'style' => 'display:inline-block;' ]) }}
                                                {{ Form::submit(trans('labels.delete'), ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3">@lang('labels.room.empty')</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <div class=""><a href="{{ route('olympiads.index') }}">@lang('labels.olympiad.select_olympiad')</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
