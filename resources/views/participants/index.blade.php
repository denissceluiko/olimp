@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.participant.list')</div>
                    <div class="panel-body">
                        <table class="table table-striped col-md-12">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('labels.olympiad.name')</th>
                                    <th>@lang('labels.olympiad.date')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($olympiads as $olympiad)
                                    <tr>
                                        <td>{{ $olympiad->id }}</td>
                                        <td>{{ $olympiad->name }}</td>
                                        <td>{{ $olympiad->date->toDateString() }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ route('olympiads.edit', $olympiad->id) }}">@lang('labels.edit')</a>
                                            <a class="btn btn-primary" href="{{ route('olympiads.select', $olympiad->id) }}">@lang('labels.use')</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">@lang('labels.olympiad.empty')</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection