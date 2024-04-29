<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PostController extends Controller
{
    public function localization()
    {
        return trans_choice('validation.people', 2, ['name' => 'women']);
        return __('validation.welcome', ['name' => 'علی']);
    }

    public function cache()
    {
        $lock = Cache::lock('name', 30);

        if ($lock->get()) {
            // Do something
            
            $lock->release();
        }
    }

    public function index()
    {
        return view('post.list');
    }

    public function search(Request $request)
    {
        $search = urldecode($request->field);
        /* $search = htmlspecialchars_decode($request->field); */

        if ($search) {
            $posts = Post::with('user:id,name')->where('title', 'like', "%$search%")->get();
        } else {
            $posts = Post::with('user:id,name')->get();
        }

        return response()->json($posts);
    }

    public function listPost()
    {
        $posts = Post::with('user')->paginate();

        return response()->json($posts);
    }

    public function test()
    {
        return Post::find(4)->new_demo;

        return Post::all();
    }

    public function uploader()
    {
        $post = Post::find(2);

        $image = new Image;

        $image->image = 'image2.png';

        $post->image()->save($image);

        return 'Ok man';
    }

    /**
     * Create method for show form
     *
     * @return \Illuminate\View
     */
    public function create(): View
    {
        return view('post.create');
    }

    /**
     * Store method for add new post
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Post::create([
                'title' => $request->title,
                'demo' => $request->demo,
                'user_id' => rand(1, 10),
                'status' => $request->status,
            ]);
        } catch (Exception $e) {
            return response(status: 500);
        }
    }

    public function user()
    {
        return User::find(9, ['id'])->posts;

        return Post::find(3)->load('user:id,name');
    }

    public function comments()
    {
        $post = Post::find(8);

        $comment = new Comment;

        $comment->comment = 'new comment2';

        $comment->commentable()->associate($post)->save();

        return 'Ok';
    }
}
