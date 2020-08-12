<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title') - Shop Laravel</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <ul class="nav justify-content-end">
                @if(session()->has('user_id'))
                    <li class="nav-item"><a class="nav-link" href="/user/auth/sign-out">登出</a></li>
                    <li class="nav-item"><a class="nav-link" href="/merchandise">商品列表</a></li>
                    <li class="nav-item"><a class="nav-link" href="/transaction">交易記錄</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/user/auth/sign-in">登入</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user/auth/sign-up">註冊</a></li>
                @endif
            </ul>
        </div>
        
        <div class="container">
            @yield('content')
        </div>

        <footer class="text-center">
            <a href="#">聯絡我們</a>
        </footer>
    </body>
</html>