<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verify Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('verify_asset/css/main.css')}}">
</head>
<body>

<div class="container">

    <div class="row" id="pwd-container">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <section class="login-form">
                <form role="login">
                    <input type="hidden" id="role" value="{{$role}}">
                    <input type="hidden" name="id" id="userID" value="{{$data}}">
                    <img src="{{asset('assets_user/images/logo-7queue.png')}}" width="50%" class="img-responsive" alt=""/>
                    <h3 class="text-center"><b>Form Ubah Password {{$email}}</b></h3>
                    <input type="password" placeholder="New Password" id="password" required class="form-control input-lg"/>

                    <input type="password" id="cpassword" class="form-control input-lg" placeholder="Confirm Password"
                           required=""/>
                    <ul id="error-list"></ul>


                    <div class="pwstrength_viewport_progress"></div>


                    <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Change Password</button>
                    {{--					<div>--}}
                    {{--						<a href="#">Create account</a> or <a href="#">reset password</a>--}}
                    {{--					</div>--}}

                </form>

                <div class="form-links">
                    <a href="https://7queue.net">7queue.net</a>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
<script src="{{asset('verify_asset/js/main.js')}}"></script>
</body>
</html>