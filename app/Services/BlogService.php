<?php 

namespace App\Services;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogService {
    public function store(Request $request)
    {
        // Xác thực dữ liệu gửi lên
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|array',
            'status' => 'required|in:public,hidden',
            'comment_status' => 'required|in:enabled,disabled,auto',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',  // Hình ảnh nếu có thì phải là ảnh với dung lượng tối đa 2MB
        ]);

        // Lưu dữ liệu vào bảng posts
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->summary = $validatedData['summary'] ?? null;
        $post->content = $validatedData['content'];
        $post->status = $validatedData['status'];
        $post->comment_status = $validatedData['comment_status'];

        // Tạo slug chuẩn SEO từ title
        $slug = Str::slug($validatedData['title']);
        // Kiểm tra nếu slug đã tồn tại, thêm hậu tố số để duy trì tính duy nhất
        if (Post::where('slug', $slug)->exists()) {
            $slug = $slug . '-' .  mt_rand(22,66);  // Hoặc có thể thêm các số khác để đảm bảo slug là duy nhất
        }

        $post->slug = $slug;  // Lưu slug vào cơ sở dữ liệu


        if (isset($validatedData['tags'])) {
            // Chuyển mảng tags thành chuỗi JSON và lưu vào cơ sở dữ liệu
            $post->tags = json_encode($validatedData['tags']);
        } else {
            // Nếu không có tags, gán null
            $post->tags = null;
        }

        // Nếu có hình ảnh, lưu trữ và lưu đường dẫn vào database
        if ($request->hasFile('image')) {
            // Lấy tên tệp gốc của ảnh
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            
            // Di chuyển ảnh vào thư mục public/posts/images
            $image->move(public_path('posts/images'), $imageName);
            
            // Lưu đường dẫn vào cơ sở dữ liệu
            $post->image = 'posts/images/' . $imageName;
        }

        // Lưu user_id là id của người dùng hiện tại
        $post->user_id = $request->user()->id; // Auth::id() lấy id của người dùng đang đăng nhập

        // Lưu bài viết vào database
        $post->save();

        // Trả về thông báo thành công hoặc chuyển hướng
        return $post;
    }

    public function getAll()
    {
        return Post::with('user:id,name')->get();
    }
}