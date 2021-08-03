<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('short_description')->nullable();
                $table->text('additional_info')->nullable();
                $table->longText('description');
                $table->decimal('regular_price');
                $table->decimal('sale_price')->nullable();
                $table->string('SKU');
                $table->enum('stock_status', ['instock', 'outofstock']);
                $table->boolean('featured')->default(false);
                $table->unsignedInteger('quantity')->default(10);
                $table->string('image')->nullable();
                $table->text('images')->nullable();
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->timestamps();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        // Schema::dropIfExists('products');
        if ( ! Schema::hasColumn('products', 'additional_info')) {
            Schema::table('products', function (Blueprint $table) {
                $table->text('additional_info')->nullable()->after('description');
                });
        }
    }
}
