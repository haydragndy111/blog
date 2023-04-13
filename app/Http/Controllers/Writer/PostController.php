<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __invoke()
    {
        return view('writer.posts.index',[
            'posts' => Post::where('author_id', auth()->id)->paginte(5),
        ])
    }
}
