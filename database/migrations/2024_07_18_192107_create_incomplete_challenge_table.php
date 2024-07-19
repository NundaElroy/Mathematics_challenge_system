<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncompleteChallengeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('incomplete_challenge')) {
        Schema::create('incomplete_challenge', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participant_id'); // Ensure this matches the type of `participants.id`
            $table->string('challenge_details');
            $table->timestamps();

             // Adding the foreign key constraint
             $table->foreign('participant_id')
             ->references('id')
             ->on('participants')
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
        Schema::dropIfExists('incomplete_challenge');
    }
}
