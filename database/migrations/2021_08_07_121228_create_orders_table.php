<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned();
                $table->decimal('subtotal');
                $table->decimal('discount')->default(0);
                $table->decimal('tax');
                $table->decimal('total');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('mobile');
                $table->string('email');
                $table->string('line1');
                $table->string('line2')->nullable();
                $table->string('country');
                $table->string('province');
                $table->string('city');
                $table->string('zipcode');
                $table->enum('status', ['ordered', 'delivered', 'canceled'])->default('ordered');
                $table->boolean('is_shipping_different')->default(false);
                $table->date('delivered_date')->nullable();
                $table->date('canceled_date')->nullable();
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        if (! Schema::hasColumn('orders', 'delivered_date') && ! Schema::hasColumn('orders', 'canceled_date')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('canceled_date')->after('status')->nullable();
            $table->date('delivered_date')->after('status')->nullable();

        });
        }

        // Schema::dropIfExists('orders');
    }
}
