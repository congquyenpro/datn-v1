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
            'tags' => 'nullable',
            'status' => 'required|in:public,hidden',
            'comment_status' => 'required|in:enabled,disabled,auto',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp',  // Hình ảnh nếu có thì phải là ảnh với dung lượng tối đa 2MB
        ]);

        // Lưu dữ liệu vào bảng posts
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->summary = $validatedData['summary'] ?? null;
        $post->content = $this->processContent($validatedData['content']);
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
            $post->tags = $validatedData['tags'];
        } else {
            // Nếu không có tags, gán null
            $post->tags = null;
        }

        // Nếu có hình ảnh, lưu trữ và lưu đường dẫn vào database
        if ($request->hasFile('image')) {
            // Lấy file ảnh từ request
            $image = $request->file('image');
            // Tạo tên ảnh duy nhất (thêm thời gian và tên file gốc)
            $imageName = time() . '-' . $image->getClientOriginalName();
    
            // Kiểm tra nếu thư mục 'posts/images' không tồn tại, tạo nó
            $directory = public_path('posts/images');
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);  // Tạo thư mục nếu chưa tồn tại
            }
    
            // Lưu file ảnh vào thư mục 'public/posts/images'
            $path = $image->move($directory, $imageName);
    
            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $post->image = 'posts/images/' . $imageName;  // Lưu đường dẫn ảnh tương đối
        }

        // Lưu user_id là id của người dùng hiện tại
        $post->user_id = $request->user()->id; // Auth::id() lấy id của người dùng đang đăng nhập

        // Lưu bài viết vào database
        $post->save();

        // Trả về thông báo thành công hoặc chuyển hướng
        return $post;
    }
    // Hàm xử lý nội dung (content) trước khi lưu vào database
    private function processContent($content)
    {
        // Kiểm tra xem nội dung có chứa base64 image hay không
        if (preg_match_all('/<img.*?src="data:image\/([a-zA-Z]*);base64,([^\"]*)".*?>/', $content, $matches)) {
            // Lặp qua tất cả các ảnh base64 và thay thế chúng
            foreach ($matches[0] as $index => $imgTag) {
                // Lấy base64 image và lưu vào thư mục public (posts/images)
                $imageData = base64_decode($matches[2][$index]);
                $imageName = 'image_' . time() . rand(1000, 9999) . '.jpg'; // Tên ảnh ngẫu nhiên
                $imagePath = public_path('posts/images/' . $imageName);

                // Lưu ảnh vào thư mục posts/images
                file_put_contents($imagePath, $imageData);

                // Thay thế tag <img> base64 bằng đường dẫn ảnh
                $content = str_replace($imgTag, '<img src="/posts/images/' . $imageName . '" />', $content);
            }
        }

        return $content;
    }


    public function getAll()
    {
        return Post::with('user:id,name')->get();
    }


    //customer
    public function getLatestPosts($limit = 5)
    {
        return Post::where('status', 'public')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    public function getPostBySlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }
}