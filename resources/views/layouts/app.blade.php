<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{config('app.name','laravel')}}</title>
    @vite('resources/sass/app.scss')
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a href="{{route('product.index')}}" class="navber-brand">{{config('app.name','Laravel')}}</a>
            <a href="{{route('cart.index')}}" class="fas fa-shopping-cart"></a>
        </div>
    </nav>
    @yield('content')
</body>
</html>