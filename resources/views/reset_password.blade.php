
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>PMT - Reset Password</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{URL::to('dist/login/plugins/bootstrap/css/bootstrap.min.css')}}" />

<!-- Core css -->
<link rel="stylesheet" href="{{URL::to('dist/login/css/main.css')}}"/>
<link rel="stylesheet" href="{{URL::to('dist/login/css/theme1.css')}}"/>
<style>
     .fa-lock{
    font-size: 100px !important;
 }
 
</style>
</head>
<body class="font-montserrat">
<div class="row">
    <!-- <div class="col-md-8 event-banner_image overlay"> -->
        <div class="col-md-8">
        <div class="image-containe" style="margin-top:30%;margin-left: 25%;position: absolute;">
            <img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" style="width:50%;" alt="Bluepixel">
            <!-- <h1 style="margin-left: 10%;font-size: 80px;color:#1A5089;text-shadow: 2px 2px #f7931e;">PMT</h1> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="auth">
            <div class="auth_left">
                <div class="card">
                    <div class="text-center mb-2">
                        <a class="header-brand" href="https://bluepixeltech.com"><img alt="Bluepixel" src="{{URL::to('dist/login/images/logo.png')}}" style="width:20%;"></a>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Reset Password </div>
                        <form action="{{URL::to('reset_password/'.$token)}}" method="post">
                              
                              @if(session()->has('error'))
                              <div class="alert alert-danger">
                              {{ session()->get('error') }}
                              </div>
                              @endif
                              @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            {{csrf_field()}}
                            <div class="form-group">
                                <label><h6>Password</h6></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                <span style="float: right;
  margin-left: -25px;
  margin-top: -25px;
  margin-right: 10px;
  position: relative;
  z-index: 2;"><i toggle="#password-field" class="fa fa-eye toggle-password"></i></span>
                            </div>
                            
                            <div class="form-group">
                                <label><h6>Confirm Password</h6></label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                       
                        <label class="form-label"><a href="{{URL::to('login')}}"  class="float-right small">Login</a></label>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
    <!-- <div class="auth_right full_img"></div> -->
</div>
<script type="text/javascript" src="{{URL::to('dist/bower_components/jquery/js/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href=" https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<script src="{{URL::to('dist/login/bundles/lib.vendor.bundle.js')}}"></script>
<script src="{{URL::to('dist/login/js/core.js')}}"></script>
<script>
 $(document).on('click', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
   
</script>
</body>
</html>