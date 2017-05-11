@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h2>My Completed Tasks
            <small><a href="/mytasks">(Show Current)</a></small>
        </h2>
    </div>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Task</th>
                <th>Date Completed</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($myTasks as $task)
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>
                        @if (!is_null($task->completed_date))
                            {{ Carbon\Carbon::parse($task->completed_date)->toFormattedDateString() }}
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="/incomplete">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <button class="btn btn-default" type="submit">Mark Incomplete</button>
                            <a class="btn btn-default" href="/edit/{{ $task->id }}">Edit</a>
                            <a class="btn btn-default" href="/delete/{{ $task->id }}">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

@endsection
