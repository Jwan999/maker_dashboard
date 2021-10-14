<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->longText('description');
            $table->string('lectures')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('days')->nullable();
            $table->string('form_link');
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
        Schema::dropIfExists('current_trainings');
    }
}
