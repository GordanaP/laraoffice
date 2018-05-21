<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileWorkDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_work_day', function (Blueprint $table) {

            $table->unsignedInteger('profile_id');
            // $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->unsignedInteger('work_day_id');
            // $table->foreign('work_day_id')->references('id')->on('work_days')->onDelete('cascade');

            $table->string('start');
            $table->string('end');
            $table->unsignedInteger('appInterval')->default(30);

            $table->primary(['profile_id', 'work_day_id', 'start', 'end']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_work_day');
    }
}