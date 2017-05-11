<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }

    public static function getMembersForCheckboxes() {

        $members = Member::with('tasks')->where('role', '=', 'member')->
            orderBy('last_name', 'ASC')->get();

        $membersForCheckboxes = [];

        foreach ($members as $member) {
            $count = $member->tasks->where('completed', false)->count();
            $membersForCheckboxes[$member['id']] = $member->first_name.' '.$member->last_name.' ('.$count.')';
        }

        return $membersForCheckboxes;
    }
}
