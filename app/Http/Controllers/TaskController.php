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

        $active = "index";

        return view('tasks.index')->with([
            'currentTasks' => $currentTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /completed
    * Displays all completed tasks
    */

    public function showCompleted() {
        $completedTasks = Task::where('completed', '=', true)->
            orderBy('completed_date', 'desc')->get();

        $active = "index";

        return view('tasks.completed')->with([
            'completedTasks' => $completedTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /mytasks
    * Displays all non-delegated current tasks
    */

    public function showMyTasks() {
        $tasks = Task::with('members')->where('completed', '=', false)->
            orderBy('due_date')->get();

        $myTasks = [];

        foreach ($tasks as $task) {
            if (empty($task->members->all())) {
                $myTasks[] = $task;
            }
        }

        $active = "my";

        return view('tasks.mytasks')->with([
            'myTasks' => $myTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /mytasks/completed
    * Displays all non-delegated completed tasks
    */

    public function showMyCompleted() {
        $tasks = Task::with('members')->where('completed', '=', true)->
            orderBy('completed_date', 'desc')->get();

        $myTasks = [];

        foreach ($tasks as $task) {
            if (empty($task->members->all())) {
                $myTasks[] = $task;
            }
        }

        $active = "my";

        return view('tasks.mycompletedtasks')->with([
            'myTasks' => $myTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /{memberid}
    * Displays all current tasks for a team member
    */

    public function showMemberTasks($memberId) {
        $member = Member::with('tasks')->find($memberId);

        $memberTasks = $member->tasks->where('completed', false)->
            sortBy('due_date')->all();

        $active = "team";

        return view('tasks.membertasks')->with([
            'member' => $member,
            'memberTasks' => $memberTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /{memberid}/completed
    * Displays all completed tasks for a team member
    */

    public function showMemberCompleted($memberId) {
        $member = Member::with('tasks')->find($memberId);

        $memberTasks = $member->tasks->where('completed', true)->
            sortBy('due_date')->all();

        $active = "team";

        return view('tasks.membercompletedtasks')->with([
            'member' => $member,
            'memberTasks' => $memberTasks,
            'active' => $active
        ]);
    }

    /**
    * GET /new
    * Displays form to add a new task
    */

    public function new() {

        $membersForCheckboxes = Member::getMembersForCheckboxes();

        $active = "add";

        return view('tasks.new')->with([
            'membersForCheckboxes' => $membersForCheckboxes,
            'active' => $active
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
            $task->due_date = Carbon\Carbon::parse($request->due_date)->
                addHours(23)->addMinutes(59)->addSeconds(59)->toDateTimeString();
        }

        $task->completed = false;
        $task->save();

        $members = ($request->members) ?: [];
        $task->members()->sync($members);
        $task->save();

        Session::flash('message', 'The task "'.$task->task.'" has been added.');
        Session::flash('new', $task->task);

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
            $task->due_date = Carbon\Carbon::parse($request->due_date)->
                toDateString();
        }

        $members = ($request->members) ?: [];
        $task->members()->sync($members);

        $task->save();

        Session::flash('message',
            'The task "'.$task->task.'" has been updated.');
        Session::flash('updated', $task->task);

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

        Session::flash('message',
            'The task "'.$task->task.'" has been deleted.');

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

        Session::flash('message',
            'The task "'.$task->task.'" has been marked complete.');

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

        Session::flash('message',
            'The task "'.$task->task.'" has been marked incomplete.');

        return redirect('/');
    }
}
