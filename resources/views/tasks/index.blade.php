@extends('layouts.master')

@section('content')

    <h3>Current Tasks</h3>

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
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>
                        @if (is_null($task->due_date))
                            {{ $task->due_date }}
                        @else
                            {{ Carbon\Carbon::parse($task->due_date)->toFormattedDateString() }}
                        @endif
                    </td>
                    <td>{{ $task->person }}</td>
                    <td>
                        <form method="POST" action="/complete">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $task->id }}">
                            <button class="btn btn-default" type="submit">Mark Complete</button>
                        </form>
                        <a class="btn btn-default" href="/edit/{{ $task->id }}">Edit</a>
                        <a class="btn btn-default" href="/delete/{{ $task->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

@endsection
