<!DOCTYPE html>
<html>

<head>
  <title>Bluepixel Technologies LLP - PMT</title>
</head>

<body class="" style="background-color:#f6f6f6;line-height:1.4;font-size:14px;font-family:sans-serif;">
  <?php $lang = 'en'; ?>
  <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background-color:#f6f6f6;width:100%;">
    <tr>
      <td style="vertical-align:top;">&nbsp;</td>
      <td class="container" style="vertical-align:top;display:block;max-width:580px;padding:10px;width:580px;Margin:0 auto !important;">
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
              <td class="wrapper" style="vertical-align:top;box-sizing:border-box;padding:20px;padding-top:0px">
                <table border="0" style="border-collapse:separate;width:100%;">

                  <tr>
                    <td style="text-align: left;">
                      <div style="">
                          <p>Dear {{$data['full_name']}},</p>
                          
                          <p>Thank you for taking the time to consider {{$data['company_name']}}. We wanted to let you know that we have chosen to move forward with a different candidate for the {{$data['technology']}} position.</p>
                          
                          <p>Our team was impressed by your skills and accomplishments. We think you could be a good fit for other future openings and will reach out again if we find a good match.

                          </p>
                          <p>We wish you all the best in your job search and future professional endeavors.
                          </p>

                         
                          <p>--<br/>
                          Best Regards,<br/>
                          {{$data['name']}}<br/>
                          {{$data['designation']}}<br/>
                          {{$data['company_name']}}</p>
                          <a href="{{URL::to($data['website_url'])}}">{{$data['website_url']}}</a>
                     </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size:14px;vertical-align:top;"></td>
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
      <td style="vertical-align:top;">&nbsp;</td>
    </tr>
  </table>
</body>

</html>