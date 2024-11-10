<?php 
namespace App\Services;
use App\Models\Comment;
use App\Models\Product;

class CommentService {
    public function getAllComments($request)
    {
        $slug = $request->slug;
        //lấy ra

        $comments = Comment::where('commentable_id', $request->commentable_id)
            ->where('commentable_type', $request->commentable_type)
            ->with('user')
            ->get();
        return $comments;
    }

    public function addComment($request)
    {

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