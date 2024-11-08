<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogService;

class BlogController extends Controller
{
    protected $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    //Manager
    public function showManagerBlog(){
        $posts = $this->blogService->getAll();
        return view('manager.blog.index',compact('posts'));
    }

    public function createBlog(Request $request){
        try {
            $post = $this->blogService->store($request);
            $response = [
                'status' => 201,
                'message' => 'Post created',
                'post' => $post
            ];
            return response()->json($response, 201);
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
        //return response()->json($post, 201);
    }

    public function getAll (){
        $posts = $this->blogService->getAll();
        return $posts;
    }


    //Customer
    public function getLatestPost(){
        $posts = $this->blogService->getLatestPosts();
        return $posts;
    }
    public function getPostBySlug(Request $request){
        $post = $this->blogService->getPostBySlug($request->slug);
        $tags = json_decode($post->tags);
        return view('customer.blog.detail',compact('post','tags'));
    }
}
