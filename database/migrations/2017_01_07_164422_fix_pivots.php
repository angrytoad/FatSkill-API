<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revision_question', function ($table) {
            $table->dropColumn('id');
        });
        Schema::table('job_user', function ($table) {
            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revision_question', function ($table) {
            $table->uuid('id');
        });
        Schema::table('job_user', function ($table) {
            $table->uuid('id');
        });
    }
}
