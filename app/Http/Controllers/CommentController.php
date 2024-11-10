<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }
    public function getAllComments(Request $request)
    {
        $comments = $this->commentService->getAllComments($request);
        return response()->json($comments);
    }

    public function addComment(Request $request)
    {
        try {
            $comment = $this->commentService->addComment($request);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 400
            ], 400);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Created successfully!',
            'data' => $comment
        ], 201);  // Trạng thái HTTP là 201 Created

    }

    public function deleteComment(Request $request)
    {
        $comment = $this->commentService->deleteComment($request);
        return response()->json($comment);
    }

    public function test(Request $request)
    {
        return response()->json($request->all());
    }
}
