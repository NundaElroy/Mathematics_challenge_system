<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('report_schedules', function (Blueprint $table) {
            $table->id('reportid');
            $table->string('challengeid');
            $table->time('timetosend');
            $table->boolean('status')->default(false);
            $table->foreign('challengeid')->references('challengeId')->on('challenge');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_schedules');
    }
}
