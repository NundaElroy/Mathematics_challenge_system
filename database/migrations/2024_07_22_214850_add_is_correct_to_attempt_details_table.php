<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class AddIsCorrectToAttemptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attempt_details', function (Blueprint $table) {
            $table->boolean('is_correct')->default(false);
        });
        
    DB::table('attempt_details')->update(['is_correct'=>DB::raw('score=10')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attempt_details', function (Blueprint $table) {
            $table->dropColumn('is_correct');  
        });
    }
}
