<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Member;
use Session;
use Carbon;

class MemberController extends Controller
{
    /**
    * GET /team
    */

    public function showTeam() {
        $teamMembers = Member::with('tasks')->where('role', '=', 'member')->
            orderBy('last_name')->get();

        $active = "manage";

        return view('members.members')->with([
            'teamMembers' => $teamMembers,
            'active' => $active,
        ]);
    }

    /**
    * GET /team/new
    * Displays form to add a new team member
    */

    public function new() {

        $active = "manage";

        return view('members.new')->with([
            'active' => $active
        ]);
    }

    /**
    * POST /team/saveNew
    * Processes form to add a new team member
    */

    public function saveNew(Request $request) {

        $this->validate($request, [
            'fname' => 'required|alpha',
            'lname' => 'required|alpha'
        ]);

        $member = new Member();
        $member->first_name = $request->fname;
        $member->last_name = $request->lname;
        $member->role = 'member';

        $member->save();

        Session::flash('message', $member->first_name.' '.$member->last_name.' has been added to your team.');

        return redirect('/team');
    }

    /**
    * GET /team/edit/{id}
    * Displays form to add a new team member
    */

    public function edit($id) {

        $member = Member::find($id);

        if(is_null($member)) {
            Session::flash('message', 'Team member does not exist!');
            return redirect('/team');
        }

        $active = "manage";

        return view('members.edit')->with([
            'active' => $active,
            'member' => $member,
            'id' => $id
        ]);
    }

    /**
    * POST /team/saveEdits
    * Processes form to add a new team member
    */

    public function saveEdits(Request $request) {

        $this->validate($request, [
            'fname' => 'required|alpha',
            'lname' => 'required|alpha'
        ]);

        $member = Member::find($request->id);
        $member->first_name = $request->fname;
        $member->last_name = $request->lname;

        $member->save();

        Session::flash('message', $member->first_name.' '.$member->last_name.' has been updated.');

        return redirect('/team');
    }

    /**
    * GET /team/delete/{id}
    * Displays form to delete a task
    */

    public function delete($id) {

        $member = Member::find($id);

        if(is_null($member)) {
            Session::flash('message', 'Team member does not exist!');
            return redirect('/team');
        }

        $active = "manage";

        return view('members.delete')->with([
            'id' => $id,
            'member' => $member
        ]);
    }

    /**
    * POST /team/saveDelete
    * Processes form to delete a task
    */

    public function saveDelete(Request $request) {

        $member = Member::find($request->id);

        $member->tasks()->detach();

        $member->delete();

        Session::flash('message', $member->first_name.' '.$member->last_name.' has been deleted from your team.');

        return redirect('/team');
    }

}
