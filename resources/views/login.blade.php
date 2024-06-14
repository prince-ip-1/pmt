<style>
     .fa-lock{
    font-size: 100px !important;
 }
 
</style>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<!-- Favicon icon -->
    <link rel="icon" href="{{AdminLogo(2)}}" type="image/x-icon">
<title>PMT - Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{URL::to('dist/login/plugins/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href=" https://use.fontawesome.com/releases/v5.7.2/css/all.css">

<!-- Core css -->
<link rel="stylesheet" href="{{URL::to('dist/login/css/main.css')}}?v=1.1"/>
<link rel="stylesheet" href="{{URL::to('dist/login/css/theme1.css')}}"/>
<style>
.bg-color{
        background-image: url('{{URL::to("dist/login/images/bg_new.png")}}');
    //position: sticky;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% auto;
    background-position: center;
  
}
</style>
</head>
<body class="font-montserrat">
<div class="row">
    <!-- <div class="col-md-8 event-banner_image overlay"> -->
        <div class="col-md-8 bg-color">
        <div class="image-containe" style="margin-top: 27%;margin-left: 32%;position: absolute;">
        </div>
    </div>
    <div class="col-md-4">
        <div class="auth">
            <div class="auth_left">
                <div class="card">
                    <div class="text-center mb-2">
                        <a class="header-brand" alt="PMT" href="https://bluepixeltech.com"><img alt="logo" src="{{URL::to('dist/login/images/logo.png')}}" style="width:20%;"></a>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Login to your account</div>
                        <form action="{{URL::to('login')}}" method="post">
                           <!--  @csrf -->
                           {{csrf_field()}}
                            @php if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
                               {
                                  $login_email = $_COOKIE['login_email'];
                                  $login_pass  = $_COOKIE['login_pass'];
                                  $is_remember = "checked='checked'";
                               }
                               else{
                                  $login_email ='';
                                  $login_pass = '';
                                  $is_remember = "";
                                }
                               @endphp
                                @if(session()->has('autherror'))
                              <div class="alert alert-danger">
                              {{ session()->get('autherror') }}
                              </div>
                              @endif
                              @if(session()->has('reset'))
                              <div class="alert alert-success">
                              {{ session()->get('reset') }}
                              </div>
                              @endif
                            
                        <div class="form-group">
                            <label><h6>Email</h6></label>
                            <input type="email" value="{{$login_email}}" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <!-- <label class="form-label">Password<a href="{{URL::to('forgot')}}"  class="float-right small">I forgot password</a></label> -->
                            <label><h6>Password</h6></label>
                            <input type="password" value="{{$login_pass}}" name="password" id="pass_log_id" class="form-control" id="password" placeholder="Password">
                             <span style="float: right; margin-left: -25px; margin-top: -25px; margin-right: 10px; position: relative; z-index: 2;"><i toggle="#password-field" class="fa fa-eye toggle-password"></i></span>
                        </div>
                         <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" {{$is_remember}} name="rememberme" id="rememberme" value="1">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{URL::to('forgot_password')}}"  class="float-right small">Forgot Password ?</a>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </form>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>

</div>
<script src="dist/login/bundles/lib.vendor.bundle.js"></script>

<script>
 $(document).on('click', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#pass_log_id");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
   
</script>
</body>
</html>