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
            <div class="app-title">
                <h1>New Password and Confirm</h1>
            </div>
        <form  action="{{route('save_password')}}" method="post">
            <div class="login-form">
                <div class="control-group">
                    @csrf
                    <input type="password" class="login-field" name="password" id="login-name">
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                    <div class="control-group">
                        <input type="password" class="login-field" name="password_confirmation" id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                <input type="hidden" name="token" value="{{$token}}">
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Change">
                @if(isset($errors))
                    @foreach($errors->all() as $e)
                         <p>{{$e}}</p>
                    @endforeach
                @endif
            </div>
        </form>
    </div>
</div>
</body>
</html>