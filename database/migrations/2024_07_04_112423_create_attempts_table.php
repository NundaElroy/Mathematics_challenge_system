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
            $table->id();
            $table->foreignId('participantid')->constrained('participants')->onDelete('cascade');
            $table->foreignId('schoolid')->constrained('schools')->onDelete('cascade');
            $table->foreignId('challengeid')->constrained('challenge')->onDelete('cascade');
            $table->dateTime('timetaken');
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
        });
        Schema::dropIfExists('attempts');
    }
}
