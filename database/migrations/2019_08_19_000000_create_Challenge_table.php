<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge', function (Blueprint $table) {
            $table->string('challengeid')->primary();
            $table->date('opening_date');
            $table->date('closing_date');
            $table->string("challenge_name");
            $table->integer('duration');
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
