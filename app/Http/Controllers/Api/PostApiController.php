<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::with(["category", "tags"])->paginate(7);
        $categories = Category::all();
        $tags = Tag::all();
        return response()->json(compact("posts", "categories", "tags"));
    }

    public function show($slug)
    {
        $post = Post::where("slug", $slug)->with(["category", "tags"])->first();
        return response()->json($post);
    }

    public function getPostsByCategory($category_slug)
    {
        $category = Category::where("slug", $category_slug)->with("posts")->first();
        return response()->json($category);
    }

    public function getPostsByTag($tag_slug)
    {
        $tag = Tag::where("slug", $tag_slug)->with("posts")->first();
        return response()->json($tag);
    }
}
