<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Jobs\CreatePost;
use App\Jobs\DeletePost;
use App\Jobs\UpdatePost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        return view('admin.posts.index',[
            'posts' => Post::paginate(5),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create', [
            'tags' => Tag::all(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $this->dispatchSync(CreatePost::formRequest($request));
        return redirect()->route('admin.posts.index')->with('success', 'Post Created');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post'          => $post,
            'tags'          => Tag::all(),
            'selectedTags'  => old('tags', $post->tags()->pluck('id')->toArray()),
            // 'selectedTags'  => old('tags', $post->tags()),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->dispatchSync(UpdatePost::formRequest($post, $request));
        return redirect()->route('admin.posts.index')->with('success', 'Post Updated');
    }

    public function delete(Post $post)
    {
        $this->dispatchSync(new DeletePost($post));
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted');
    }

}
