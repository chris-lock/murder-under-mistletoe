<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('copy');
            $table->integer('value');
            $table->boolean('completed')->nullable();

            $table->integer('character_id')->unsigned()->index();
            $table->integer('act_id')->unsigned()->index();

            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
            $table->foreign('act_id')->references('id')->on('acts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructions');
    }
}
