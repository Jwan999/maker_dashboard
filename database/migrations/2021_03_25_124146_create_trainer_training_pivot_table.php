<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrainerTrainingPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_training', function (Blueprint $table) {
//            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreignId('trainer_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('trainer_training');
    }
}
