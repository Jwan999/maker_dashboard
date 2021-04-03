<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentTrainingPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_training', function (Blueprint $table) {
//            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
//            $table->BigInteger('training_id')->unsigned()->index();
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
//            $table->primary(['student_id', 'training_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_training');
    }
}
