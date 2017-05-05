<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Member;
use Session;
use Carbon;

class TaskController extends Controller
{
    /**
    * GET /
    */

    public function index() {
        $currentTasks = Task::where('completed', '=', false)->
            orderBy('due_date')->get();

        return view('tasks.index')->with([
            'currentTasks' => $currentTasks
        ]);
    }

    /**
    * GET /completed
    * Displays all completed tasks
    */

    public function completed() {
        $completedTasks = Task::where('completed', '=', true)->
            orderBy('completed_date', 'desc')->get();

        return view('tasks.completed')->with([
            'completedTasks' => $completedTasks
        ]);
    }

    /**
    * GET /new
    * Displays form to add a new task
    */

    public function new() {

        $membersForCheckboxes = Member::getMembersForCheckboxes();

        return view('tasks.new')->with([
            'membersForCheckboxes' => $membersForCheckboxes
        ]);
    }

    /**
    * POST /saveNew
    * Processes form to add a new task
    */

    public function saveNew(Request $request) {

        $this->validate($request, [
            'task' => 'required',
            'due_date' => 'nullable|date|after_or_equal:today'
        ]);

        $task = new Task();
        $task->task = $request->task;

        if(is_null($request->due_date)) {
            $task->due_date = null;
        } else {
            $task->due_date = Carbon\Carbon::parse($request->due_date)->toDateString();
        }

        $task->completed = false;
        $task->save();

        $members = ($request->members) ?: [];
        $task->members()->sync($members);
        $task->save();

        Session::flash('message', 'The task "'.$task->task.'" has been added.');

        return redirect('/');
    }

    /**
    * GET /edit/{id}
    * Displays form to edit a task
    */

    public function edit($id) {

        $task = Task::with('members')->find($id);

        if(is_null($task)) {
            Session::flash('message', 'Task does not exist!');
            return redirect('/');
        }

        $membersForCheckboxes = Member::getMembersForCheckboxes();

        $membersForThisTask = [];
        foreach ($task->members as $member) {
            $membersForThisTask[] = $member->first_name.' '.$member->last_name;
        }

        return view('tasks.edit')->with([
            'id' => $id,
            'task' => $task,
            'membersForCheckboxes' => $membersForCheckboxes,
            'membersForThisTask' => $membersForThisTask,
        ]);
    }

    /**
    * POST /saveEdits
    * Processes form to edit a task
    */

    public function saveEdits(Request $request) {

        $this->validate($request, [
            'task' => 'required',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::find($request->id);
        $task->task = $request->task;

        if(is_null($request->due_date)) {
            $task->due_date = null;
        } else {
            $task->due_date = Carbon\Carbon::parse($request->due_date)->toDateString();
        }

        $members = ($request->members) ?: [];
        $task->members()->sync($members);

        $task->save();

        Session::flash('message', 'The task "'.$task->task.'" has been updated.');

        return redirect('/');
    }

    /**
    * GET /delete/{id}
    * Displays form to delete a task
    */

    public function delete($id) {

        $task = Task::find($id);

        if(is_null($task)) {
            Session::flash('message', 'Task does not exist!');
            return redirect('/');
        }

        return view('tasks.delete')->with([
            'id' => $id,
            'task' => $task
        ]);
    }

    /**
    * POST /saveDelete
    * Processes form to delete a task
    */

    public function saveDelete(Request $request) {

        $task = Task::find($request->id);

        $task->members()->detach();

        $task->delete();

        Session::flash('message', 'The task "'.$task->task.'" has been deleted.');

        return redirect('/');
    }

    /**
    * POST /complete
    * Marks task as complete and sets completed date
    */

    public function markComplete(Request $request) {

        $task = Task::find($request->id);
        $task->completed = true;
        $task->completed_date = Carbon\Carbon::now()->toDateString();
        $task->save();

        Session::flash('message', 'The task "'.$task->task.'" has been marked complete.');

        return redirect('/');
    }

    /**
    * POST /incomplete
    * Marks task as incomplete and removes completed date
    */

    public function markIncomplete(Request $request) {

        $task = Task::find($request->id);
        $task->completed = false;
        $task->completed_date = null;
        $task->save();

        Session::flash('message', 'The task "'.$task->task.'" has been marked incomplete.');

        return redirect('/');
    }
}
