<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Post $posts)
    {
        //todo add in pagination
        $posts = $posts->with([
            'images' => function($q) {
                $q->withPivot('is_default');
            }
        ])->get();

        return view('blog/index', [
            'posts' => $posts,
        ]);
    }

    public function showPost(Post $postBySlug)
    {
        return view('blog/post', [
           'post' => $postBySlug,
        ]);
    }
}
