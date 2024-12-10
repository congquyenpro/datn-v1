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
    public function editBog(Request $request){
        $post = $this->blogService->getPostById($request->id);
        if (is_string($post->tags)) {
            $post->tags = explode(',', $post->tags); // Chuyển chuỗi thành mảng
        }
        //dd($post);
        return view('manager.blog.edit',compact('post'));
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
    public function updateBlog(Request $request){
        $id = $request->id;
        try {
            $post = $this->blogService->update($request, $id);
            $response = [
                'status' => 201,
                'message' => 'Post updated',
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
    public function deleteBlog(Request $request){
        $post = $this->blogService->delete($request);
        return $post;
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
        $latestPosts = $this->blogService->getLatestPosts();
        $tags = $post->tags;
        return view('customer.blog.detail',compact('post','tags','latestPosts'));
    }

    public function getPostByCategory(Request $request){
        $slug = $request->slug;
        $posts = $this->blogService->getPostByCategory($slug);
        //return $posts;
        return view('customer.blog.all',compact('posts','slug'));
    }
}
