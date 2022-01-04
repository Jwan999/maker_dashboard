<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsInTeamMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->text('recent_accomplishment')->nullable()->change();
            $table->text('qualifications')->nullable()->change();
            $table->text('past_positions')->nullable()->change();
            $table->text('philosophy')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn('recent_accomplishment');
            $table->dropColumn('qualifications');
            $table->dropColumn('past_positions');
            $table->dropColumn('philosophy');
        });
    }
}
