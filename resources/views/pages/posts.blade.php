@extends('layouts/app')

@section('content')
    @if(isset($posts) && count($posts) > 0)

        <div class="album py-5 bg-white">
            <div class="container">

                @foreach($posts as $post)
                    <div class="mb-5 row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                          <a href="#">
                            <img class="img-thumbnail mb-3 mb-md-0" src="/storage/thumbnail/{{$post->thumbnail}}" alt="">
                          </a>
                        </div>
                        <div class="col-md-8">
                          <a href="/posts/{{$post->id}}"> <h3>{{$post->title}}</h3> </a>
                          <p>{!!str_limit($post->body, $limit = 55, $end = ' ...')!!}</p>
                          <p><small class="text-muted">{{$post->created_at}} by {{$post->user->name}}</small></p>
                          <a class="btn btn-primary" href="/posts/{{$post->id}}">View</a>
                        </div>
                    </div>
                @endforeach

                <div class="mt-5 row">
                    <div class="mx-auto justify-content-center">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    @else
    <center>
        <p>
            <h2>EMPTY POSTS</h2>
            You Can Create <a href="/posts/create">New Post</a>
        </p><br>
        <img src="cartoon.webp" alt="" srcset="">
    </center>
    @endif

@endsection
