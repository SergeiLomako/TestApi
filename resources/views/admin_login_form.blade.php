<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="login">
    <div class="login-screen">
        @if(isset($remember))
            <div class="app-title">
                <h1>Your Email</h1>
            </div>
        @endif
        <form  action="@if(isset($remember)){{route('send_token')}}@else{{route('admin_auth')}}@endif" method="post">
            <div class="login-form">
                <div class="control-group">
                    @csrf
                    <input type="text" class="login-field" name="email" placeholder="example@gmail.com" id="login-name">
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                @if(!isset($remember))
                    <div class="control-group">
                        <input type="password" class="login-field" name="password" id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                @endif
                <input type="submit" class="btn btn-primary btn-large btn-block" value=" @if(isset($remember)) Send @else Login @endif">
                <p>@if(session('status')) {{session('status')}}  @endif</p>
                @if(!isset($remember))
                    <a class="login-link" href="{{route('remember')}}">Lost your password?</a>
                @else
                    <a class="login-link" href="{{route('admin_login')}}">Back to login</a>
                @endif
            </div>
        </form>
    </div>
</div>
</body>
</html>