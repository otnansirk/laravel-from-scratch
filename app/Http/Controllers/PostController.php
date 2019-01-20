<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::orderBy('created_at', 'desc')->paginate(6);
        return view('pages.posts')->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body'  => 'required'
        ]);

        // create data
        $post = new Post();
        $post->title   = $request->input('title');
        $post->body    = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('pages.detail-post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post->user_id == auth()->user()->id){
            return view('pages.edit')->with('post', $post);
        }
        return redirect('/posts')->with('error', 'No access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'body'  => 'required'
        ]);

        // create data
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body  = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // create data
        $post = Post::find($id);
        if($post->user_id !== auth()->user()->id){
            return redirect('/posts')->with('error', 'No access');
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }
}
