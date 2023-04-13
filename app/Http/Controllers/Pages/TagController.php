<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('pages.tags.index', [
            'tags' => Tag::all(),
        ]);
    }

    public function show(Tag $tag)
    {
        return view('pages.tags.show',[
            'tag' => $tag,
            'posts' => Post::forTag($tag->slug())->paginate(2),
        ]);
    }
}
