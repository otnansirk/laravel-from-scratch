@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
    <div class="container">
      <h1 class="display-3">Welcome to myPosts App!</h1>
      <p>This is a learn app with laravel framework</p>
      @guest
      <p>
          <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
          <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Register</a>
      </p>
      @endguest
    </div>
  </div>
@endsection
