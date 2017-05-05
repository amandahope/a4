<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_task', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();
            $table->integer('member_id')->unsigned();
            $table->integer('task_id')->unsigned();

            # Make foreign keys
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_task');
    }
}
