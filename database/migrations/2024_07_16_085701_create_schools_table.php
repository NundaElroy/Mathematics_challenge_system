<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('district');
            $table->string('registration_number')->unique();
            $table->unsignedBigInteger('representative_id')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_email')->nullable();
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('representative_id')->references('id')->on('representatives')->onDelete('set null');

            // Add index for representative_name
            $table->index('representative_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
