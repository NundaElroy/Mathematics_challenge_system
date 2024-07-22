<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class createQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // database/migrations/xxxx_xx_xx_create_questions_table.php
    Schema::create('questions', function (Blueprint $table) {
    $table->increments('questionid');
    $table->string('question_text');
    $table->integer('marks');
    $table->string('challengeId');
    $table->foreign('challengeId')-> references('challengeid')->on('challenge')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
};
