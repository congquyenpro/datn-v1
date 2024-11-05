<?php 
// database/migrations/YYYY_MM_DD_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();  // Tạo trường id, khóa chính tự động tăng
            $table->string('title');  // Tạo trường title kiểu string
            $table->string('summary')->nullable();  // Tạo trường summary, có thể null
            $table->text('content');  // Tạo trường content kiểu text
            $table->string('slug')->unique();  // Tạo trường slug, duy nhất
            $table->text('tags')->nullable();  // Tạo trường tags, có thể null
            $table->integer('views')->default(0);  // Tạo trường views, mặc định là 0
            $table->enum('status', ['public', 'hidden']);  // Tạo trường status với các giá trị public hoặc hidden
            $table->enum('comment_status', ['enabled', 'disabled', 'auto']);  // Tạo trường comment_status với các giá trị enabled, disabled, auto
            $table->string('image')->nullable();  // Tạo trường image, có thể null
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Tạo trường user_id làm khóa ngoại liên kết với bảng users, xóa bài viết khi người dùng bị xóa
            $table->timestamps();  // Tạo các trường created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');  // Nếu rollback migration thì xóa bảng posts
    }
}
