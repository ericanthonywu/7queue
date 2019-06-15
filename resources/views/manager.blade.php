<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Eric Anthony">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>7Queue's Manager</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext"
          rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('css/manager.css')}}">
</head>

<body>
<p id="alert" style="display:none">{{Session::get('alertemail')}}</p>
<?php
Session::remove('alertemail')
?>
<div class="materialContainer">
    <div class="box">
        <form id="login" autocomplete="off">
            <input type="hidden" name="status" value="manager">
            <div class="title">LOGIN</div>

            <div class="input">
                <label for="name">Username / Email</label>
                <input type="text" name="username" id="name" autocomplete="off" required>
                <span class="spin"></span>
            </div>

            <div class="input">
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" autocomplete="off" required>
                <span class="spin"></span>
            </div>

            <div class="button login">
                <button><span>GO</span> <i class="fa fa-check"></i></button>
            </div>

{{--            <a href="" class="pass-forgot">Forgot your password?</a>--}}
        </form>
    </div>

    <div class="overbox">
        <form id="register">
            <div class="material-button alt-2"><span class="shape"></span></div>

            <div class="title">REGISTER</div>

            <div class="input">
                <label for="regname">Username</label>
                <input type="text" class="alphanumeric" name="username" id="regname" autocomplete="off" required>
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="regemail">Email</label>
                <input type="email" name="email" id="regemail" autocomplete="off" required>
                <span class="spin"></span>
            </div>

            <div class="input">
                <label for="regpass">Password <span style="float:right"><span class="fa fa-fw fa-eye toggle-icon toggle-input--text" toggle="#password-field2"></span></span></label>
                <input type="password" name="password" id="regpass" autocomplete="off" required>
                <span class="spin"></span>
            </div>

            <div class="button registerr">
                <button><span id="register_next">NEXT</span></button>
            </div>
        </form>

    </div>

</div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/plugin.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('js/manager.js')}}"></script>
</html>