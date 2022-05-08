<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('structure_id');
            $table->integer('substructure_id')->nullable();
            $table->integer('part_id');
            $table->integer('step_id');
            $table->string('status');
            $table->string('remark')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('user_name');//inspector
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
        Schema::dropIfExists('inspections');
    }
}
