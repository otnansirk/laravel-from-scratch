@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="justify-content-center">
                      <a href="/posts/create" class="btn btn-outline-primary">Create post</a>
                    </div>
                </div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Thumnail</th>
                      <th scope="col">Title</th>
                      <th scope="col">Body priview</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($posts as $key => $post)
                    <tr>
                      <th scope="row">{{ $key+1 }}</th>
                      <td>
                        <img class="img-thumbnail mb-3 mb-md-0" src="/storage/thumbnail/{{$post->thumbnail}}" alt="{{$post->thumbnail}}" style="width: 60px">
                      </td>
                      <td>{{$post->title}}</td>
                      <td>{!!str_limit($post->body, $limit = 55, $end = ' ...')!!}</td>
                      <td>
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-success">Edit</a>
                        <a href="" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete">
                            Delete
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="text-center mx-auto justify-content-center">
                  {!! $posts->render() !!}
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete confirmation
            </div>
            <div class="modal-footer">
                {!! Form::open(['action' => ['PostController@destroy', isset($post->id)?$post->id:''], 'method' => 'POST'])!!}
                    {{ Form::hidden('_method', 'DELETE')  }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger float-sm-right', 'data-toggle' => 'modal', 'data-target' => '#confirm-delete']) }}
                {!! Form::close() !!}
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
