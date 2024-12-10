<?php 
namespace App\Services;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Post;

class CommentService {
    public function getAllComments($request)
    {
        if ($request->type == 'post') {
            $post_id = Post::where('slug', $request->slug)->first()->id;
            $commentable_type = 'post';
            $comments = Comment::where('commentable_id', $post_id)
                ->where('commentable_type', $commentable_type)
                ->with(['user' => function($query) {
                    $query->select('id', 'name'); // Chỉ chọn trường 'id' và 'name' của bảng 'users'
                }])
                ->get();
            return $comments;
        }
        
        $slug = $request->slug;
        //lấy ra id của product từ slug
        $product_id = Product::where('slug', $slug)->first()->id;
        $commentable_type = 'product';

        $comments = Comment::where('commentable_id', $product_id)
            ->where('commentable_type', $commentable_type)
            ->with(['user' => function($query) {
                $query->select('id', 'name'); // Chỉ chọn trường 'id' và 'name' của bảng 'users'
            }])
            ->get();
        return $comments;
    }

    public function addComment($request)
    {
        if ($request->commentable_type == 'post') {
            $data = $request->validate([
                'content' => 'required|string',
            ]);
            $data['user_id'] = auth()->user()->id;
            $data['commentable_type'] = $request->commentable_type;

            //lấy id cuar post từu slug
            $data['commentable_id'] = Post::where('slug', $request->slug)->first()->id;
            try {
                $comment = Comment::create($data);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            return $comment;
        }

        $data = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer',
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['commentable_type'] = $request->commentable_type;

        if ($request->commentable_type == 'product') {
            $data['slug'] = $request->slug;
            //Từ slug lấy id của product
            $data['commentable_id'] = Product::where('slug', $request->slug)->first()->id;

        } else {
            $data['commentable_id'] = $request->post_id;
        }


        try {
            $comment = Comment::create($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        $comment->delete();
        return response()->json(['success' => 'Comment deleted successfully']);
    }
}