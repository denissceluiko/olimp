@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.school.list')</div>
                    <div class="panel-body">
                        <div class="panel">
                            {{ Form::open(['route' => 'schools.store', 'method' => 'post', 'class' => 'form-inline']) }}
                            <div class="form-group">
                                {{ Form::label('name', trans('labels.school.name'), ['class' => 'control-label']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit(trans('labels.add'), ['class' => 'form-control btn btn-primary']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                        <table class="table table-striped col-md-12">
                            <thead>
                                <tr>
                                    <th>@lang('labels.school.name')</th>
                                    <th class="hidden-xs">@lang('labels.school.city')</th>
                                    <th class="hidden-xs">@lang('labels.school.language')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($schools as $school)
                                <tr>
                                    <td class="col-xs-9 col-md-5">{{ $school->name }}</td>
                                    <td class="col-md-2 hidden-xs">{{ $school->city }}</td>
                                    <td class="col-md-1 hidden-xs">{{ $school->language }}</td>
                                    <td class="col-xs-3 col-md-4 text-right">
                                        <a class="btn btn-default" href="{{ route('schools.edit', $school->id) }}">@lang('labels.edit')</a>
                                        {{ Form::open(['method' => 'delete', 'route' => ['schools.destroy', $school->id], 'style' => 'display:inline-block;', 'class' => 'hidden-xs']) }}
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
