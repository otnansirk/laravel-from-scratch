@extends('layouts.app')


@section('content')
<br>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2>Create Post</h2>
        {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{ Form::submit('Save post', ['class' => 'btn btn-primary float-sm-right']) }}
            <br>
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
                <div class="" style="color : red">{{$errors->first('title')}}</div>
                
            </div>
            <div class="form-group">
                {{ Form::label('body', 'Body text') }}
                {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body text', 'id' => 'article-ckeditor']) }}
                <div class="" style="color : red">{{$errors->first('body')}}</div>
            </div>
            <div class="form-group">
                {{ Form::label('thumbnail', 'Thumbnail') }}
                {{ Form::file('thumbnail', ['class' => 'form-control', 'placeholder' => 'Body text', 'id' => 'article-ckeditor']) }}
                <div class="" style="color : red">{{$errors->first('body')}}</div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

