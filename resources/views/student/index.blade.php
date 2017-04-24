@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('labels.student.list')</div>
                    <div class="panel-body">
                        <table class="table table-striped col-md-12">
                            <thead>
                                <tr>
                                    <th>@lang('labels.student.name')</th>
                                    <th>@lang('labels.student.surname')</th>
                                    <th>@lang('labels.school.name')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->surname }}</td>
                                        <td>{{ $student->school->name }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-default" href="{{ route('students.edit', $student->id) }}">@lang('labels.edit')</a>
                                            {{ Form::open(['method' => 'delete', 'route' => ['schools.destroy', $student->id], 'style' => 'display:inline-block;' ]) }}
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