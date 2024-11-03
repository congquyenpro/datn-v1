<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRelatedTables extends Migration
{
    public function up()
    {
        // Bảng orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->integer('pre_value');
            $table->integer('discount')->default(0);
            $table->integer('value');
            $table->string('name');
            $table->string('phone', 50);
            $table->string('address');
            $table->longText('description')->nullable();
            $table->dateTime('order_date');
            $table->integer('payment_status');
            $table->integer('status');
            $table->text('log')->nullable();

            /* 1/11/2024 */
            $table->string('payment_method',50)->nullable();
            $table->string('shipping_code')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->string('delivery_company_code',50)->nullable();

            $table->timestamps();
        });

        // Bảng order_items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_size_id')->constrained()->onDelete('cascade');
            $table->json('product_size_info')->nullable();
            $table->integer('quantity');
            $table->integer('item_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
