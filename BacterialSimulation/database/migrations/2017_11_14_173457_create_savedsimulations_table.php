<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedsimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savedsimulations', function (Blueprint $table) {
            $table->timestamps('dateCreated');
            $table->string('pathogenName');
            $table->string('foodName');
            $table->integer('temp');
            $table->string('simulationName');
            $table->integer('userID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('savedsimulations');
    }
}
