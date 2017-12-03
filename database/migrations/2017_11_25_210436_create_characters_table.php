<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('slug')->unique()->index();
            $table->string('guest');
            $table->string('email');
            $table->string('involvement');
            $table->string('notes');
            $table->string('costume');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('bio');
            $table->text('appearance');
            $table->text('story');
            $table->text('murder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
