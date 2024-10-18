<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRelatedTables extends Migration
{
    public function up()
    {
        // Bảng categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('slug')->unique();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        // Bảng products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('gender');
            $table->longText('images');
            $table->longText('short_description');
            $table->longText('detail_description');
            $table->integer('trending')->default(0);
            $table->integer('affiliate')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        // Bảng product_sizes
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('volume');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->timestamps();
        });

        // Bảng attributes
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Bảng attribute_values
        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });

        // Bảng product_attributes
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_value_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Xóa các bảng theo thứ tự phụ thuộc
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
}
