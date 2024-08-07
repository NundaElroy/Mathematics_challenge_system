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
        if (!Schema::hasTable('schools')) {
        Schema::create('schools', function (Blueprint $table) {
            $table->string('registration_no')->primary();
            $table->string('name');
            $table->string('district');
            $table->string("representative_name");
            $table->string("representative_email")->unique();
            $table->timestamps();

           
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
        Schema::dropIfExists('schools');
    }
}
