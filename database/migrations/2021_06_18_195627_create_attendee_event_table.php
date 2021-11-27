<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendeeEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_event', function (Blueprint $table) {
            $table->bigInteger('attendee_id')->unsigned()->index();
//            $table->foreignId('attendee_id')->constrained()->onDelete('cascade');
            $table->BigInteger('event_id')->unsigned()->index();
//            $table->foreignId('event_id')->constrained()->onDelete('cascade');
//            $table->primary(['attendee_id', 'event_id']);
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
        Schema::dropIfExists('attendee_event');
    }
}
