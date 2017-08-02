<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{URL::asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{URL::asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>BSB</b></a>
        <small>Admin BootStrap Based - Material Design</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="msg">Sign in to start your session</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    @if ($errors->has('email'))
                        <label id="username-error" class="error" for="username">{{ $errors->first('email') }}</label>
                    @endif
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme" name="remember" {{ old('remember') ? 'checked' : ''}}>Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="sign-up.html">Register Now!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core Js -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
<!-- Waves Effect Plugin Js -->
<script src="{{URL::asset('plugins/node-waves/waves.js')}}"></script>
<!-- Validation Plugin Js -->
<script src="{{URL::asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<!-- Custom Js -->
<script src="{{URL::asset('js/admin.js')}}"></script>
<script src="{{URL::asset('js/pages/examples/sign-in.js')}}"></script>
</body>
</html>