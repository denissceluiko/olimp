@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.user.list')</div>
                    <div class="panel-body">
                        <table class="table table-striped col-md-12">
                            <thead>
                            <tr>
                                <th>@lang('labels.user.name')</th>
                                <th>@lang('labels.user.surname')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-default" href="{{ route('users.edit', $user->id) }}">@lang('labels.edit')</a>
                                        {{ Form::open(['method' => 'delete', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline-block;' ]) }}
                                        {{ Form::submit(trans('labels.delete'), ['class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3">@lang('labels.school.empty')</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection