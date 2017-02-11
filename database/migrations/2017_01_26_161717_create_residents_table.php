<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nik');
            $table->string('gender', 20);
            $table->timestamp('date_of_birth');
            $table->bigInteger('hometown_id')->unsigned();
            $table->foreign('hometown_id')->references('id')->on('districts')->onDelete('cascade');
            $table->integer('marital_status_id')->unsigned();
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses')->onDelete('cascade');
            $table->integer('education_id')->unsigned();
            $table->foreign('education_id')->references('id')->on('education')->onDelete('cascade');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->boolean('is_patriarch')->default(false);
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
        Schema::dropIfExists('residents');
    }
}
