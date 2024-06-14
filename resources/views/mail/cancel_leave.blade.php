<!DOCTYPE html>
<html>

<head>
  <title>Bluepixel</title>
  <style type="text/css">
    .leave th,td {
      padding: 3px;
    }
    .leave th,td {
      vertical-align: text-top;
    }
    .leave th {
      width:25%;
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
                      <div style="">
                           <h2 style="text-align: center;"><b>Cancel Leave Application</b></h2>

                     </div>
                    </td>
                  </tr>

                  <tr>

                  <td style="text-align: left;">
                      <table class="wrapper leave" style="font-family:sans-serif;font-size:14px;box-sizing:border-box;padding:8px 0 8px 0;">
                        <tr>
                          <th>Employee Name:</th><td>{{$data['full_name']}}</td>
                        </tr>
                        <tr>
                          <th>Department:</th><td>{{$data['department_name']}}</td>
                        </tr>
                        <tr>
                          <th>Date of Leave:</th><td>{{$data['date']}}</td>
                        </tr>
                        <tr>
                          <th>Message:</th><td>LEAVE CANCELLED. This leave has been cancelled by the employee.</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
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