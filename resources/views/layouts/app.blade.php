<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- ckeditor -->
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>

</head>
<body style = "background : white">

    @include('inc.navbar')
    @include('inc.messages')

    <main  role="main" class="container">
            @yield('content')
    </main>

    <footer class="text-muted fixed-bottom">
      <div class="container">
        <p>myPosts &copy; k15 2019</p>
      </div>
    </footer>
        <!-- auto load modal bootstrap -->
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#myModal').modal('show');
                setTimeout(function(){
                    $('#myModal').modal('hide');
                }, 800);
            });
        </script>
</body>
</html>
