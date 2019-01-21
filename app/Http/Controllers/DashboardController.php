<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostController;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = (new PostController());
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $data = $user->posts()->paginate(5);

        foreach ($data as $item) {
            $item->title = $post->tr($post->lang(), $item->title);
            $item->body  = $post->tr($post->lang(), $item->body);
        }
        return view('dashboard')->with('posts', $data);
    }
}
