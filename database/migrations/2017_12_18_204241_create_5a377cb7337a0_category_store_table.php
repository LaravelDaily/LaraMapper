<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5a377cb7337a0CategoryStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_store')) {
            Schema::create('category_store', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_99306_99308_store_ca_5a377cb733871')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('store_id')->unsigned()->nullable();
                $table->foreign('store_id', 'fk_p_99308_99306_category_5a377cb7338ee')->references('id')->on('stores')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_store');
    }
}
