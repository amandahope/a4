@extends('layouts.master')

@section('content')

    <h3>Delete Task</h3>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Task</th>
                <th>Date Due</th>
                <th>Delegated To</th>
            </tr>
        </thead>

        <tbody>
                <tr>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <ul>
                            @foreach ($task->members as $member)
                                <li>{{ $member->first_name }} {{ $member->last_name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
        </tbody>

    </table>

    <p>Are you sure you want to delete this task?</p>

    <form method="POST" action="/delete">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $task->id }}">

        <input type="submit" value="Delete Task">

    </form>

@endsection
