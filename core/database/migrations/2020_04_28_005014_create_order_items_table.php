<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->unsigned()->index();
            $table->unsignedBigInteger('product_id')->unsigned()->index();
            $table->string('product_sku')->nullable();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->double('product_price')->nullable();
            $table->integer('quantity');
            $table->integer('processing_status')->default(0);
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_items');
    }
}
