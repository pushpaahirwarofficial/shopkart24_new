<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
  {
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key for this table
            $table->unsignedBigInteger('order_id'); // Foreign key for orders
            $table->unsignedBigInteger('product_productId'); // Foreign key for products
            $table->integer('quantity'); // Quantity of the product in the order
            $table->timestamps(); // Created_at and updated_at timestamps

            // Foreign key constraints
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');

            $table->foreign('product_productId')
                  ->references('productId')
                  ->on('product')
                  ->onDelete('cascade');

            // Composite key for order_id and product_productId
            $table->unique(['order_id', 'product_productId']);
        });
    }

    /*** Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
