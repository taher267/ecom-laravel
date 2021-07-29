<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCatetory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('product_category')) {
            Schema::create('product_category', function (Blueprint $table) {
                $table->foreignId('product_id');
                $table->foreignId('category_id');
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
        //Schema::dropIfExists('product_tag');
        // Schema::rename('product_tag', 'product_category');
    }
}
