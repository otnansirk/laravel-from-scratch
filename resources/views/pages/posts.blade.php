@extends('layouts/app')

@section('content')
    @if(isset($posts))

        <div class="album py-5 bg-white">
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                          <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect fill="#55595c" width="100%" height="100%"/>
                                <text fill="#eceeef" dy=".3em" x="50%" y="50%"></text>
                            </svg>
                            <div class="card-body">
                                <a href="/posts/{{$post->id}}"> <h4>{{$post->title}}</h4> </a>
                                <p class="card-text">
                                    {!!str_limit($post->body, $limit = 55, $end = ' ...')!!}
                                </p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/posts/{{$post->id}}">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </a>
                                    </div>
                                    <small class="text-muted">{{$post->created_at}} by {{$post->user->name}}</small>
                                  </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="mx-auto justify-content-center">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>Not found posts</p>
    @endif

@endsection
