<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // database/migrations/xxxx_xx_xx_create_answers_table.php
    Schema::create('answers', function (Blueprint $table) {
    $table->string('answerid')->primary();
    $table->string('correct_answer');
    $table->integer('marks');
    $table->string('question');
    $table->foreign('question')-> references('questionid')->on('questions')->onDelete('cascade');


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
        Schema::dropIfExists('answers');
    }
};
