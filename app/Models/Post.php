<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Khai báo bảng liên kết (nếu không theo quy ước Laravel)
    protected $table = 'posts';

    // Khai báo các trường có thể gán đại trà (Mass Assignment)
    protected $fillable = [
        'title',
        'summary',
        'content',
        'status',
        'comment_status',
        'tags',
        'image',
        'views',
        'user_id',  // user_id là người đăng bài
    ];

    // Khai báo mối quan hệ "1 - N" với bảng users (mỗi bài viết thuộc về 1 người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);  // Mỗi bài viết thuộc về một người dùng
    }

    // Khai báo mối quan hệ "1 - N" với bảng comments (nếu có bảng comments)
/*     public function comments()
    {
        return $this->hasMany(Comment::class);  // Một bài viết có thể có nhiều bình luận
    } */
}
