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
            'category' => 'required|string',
            'comment_status' => 'required|in:enabled,disabled,auto',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp',  // Hình ảnh nếu có thì phải là ảnh với dung lượng tối đa 2MB
        ]);

        // Lưu dữ liệu vào bảng posts
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->summary = $validatedData['summary'] ?? null;
        $post->content = $this->processContent($validatedData['content']);
        $post->status = $validatedData['status'];
        $post->category = $validatedData['category'];
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
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu gửi lên
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable',
            'status' => 'required|in:public,hidden',
            'category' => 'required|string',
            'comment_status' => 'required|in:enabled,disabled,auto',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',  // Ảnh là tùy chọn
        ]);
    
        // Tìm bài viết cần cập nhật
        $post = Post::findOrFail($id);
    
        // Cập nhật các trường của bài viết
        $post->title = $validatedData['title'];
        $post->summary = $validatedData['summary'] ?? null;
        $post->content = $this->processContent($validatedData['content']);
        $post->status = $validatedData['status'];
        $post->category = $validatedData['category'];
        $post->comment_status = $validatedData['comment_status'];
    
        // Nếu title thay đổi, tạo lại slug. Nếu không thì giữ nguyên slug cũ
        if ($post->title !== $validatedData['title']) {
            $slug = Str::slug($validatedData['title']);
            // Kiểm tra nếu slug đã tồn tại, thêm hậu tố số để duy trì tính duy nhất
            if (Post::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . mt_rand(22, 66);  // Hoặc có thể thêm các số khác để đảm bảo slug là duy nhất
            }
            $post->slug = $slug;  // Lưu slug vào cơ sở dữ liệu
        }
    
        if (isset($validatedData['tags'])) {
            // Chuyển mảng tags thành chuỗi, phần tử cách nhau bởi dấu phẩy
            if (is_array($validatedData['tags'])) {
                $tags = implode(',', $validatedData['tags']);  // chuyển mảng thành chuỗi, phần tử cách nhau bởi dấu phẩy
            } else {
                // Nếu tags đã là chuỗi, thì giữ nguyên
                $tags = $validatedData['tags'];
            }
            
            // Lưu vào cơ sở dữ liệu
            $post->tags = $tags;
        } else {
            // Nếu không có tags, gán null
            $post->tags = null;
        }
        
        
    
        // Nếu người dùng tải lên ảnh mới, lưu trữ và cập nhật đường dẫn ảnh
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
            $image->move($directory, $imageName);
        
            // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
            $post->image = 'posts/images/' . $imageName;  // Lưu đường dẫn ảnh tương đối
        }
    
        // Lưu user_id là id của người dùng hiện tại
        $post->user_id = $request->user()->id; // Auth::id() lấy id của người dùng đang đăng nhập
    
        // Lưu bài viết vào database
        $post->save();
    
        // Trả về bài viết đã được cập nhật
        return response()->json([
            'status' => 'success',
            'message' => 'Bài viết đã được cập nhật thành công!',
            'post' => $post
        ]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        // Tìm bài viết cần xóa
        $post = Post::findOrFail($id);

        try {
            $post->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Bài viết đã được xóa thành công!',
            ], 200); // Mã trạng thái HTTP thành công là 200 hoặc 204
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi xóa bài viết!',
                'error' => $e->getMessage(),  // Thêm thông tin chi tiết về lỗi
            ], 500); // Mã trạng thái HTTP lỗi là 500
        }        

    }

    public function getPostByCategory($category)
    {
        switch ($category) {
            case 'kien-thuc-ve-nuoc-hoa':
                $category = 'Kiến thức về nước hoa';
                break;
            case 'kinh-nghiem-chon-nuoc-hoa':
                $category = 'Kinh nghiệm chọn nước hoa';
                break;
            case 'goc-review':
                $category = 'Góc review';
                break;
        }
        return Post::where('category', $category)
           ->select('id', 'title', 'summary', 'image','category')
           ->get();
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

    public function getPostById($id)
    {
        return Post::find($id);
    }
    public function getAll()
    {
        return Post::with('user:id,name')->get();
    }


    /* customer */
    public function getLatestPosts($limit = 5)
    {
        return Post::where('status', 'public')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
    public function getPostBySlug($slug)
    {
        $this->increaseViewCount($slug);
        return Post::where('slug', $slug)->first();
    }
    //tăng view post
    public function increaseViewCount($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->increment('views');
    }
    
}