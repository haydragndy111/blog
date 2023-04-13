<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['show']);
    }
    public function index()
    {
        $posts = Post::all();
        return view('pages.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('pages.posts.show', compact('post'));
    }

    public function destroy(Post $post){
        $post->delete();
    }
}
