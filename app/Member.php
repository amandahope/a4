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

        $members = Member::orderBy('last_name', 'ASC')->get();

        $membersForCheckboxes = [];

        foreach ($members as $member) {
            $membersForCheckboxes[$member['id']] = $member->first_name.' '.$member->last_name;
        }

        return $membersForCheckboxes;
    }
}
