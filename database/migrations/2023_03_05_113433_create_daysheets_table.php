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
        Schema::create('daysheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->string('site_name');
            $table->string('job_number');
            $table->date('week_ending');
            $table->date('work_date');
            $table->time('start_time');
            $table->time('finish_time')->nullable();
            $table->text('issue_fault');
            $table->text('resolution');
            $table->integer('mileage');
            $table->boolean('published')->default(false);
            $table->boolean('client_confirmed')->default(false);
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
        Schema::dropIfExists('daysheets');
    }
};
