@extends('layouts.master')

@section('content')

    <h2>Add a New Task</h2>

    <form method="POST" action="/new">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="task">Task (required):</label>
            <input type="text" name="task" id="task" class="form-control" value="{{ old('task') }}">
        </div>

        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="text" name="due_date" id="due_date" class="form-control" value=" {{ old('due_date') }}">
        </div>

        <div class="form-group">
            <fieldset>
                <legend>Delegate To:</legend>
                @foreach($membersForCheckboxes as $id => $name)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="members[]" id="members" value="{{ $id }}">
                            {{ $name }}
                        </label>
                    </div>
                @endforeach
            </fieldset>
        </div>

        <button class="btn btn-default" type="submit">Add Task</button>

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
