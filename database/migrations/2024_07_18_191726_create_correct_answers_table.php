<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('correct_answers')) {
        Schema::create('correct_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('questionid'); // Ensure this matches the type of `questions.id`
            $table->string('answer_text');
            $table->timestamps();

// Adding the foreign key constraint
            $table->foreign('questionid')
            ->references('id')
            ->on('questions')
            ->onDelete('cascade');
         });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correct_answers');
    }
}
