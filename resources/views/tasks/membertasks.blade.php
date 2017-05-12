@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h2>Current Tasks for {{ $member->first_name }} {{ $member->last_name }}
            <small><a href="/{{ $member->id }}/completed">(Show Completed)</a></small>
        </h2>
    </div>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Task</th>
                <th>Date Due</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            @if (count($memberTasks) == 0)
                <tr>
                    <td colspan="3" class="text-center"><em>No tasks.</em></td>
                </tr>
            @else
                @foreach ($memberTasks as $task)
                    <tr
                        @if (!is_null($task->due_date))
                            @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($task->due_date)))
                                class="bg-danger"
                            @endif
                        @endif
                    >
                        <td>{{ $task->task }}</td>
                        <td>
                            @if (!is_null($task->due_date))
                                {{ Carbon\Carbon::parse($task->due_date)->toFormattedDateString() }}
                                @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($task->due_date)))
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Alert:Overdue</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="/complete">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <button class="btn btn-default" type="submit">Mark Complete</button>
                                <a class="btn btn-default" href="/edit/{{ $task->id }}">Edit</a>
                                <a class="btn btn-default" href="/delete/{{ $task->id }}">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>

@endsection
