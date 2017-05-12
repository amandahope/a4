@extends('layouts.master')

@section('content')

    <h2>Edit Team Member</h2>

    <form method="POST" action="/team/edit">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $member->id }}">

        <div class="form-group">
            <label for="fname">First Name (required):</label>
            <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname', $member->first_name) }}">
        </div>

        <div class="form-group">
            <label for="lname">Last Name (required):</label>
            <input type="text" name="lname" id="lname" class="form-control" value=" {{ old('lname', $member->last_name) }}">
        </div>

        <button class="btn btn-default" type="submit">Update Team Member</button>

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
