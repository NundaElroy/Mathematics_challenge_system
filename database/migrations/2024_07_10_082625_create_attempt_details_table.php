<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table ->string("selected_answer")->nullable();
            $table ->string("correct_answer");
            $table ->integer("score")->nullable();
            $table ->time("timetaken_per_question")->nullable();
            $table->timestamps();
            $table->boolean('is_correct')->default(false);
            
            
           /* DB::table('attempt_details')
            ->where('score', 10)
            ->update(['is_correct' => true]);
        
            DB::table('attempt_details')
            ->where('score', '<>', 10)
            ->update(['is_correct' => false]);*/
        
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
