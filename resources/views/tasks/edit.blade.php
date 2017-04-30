@extends('layouts.master')

@section('content')

    <h3>Edit Task</h3>

    <form method="POST" action="/edit">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $task->id }}">

        <div class="form-group">
            <label for="task">Task*</label>
            <input type="text" name="task" id="task" value="{{ old('task', $task->task) }}">
        </div>

        <div class="form-group">
            <label for="due_date">Date Due</label>
            <input type="text" name="due_date" id="due_date" value=" {{ old('due_date', $task->due_date) }}">
        </div>

        <div class="form-group">
            <label for="person">Delegate</label>
            <input type="text" name="person" id="person" value=" {{ old('person', $task->person) }}">
        </div>

        <input type="submit" value="Update Task">

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

@section('datepicker')

    <script>
        $( function() {
          $( "#due_date" ).datepicker();
        } );
    </script>

@endsection
