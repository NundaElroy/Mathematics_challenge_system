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
            $table->increments('attempt_detail_id');
            
            $table->unsignedInteger('attemptid');
            $table->foreign('attemptid')-> references('attemptid')->on('attempts')->onDelete('cascade');
            
            $table->unsignedInteger('questionid');
            $table->foreign('questionid')-> references('questionid')->on('questions')->onDelete('cascade');
            $table->unsignedInteger('participantid');
            $table->foreign('participantid')-> references('participantid')->on('participants')->onDelete('cascade');
            $table->string('challengeId');
            $table->foreign('challengeId')-> references('challengeid')->on('challenge')->onDelete('cascade');
            $table ->string("selected_answer");
            $table ->string("correct_answer");
            $table ->integer("score");
            $table ->time("timetaken_per_question");
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
