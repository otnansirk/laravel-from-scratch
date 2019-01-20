@extends('layouts/app')

@section('content')
    <section class="jumbotron text-center  bg-white">
        <h2 class="jumbotron-heading text-secondary">
            {{$post->title}}
        </h2>
        <p>{{$post->created_at}}</p>
    </section>
    @if($post)
        <div class="container">
            <p>{!!$post->body!!}</p>
        </div>
    @else
        <section class="jumbotron text-center bg-white">
            <h2 class="jumbotron-heading text-secondary">Not found posts</h2>
        </section>
    @endif
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-success">Edit</a>
        @endif
    @endguest
@endsection
