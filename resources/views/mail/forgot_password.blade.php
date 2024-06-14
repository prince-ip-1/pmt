<!DOCTYPE html>
<html>

<head>
  <title>Bluepixel</title>
  <style type="text/css">
    .leave td {
      padding: 5px;
    }
  </style>
</head>

<body class="" style="background-color:#f6f6f6;-webkit-font-smoothing:antialiased;font-size:14px;line-height:1.4;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;">
  <?php $lang = 'en'; ?>
  <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background-color:#f6f6f6;width:100%;">
    <tr>
      <td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
      <td class="container" style="font-family:sans-serif;font-size:14px;vertical-align:top;display:block;max-width:580px;padding:10px;width:580px;Margin:0 auto !important;">
        <div class="content" style="box-sizing:border-box;display:block;Margin:0 auto;max-width:580px;padding:10px;">
          <!-- START CENTERED WHITE CONTAINER -->
          <span class="preheader" style="color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0;"></span>
          <table class="main" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background:#fff;border-radius:3px;width:100%;">
            <!-- START MAIN CONTENT AREA -->
            <tr>
              <td>
                <table style="background-color:#e4dfdf;padding-left:15px!important;padding:10px;width:100%;padding-bottom: 6px;">
                  <td>
                    <img src="{{URL::to('dist/login/images/logo.png')}}" height="30" /> <img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" height="30" />
                  </td>
                </table>
              </td>
            </tr>
            <tr>
              <td class="wrapper" style="font-family:sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:20px;padding-top:0px">
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;">
                  <tr>
                    <td style="text-align: left;">
                      <div>
                          <h2 style="text-align: center;"><b>Reset your Password</b></h2>

                          <p>Hello {{$data['name']}},</p>
                          
                          <p>We have received a request to reset your password.</p>
                          
                          <p>Click on below link to set up a new password.</p>

                          <p style="text-align: center;"><a href="{{URL::to('reset_password/'.$data['token'])}}" target="_blank" style="display: inline-block;font-weight: 400;color: #fff;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;border-radius: 0.25rem;background: #2C5BAD;border-color: #2C5BAD;text-decoration: none;">Reset Password</a></p>

                          <p>Please ignore this email, if you did not make this request</p>
                          
                     </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: left;">
                      <p>Best Regards,<br/><b>Bluepixel Team.</b></p>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family:sans-serif;font-size:14px;vertical-align:top;"></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="background-color:#e4dfdf;padding-left:15px!important;padding:10px;width:100%;padding-bottom: 6px;">
                  <td>
                   <center style="font-size: smaller;color: #428ce3;">Copyright © Bluepixel Technologies LLP - All rights reserved</center>
                  </td>
                </table>
              </td>
            </tr>
            <!-- END MAIN CONTENT AREA -->
          </table>
          <!-- END CENTERED WHITE CONTAINER -->
        </div>
      </td>
      <td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
    </tr>
  </table>
</body>

</html>