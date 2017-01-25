<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkTestColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    	Schema::table('tests', function($table) {
    		$table->boolean('public');
    	});
    	Schema::table('revisions', function($table) {
    		$table->uuid('test_id');
    	});
    	Schema::table('questions', function($table) {
    		$table->uuid('revision_id');
    		$table->uuid('question_type_id');
    		$table->integer('order');
    	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    	Schema::table('tests', function($table) {
    		$table->dropColumn('public');
    	});
    	Schema::table('revisions', function($table) {
    		$table->dropColumn('test_id');
    	});
    	Schema::table('questions', function($table) {
    		$table->dropColumn('revision_id');
    		$table->dropColumn('question_type_id');
    		$table->dropColumn('order');
    	});

    }
}
