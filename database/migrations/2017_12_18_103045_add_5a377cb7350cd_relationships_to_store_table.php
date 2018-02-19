<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5a377cb7350cdRelationshipsToStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function(Blueprint $table) {
            if (!Schema::hasColumn('stores', 'city_id')) {
                $table->integer('city_id')->unsigned()->nullable();
                $table->foreign('city_id', '99308_5a377cb5e9f5b')->references('id')->on('cities')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function(Blueprint $table) {
            
        });
    }
}
