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

        // Bảng inventory
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_size_id')->constrained()->onDelete('cascade');
            $table->integer('stock_quantity');
            $table->timestamps();
        });

        // Bảng stock_entries
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_size_id')->constrained()->onDelete('cascade');
            $table->dateTime('entry_date');
            $table->integer('quantity');
            $table->integer('entry_price');
            $table->string('supplier_name')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Bảng shipping
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_id', 50)->nullable();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('partner');
            $table->integer('COD')->nullable();
            $table->integer('fee');
            $table->integer('other_fee')->nullable();
            $table->integer('total_fee');
            $table->integer('shipping_status');
            $table->integer('ds_status')->nullable();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('expected_delivery_time', 50)->nullable();
            $table->text('shipping_log')->nullable();
            $table->timestamps();
        });

        // Bảng viewed_product
        Schema::create('viewed_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('viewed_at');
            $table->timestamps();
        });

        // Bảng post
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('keyword');
            $table->text('content');
            $table->timestamps();
        });

        // Bảng comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('commentable_id');
            $table->string('commentable_type');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('parent_id')->nullable();
            $table->string('content');
            $table->integer('rating')->nullable();
            $table->timestamps();
        });

        // Bảng coupon_code
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->string('name');
            $table->string('end_date', 50);
            $table->timestamps();
        });

        // Bảng system_log
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action_type');
            $table->string('ip_address');
            $table->text('user_agent');
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_logs');
        Schema::dropIfExists('coupon_codes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('viewed_product');
        Schema::dropIfExists('shipping');
        Schema::dropIfExists('stock_entries');
        Schema::dropIfExists('inventory');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
