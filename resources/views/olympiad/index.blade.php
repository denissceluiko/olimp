@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.olympiad.list')</div>

                    <div class="panel-body">
                        <table class="table-striped col-md-12">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            @forelse($olympiads as $olympiad)
                                <tr>
                                    <td>{{ $olympiad->id }}</td>
                                    <td>{{ $olympiad->name }}</td>
                                    <td>{{ $olympiad->date }}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{ url('/olympiads/'.$olympiad->id.'/edit') }}">Edit</a>
                                        <a class="btn btn-primary" href="{{ url('/olympiads/'.$olympiad->id.'/select') }}">Use</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3">@lang('labels.olympiads.empty')</td></tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
