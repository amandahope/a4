@extends('layouts.master')

@section('content')

    <h2>Delete Team Member</h2>

    <table class="table table-hover">

        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Tasks</th>
            </tr>
        </thead>

        <tbody>
                <tr>
                    <td>{{ $member->last_name }}</td>
                    <td>{{ $member->first_name }}</td>
                    <td><a href="/{{ $member->id }}">{{ $member->tasks->where('completed', false)->count() }}</a></td>

                </tr>
        </tbody>

    </table>

    <p>Are you sure you want to delete this team member?</p>

    <form method="POST" action="/team/delete">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $member->id }}">

        <button class="btn btn-default" type="submit">Delete Team Member</button>

    </form>

@endsection
