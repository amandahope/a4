<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Count widgets',
            'due_date' => '2017-05-18 23:59:59',
            'completed' => false,
        ]);

        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Build task manager in Laravel',
            'due_date' => '2017-05-11 23:59:59',
            'completed' => false,
        ]);

        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Optimize synergies',
            'due_date' => '2017-06-01 23:59:59',
            'completed' => false,
        ]);

        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Disrupt existing paradigms',
            'due_date' => '2016-07-15 23:59:59',
            'completed' => true,
            'completed_date' => '2016-07-01 12:52:03',
        ]);

        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Evaluate team performance',
            'due_date' => '2017-06-30 23:59:59',
            'completed' => false,
        ]);

        Task::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'task' => 'Eat ice cream',
            'completed' => false,
        ]);
    }
}
