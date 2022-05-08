<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawingdetDrawingtrnsmittalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drawingdet_drawingtrnsmittal', function (Blueprint $table) {
            $table->id();
            $table->integer('drawingdet_id')->unsigned();
            $table->integer('drawingtransmittal_id')->unsigned();
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
        Schema::dropIfExists('drawingdet_drawingtrnsmittal');
    }
}
