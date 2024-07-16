<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_details', function (Blueprint $table) {
            $table->id();
            $table ->foreignId('attemptid')->constrained('attempts');
            $table ->foreignId('questionid')->constrained('questions');

            $table ->foreignId('participantid')->constrained('participants');
            $table ->string("selected_answer");
            $table ->string("correct_answer");
            $table ->dateTime("timetaken_per_question");
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
        Schema::dropIfExists('attempt_details');
    }
}
