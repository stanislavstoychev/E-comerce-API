<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawingtransmittalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drawingtransmittals', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->integer('project_id')->unsigned();
            $table->string('in_out')->nullable();
            $table->string('from_to')->nullable();
            $table->string('subject')->nullable();
            $table->string('came_by')->nullable();
            $table->string('date')->nullable();
            $table->string('use_for')->nullable();
            $table->string('box')->nullable();
            $table->string('folder')->nullable();
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
        Schema::dropIfExists('drawingtransmittals');
    }
}
