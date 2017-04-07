@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.room.list')</div>

                    <div class="panel-body">
                        @if(session('active.olimp'))
                            <table class="table-striped col-md-12">
                                <tr>
                                    <th>ID</th>
                                    <th>Seats</th>
                                    <th></th>
                                </tr>
                                @forelse($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->seats }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ url('/rooms/'.$olympiad->id.'/edit') }}">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">@lang('labels.olympiads.empty')</td></tr>
                                @endforelse
                            </table>
                        @else
                            Select an olympiad.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
