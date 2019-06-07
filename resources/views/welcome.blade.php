<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            align-items: center;
            text-align: center:
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #03a9f4;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .links>a:hover {
            color: #636b6f;
            padding: 0 25px;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .links>img {
            width: 25px;
            height: 25px;
        }

        .links>img:hover {
            width: 25px;
            height: 25px;
        }

        .dev>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        .dev>a:hover {
            color: #636b6f;
            padding: 0 25px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            color: #03a9f4
        }

        .dev>img {
            width: 35px;
            height: 35px;
        }

        .dev>img:hover {
            width: 35px;
            height: 35px;

        }

        .m-b-md {
            margin-bottom: 20px;
            color: #ff4d4d
        }

        .footerIcon>img {
            width: 35px;
            height: 35px;
        }

        .react-link {
            text-decoration: none;
            color: #ff4d4d
        }

        .react-link-2 {
            text-decoration: none;
            color: #ff4d4d
        }

        .react-link-2:hover {
            text-decoration: none;
            color: red;
            font-size: 20px;

        }

        by {
            color: #636b6f;
            padding: 0 25px;
            font-weight: 600;
            letter-spacing: .1rem;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth 
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <a class="react-link" href="http://happydevapp.herokuapp.com" target="_blank">Happy Developer</a>
            </div>
            <div class="by">
                by Long & Quân
            </div><br> <br>

            <div class="links">
                <a href="https://github.com/longnb97/todo-app-php" target="_blank">Back-end Git</a>
                <img src="https://git-scm.com/images/logos/downloads/Git-Icon-Black.png" alt="" />
                <a href="https://github.com/longnb97/todo-app-client-reactjs" target="_blank">Front-end Git</a>
            </div><br>
            <div class="dev">
                <a href="https://www.facebook.com/nguyentienquan03091997" target="_blank">Dev::getInfo('Quân')</a>
                <img src="https://static.thenounproject.com/png/346345-200.png" alt="" />
                <a href="https://www.facebook.com/long.bao.777158" target="_blank">Dev::getInfo('Long')</a>
            </div><br> <br> <br> <br> <br>
            <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            align-items: center;
            text-align: center:
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #03a9f4;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .links>a:hover {
            color: #636b6f;
            padding: 0 25px;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            margin-bottom: 50px;
        }

        .links>img {
            width: 25px;
            height: 25px;
        }

        .links>img:hover {
            width: 25px;
            height: 25px;
        }

        .dev>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        .dev>a:hover {
            color: #636b6f;
            padding: 0 25px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            color: #03a9f4
        }

        .dev>img {
            width: 35px;
            height: 35px;
        }

        .dev>img:hover {
            width: 35px;
            height: 35px;

        }

        .m-b-md {
            margin-bottom: 20px;
            color: #ff4d4d
        }

        .footerIcon>img {
            width: 35px;
            height: 35px;
        }

        .react-link {
            text-decoration: none;
            color: #ff4d4d
        }

        .react-link-2 {
            text-decoration: none;
            color: #ff4d4d
        }

        .react-link-2:hover {
            text-decoration: none;
            color: red;
            font-size: 20px;

        }

        by {
            color: #636b6f;
            padding: 0 25px;
            font-weight: 600;
            letter-spacing: .1rem;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <a class="react-link" href="http://happydevapp.herokuapp.com" target="_blank">Happy Developer</a>
            </div>
            <div class="by">
                by Long & Quân
            </div><br> <br>

            <div class="links">
                <a href="https://github.com/longnb97/todo-app-php" target="_blank">Back-end Git</a>
                <img src="https://git-scm.com/images/logos/downloads/Git-Icon-Black.png" alt="" />
                <a href="https://github.com/longnb97/todo-app-client-reactjs" target="_blank">Front-end Git</a>
            </div><br>
            <div class="dev">
                <a href="https://www.facebook.com/nguyentienquan03091997" target="_blank">Dev::getInfo('Quân')</a>
                <img src="https://static.thenounproject.com/png/346345-200.png" alt="" />
                <a href="https://www.facebook.com/long.bao.777158" target="_blank">Dev::getInfo('Long')</a>
            </div><br> <br> <br> <br> <br>
            <a class="react-link-2" style="color:royalblue" href="http://happydevapp.herokuapp.com" target="_blank">To application</a> <br> 
            <a class="react-link-2" style="color:royalblue" href="https://happy-dev.herokuapp.com/api/demo/projects" target="_blank">Api demo</a> <br> <br> <br>
            <div class="footerIcon">
                powered by
                <img src="http://www.designbust.com/download/168/thumb/laravel_icon_thum.png" alt="" /> Laravel
            </div><br> <br>
            
        </div>
    </div>
</body>
<script>
</script>

</html>
            <a class="react-link-2" style="color:royalblue" href="http://happydevapp.herokuapp.com" target="_blank">To application</a> <br> <br> <br>
            <div class="footerIcon">
                powered by
                <img src="http://www.designbust.com/download/168/thumb/laravel_icon_thum.png" alt="" /> Laravel
            </div><br> <br>
        </div>
    </div>
</body>
<script>
</script>

</html>