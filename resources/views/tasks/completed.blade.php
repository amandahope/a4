@extends('layouts.master')

@section('content')

    <h3>Completed Tasks</h3>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Task</th>
                <th>Date Completed</th>
                <th>Completed By</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($completedTasks as $task)
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>
                        @if (is_null($task->completed_date))
                            {{ $task->completed_date }}
                        @else
                            {{ Carbon\Carbon::parse($task->completed_date)->toFormattedDateString() }}
                        @endif
                    </td>
                    <td>{{ $task->person }}</td>
                    <td>
                        <form method="POST" action="/incomplete">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <button class="btn btn-default" type="submit">Mark Incomplete</button>
                        </form>
                        <a class="btn btn-default" href="/edit/{{ $task->id }}">Edit</a>
                        <a class="btn btn-default" href="/delete/{{ $task->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

@endsection
