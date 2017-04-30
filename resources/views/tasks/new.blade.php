@extends('layouts.master')

@section('content')

    <h3>Add a New Task</h3>

    <form method="POST" action="/new">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="task">Task*</label>
            <input type="text" name="task" id="task" value="{{ old('task') }}">
        </div>

        <div class="form-group">
            <label for="due_date">Date Due</label>
            <input type="text" name="due_date" id="due_date" value=" {{ old('due_date') }}">
        </div>

        <div class="form-group">
            <label for="person">Delegate</label>
            <input type="text" name="person" id="person" value=" {{ old('person') }}">
        </div>

        <input type="submit" value="Add Task">

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
