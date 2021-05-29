<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('-');
            $table->string('phone')->default('-');
            $table->string('email')->default('-');
            $table->string('image');

            $table->string('governorate')->default('-');
            $table->string('gender')->default('-');
            $table->string('position')->default('-');
            $table->string('supervisor')->default('-');
            $table->string('tasks')->default('-');
            $table->string('period')->default('-');
            $table->string('salary')->default('-');
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
        Schema::dropIfExists('interns');
    }
}
