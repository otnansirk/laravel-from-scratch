<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PostController extends Controller
{


    protected $tr;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->tr = new GoogleTranslate();
    }

    public function tr($lang, $word)
    {
        return $this->tr->setSource()->setTarget($lang)->translate($word);
    }

    public function lang()
    {
        return session('lang');
    }

    /**
     * Display a listing of the resource.
     *auth()->user()->lang
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::paginate(5);
        foreach ($posts as $key => $post) {
            $post->title = $this->tr($this->lang(), $post->title);
            $post->body  = $this->tr($this->lang(), $post->body);
        }
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
            'body'  => 'required',
            'thumbnail' => 'image|nullable|max:1999'
        ]);

        // file upload
        if ($request->hasFile('thumbnail')) {
            // get file with extension
            $fileWithExt = $request->file('thumbnail')->getClientOriginalName();
            // get just file name
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);
            // get just file extension
            $fileExt = $request->file('thumbnail')->getClientOriginalExtension();
            // file to store
            $fileToStore = $fileName.'_'.time().'.'.$fileExt;
            // upload file
            $path = $request->file('thumbnail')->storeAs('public/thumbnail', $fileToStore);
        } else {
            $fileToStore = 'noThumbnail.PNG';
        }

        // create data
        $post = new Post();
        $post->title   = $request->input('title');
        $post->body    = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->thumbnail = $fileToStore;
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
        $post->body = $this->tr($this->lang(), $post->body);
        $post->title = $this->tr($this->lang(), $post->title);
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

        // file upload
        if ($request->hasFile('thumbnail')) {
            // get file with extension
            $fileWithExt = $request->file('thumbnail')->getClientOriginalName();
            // get just file name
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);
            // get just file extension
            $fileExt = $request->file('thumbnail')->getClientOriginalExtension();
            // file to store
            $fileToStore = $fileName.'_'.time().'.'.$fileExt;
            // upload file
            $path = $request->file('thumbnail')->storeAs('public/thumbnail', $fileToStore);
        }

        // create data
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body  = $request->input('body');
        if ($request->hasFile('thumbnail')) {
            $post->thumbnail = $fileToStore;
        }
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

        if ($post->thumbnail !== 'noThumbnail.PNG') {
            Storage::delete('public/thumbnail/'.$post->thumbnail);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }
}
