<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function posts()
    {
        return Tag::find(46)
            ->loadCount('posts')
            ->load('posts:title');
    }
}
