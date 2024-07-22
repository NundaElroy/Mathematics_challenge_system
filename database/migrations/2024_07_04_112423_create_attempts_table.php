<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->increments('attemptid');
            $table->unsignedInteger('participantid');
            $table->foreign('participantid')-> references('participantid')->on('participants')->onDelete('cascade');
            $table->string('school_registration_no');
            $table->foreign('school_registration_no')-> references('registration_no')->on('schools')->onDelete('cascade');
            $table->string('challengeId');
            $table->foreign('challengeId')-> references('challengeid')->on('challenge')->onDelete('cascade');
            $table->time('timetaken')->nullable();
            $table->date('attempt_date');
            $table->integer('score')->nullable();
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
        Schema::table('attempts', function (Blueprint $table) {
            // Assuming 'attempts_user_id_foreign' is the convention Laravel uses for naming foreign key constraints
            $table->dropForeign(['participantid']);
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade');
            $table->integer('score');
            $table->enum('status', ['completed', 'incomplete']);
            $table->timestamps();

        });
        Schema::dropIfExists('attempts');
    }
}
