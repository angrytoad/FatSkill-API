<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCandidateNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function ($table) {
            $table->string('name')->nullable(true)->change();
            $table->string('telephone')->nullable(true)->change();
            $table->string('location')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function ($table) {
            $table->string('name')->nullable(false)->change();
            $table->string('telephone')->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
        });
    }
}
