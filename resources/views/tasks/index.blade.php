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
            @foreach ($currentTasks as $task)
                <tr
                    @if (!is_null($task->due_date))
                        @if (Carbon\Carbon::now()->gt(Carbon\Carbon::parse($task->due_date)))
                            class="bg-danger"
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
        </tbody>

    </table>

@endsection
