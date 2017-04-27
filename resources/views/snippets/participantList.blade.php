<table class="table table-striped col-md-12" id="student-table">
    <thead>
    <tr>
        <th>@lang('labels.student.name')</th>
        <th>@lang('labels.student.surname')</th>
        <th>@lang('labels.school.name')</th>
        <th>@lang('labels.room.room_id')</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->surname }}</td>
            <td>{{ $student->school->name }}</td>
            <td>{{ $student->pivot->room ? $student->pivot->room->room : ""}}</td>
            <td class="text-right">
                <div class="btn-group">
                    <button type="button" data-id="{{ $student->id }}" class="btn btn-info assign-button">@lang('labels.participant.assign')</button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">@lang('labels.toggle_nav')</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('students.edit', $student->id) }}">@lang('labels.edit')</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#" data-id="{{ $student->id }}" class="delete-button">@lang('labels.remove')</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @empty
        <tr><td colspan="3">@lang('labels.search.no_results')</td></tr>
    @endforelse
    </tbody>
</table>