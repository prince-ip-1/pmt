
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>PMT - Forgot Password</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="dist/login/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Core css -->
<link rel="stylesheet" href="{{URL::to('dist/login/css/main.css')}}"/>
<link rel="stylesheet" href="{{URL::to('dist/login/css/theme1.css')}}"/>
<style>
     .fa-lock{
    font-size: 100px !important;
 }
 
.bg-color{
        background-image: url('{{URL::to("dist/login/images/bg_new.png")}}');
    //position: sticky;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% auto;
    background-position: center;
   /* background-repeat: no-repeat;
    background-size: 100% 100%;*/
}

 
</style>
</head>
<body class="font-montserrat">
<div class="row">
    <!-- <div class="col-md-8 event-banner_image overlay"> -->
        <div class="col-md-8 bg-color">
        <div class="image-containe" style="    margin-top: 27%;
    margin-left: 32%;position: absolute;">
            <!--<img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" style="width:50%;" alt="Bluepixel">-->
            <!-- <h1 style="margin-left: 10%;font-size: 80px;color:#1A5089;text-shadow: 2px 2px #f7931e;">PMT</h1> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="auth">
            <div class="auth_left">
                <div class="card" style="left:-180px;width:72%;">
                    <div class="text-center mb-2">
                        <a class="header-brand" href="https://bluepixeltech.com"><img alt="Bluepixel" src="{{URL::to('dist/login/images/logo.png')}}" style="width:20%;"></a>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Forgot Password </div>
                        <form action="{{URL::to('forgot_password')}}" method="post">
                            
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
                            {{csrf_field()}}
                        <div class="form-group">
                            <label><h6>Email</h6></label>
                            <input type="email" value="" class="form-control" name="email" id="email" aria-describedby="emailHelp" required placeholder="Enter email">
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
<script src="dist/login/bundles/lib.vendor.bundle.js"></script>
<script src="dist/login/js/core.js"></script>
<link rel="stylesheet" type="text/css" href=" https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</body>
</html>