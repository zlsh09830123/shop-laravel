<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title') - Shop Laravel</title>
    </head>
    <body>
        <ul class="nav">
            @if(session()->has('user_id'))
                <li><a href="/user/auth/sign-out">登出</a></li>
            @else
                <li><a href="/user/auth/sign-in">登入</a></li>
                <li><a href="/user/auth/sign-up">註冊</a></li>
            @endif
        </ul>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <a href="#">聯絡我們</a>
        </footer>
    </body>
</html>