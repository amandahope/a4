<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Member;

class MemberTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            'Count widgets' => ['Fiona'],
            'Optimize synergies' => ['Milo', 'Cole'],
            'Disrupt existing paradigms' => ['Cole'],
            'Eat ice cream' => ['Fiona', 'Milo']
        ];

        foreach ($tasks as $task => $members) {
            $task = Task::where('task', 'like', $task)->first();

            foreach ($members as $firstName) {
                $member = Member::where('first_name', 'like', $firstName)->first();

                $task->members()->save($member);
            }
        }
    }
}
