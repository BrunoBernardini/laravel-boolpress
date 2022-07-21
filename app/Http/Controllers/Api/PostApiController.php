<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $data = Post::with(["category", "tags"])->paginate(7);
        return response()->json($data);
    }

    public function show($slug)
    {
        $post = Post::where("slug", $slug)->with(["category", "tags"])->first();
        return response()->json($post);
    }
}
