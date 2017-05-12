@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h2>Current Tasks
            <small><a href="/completed">(Show Completed)</a></small>
        </h2>
    </div>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Task</th>
                <th>Date Due</th>
                <th>Delegated To</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            @if (count($currentTasks) == 0)
                <tr>
                    <td colspan="4" class="text-center">
                        <em>No tasks. Would you like to <a href="/new">add one</a>?</em>
                    </td>
                </tr>
            @else
                @foreach ($currentTasks as $task)
                    <tr
                        @if (!is_null($task->due_date))
                            @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($task->due_date)))
                                class="danger"
                            @endif
                        @endif
                    >
                        <td>
                            {{ $task->task }}
                            @if(Session::get('new') == $task->task)
                                <span class="label label-success">New</span>
                            @endif
                            @if (Session::get('updated') == $task->task)
                                <span class="label label-success">Updated</span>
                            @endif
                        </td>
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
                            <ul class="list-unstyled">
                                @foreach ($task->members as $member)
                                    <li>{{ $member->first_name }} {{ $member->last_name }}</li>
                                @endforeach
                            </ul>
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
