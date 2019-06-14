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
    <title>Au Register Forms by Colorlib</title>

    <!-- CSS -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext"
          rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('css/manager.css')}}">
</head>

<body>
<div class="materialContainer">
    <div class="box">
        <form id="login">
            {{csrf_field()}}
            <div class="title">LOGIN</div>

            <div class="input">
                <label for="name">Username</label>
                <input type="text" name="name" id="name">
                <span class="spin"></span>
            </div>

            <div class="input">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass">
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
            {{csrf_field()}}
            <div class="material-button alt-2"><span class="shape"></span></div>

            <div class="title">REGISTER</div>

            <div class="input">
                <label for="regname">Username</label>
                <input type="text" class="alphanumeric" name="regname" id="regname">
                <span class="spin"></span>
            </div>
            <div class="input">
                <label for="regemail">Email</label>
                <input type="text" name="regpass" id="regemail">
                <span class="spin"></span>
            </div>

            <div class="input">
                <label for="regpass">Password</label>
                <input type="password" name="regpass" id="regpass">
                <span class="spin"></span>
            </div>

            <div class="button">
                <button><span>NEXT</span></button>
            </div>
        </form>

    </div>

</div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/plugin.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<script src="{{asset('js/manager.js')}}"></script>
</html>