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
            $table->date('start_date');
            $table->time('start_time');
            $table->date('finish_date');
            $table->time('finish_time')->nullable();
            $table->text('issue_fault');
            $table->text('resolution');
            $table->integer('mileage');
            $table->boolean('published')->default(false);
            $table->boolean('client_confirmed')->default(false);
            $table->dateTime('confirmed_on')->nullable();
            $table->string('client_representative')->nullable();
            $table->decimal('mileage_rate', 8, 2);
            $table->decimal('markup_rate', 8, 2);
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
