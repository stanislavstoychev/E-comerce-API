<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('subcontractor_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('structure_id')->unsigned();
            $table->integer('part_id')->unsigned();
            $table->integer('substructure_id')->unsigned();
            $table->text('description');
            $table->string('cover_pic')->nullable();
            $table->string('cover_date')->nullable();
            $table->string('actual_start')->nullable();
            $table->string('actual_finish')->nullable();
            $table->string('planned_start')->nullable();
            $table->string('planned_finish')->nullable();
            $table->string('priority');
            $table->string('schedule_id')->nullable();
            $table->string('percent_complete')->nullable();
            $table->integer('user_id')->unsigned();
            $able->boolean('visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
