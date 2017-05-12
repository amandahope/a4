@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h2>My Team</h2>
    </div>

    <a class="btn btn-default" href="team/new">Add A Team Member</a>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Tasks</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($teamMembers as $member)
                <tr>
                    <td>{{ $member->last_name }}</td>
                    <td>{{ $member->first_name }}</td>
                    <td><a href="/{{ $member->id }}">{{ $member->tasks->where('completed', false)->count() }}</a></td>
                    <td>
                        <a class="btn btn-default" href="team/edit/{{ $member->id }}">Edit</a>
                        <a class="btn btn-default" href="team/delete/{{ $member->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
