<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconAndLecturesAndTimeAndDaysAndFormLinkAndPaidToTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->string('lectures')->nullable();
            $table->string('time')->nullable();
            $table->string('days')->nullable();
            $table->string('form_link')->nullable();
            $table->string('paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('icon')->nullable();
            $table->dropColumn('lectures')->nullable();
            $table->dropColumn('time')->nullable();
            $table->dropColumn('days')->nullable();
            $table->dropColumn('form_link');
            $table->dropColumn('paid');
        });
    }
}
