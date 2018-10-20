<!DOCTYPE html>
<html lang="en">
<head>
    <title>DraftNote</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">Task List</a>
        </div>
        @if(Auth::check())
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/logout')}}">ログアウト</a>
            </div>
        @else
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/login')}}">ログイン</a>
            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/register')}}">ユーザー登録</a>
            </div>

        @endif
    </div>
</nav>

@yield('content')

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>