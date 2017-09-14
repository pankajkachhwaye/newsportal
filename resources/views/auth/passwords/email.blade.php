<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{URL::asset('plugins/node-waves/waves.css')}}" rel="stylesheet"/>
    <!-- Animation Css -->
    <link href="{{URL::asset('plugins/animate-css/animate.css')}}" rel="stylesheet"/>
    <!-- Custom Css -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
</head>
<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">News<b>Portal</b></a>
        {{--<small>Admin BootStrap Based - Material Design</small>--}}
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" class="form-horizontal" role="form" action="{{ route('password.email') }}">
                {{ csrf_field() }}


                {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-group-addon">E-Mail Address
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>



    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Send Password Reset Link
            </button>
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
