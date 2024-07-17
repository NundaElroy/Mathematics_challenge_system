<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->date('opening_date')->nullable(false);
            $table->date('closing_date')->nullable(false);
            $table->string('challenge_name')->unique()->nullable(false);
            $table->time('duration')->nullable(false);
            $table->integer('number_of_questions');
            $table->timestamps();

            // Add other constraints if necessary
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
