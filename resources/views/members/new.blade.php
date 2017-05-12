@extends('layouts.master')

@section('content')

    <h2>Add a New Team Member</h2>

    <form method="POST" action="/team/new">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="fname">First Name (required):</label>
            <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}">
        </div>

        <div class="form-group">
            <label for="lname">Last Name (required):</label>
            <input type="text" name="lname" id="lname" class="form-control" value=" {{ old('lname') }}">
        </div>

        <button class="btn btn-default" type="submit">Add Team Member</button>

    </form>

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection
