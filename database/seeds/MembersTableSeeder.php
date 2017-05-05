<?php

use Illuminate\Database\Seeder;
use App\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'first_name' => 'Fiona',
            'last_name' => 'Meercat',
            'role' => 'member',
        ]);

        Member::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'first_name' => 'Milo',
            'last_name' => 'Tiger',
            'role' => 'member',
        ]);

        Member::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'first_name' => 'Cole',
            'last_name' => 'Panther',
            'role' => 'member',
        ]);

        Member::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'first_name' => 'Amanda',
            'last_name' => 'Lion',
            'role' => 'leader',
        ]);
    }
}
