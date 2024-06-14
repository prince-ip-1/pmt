<!DOCTYPE html>
<html>

<head>
  <title>Bluepixel Technologies LLP - PMT</title>
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
                          <p>Hello {{$data['full_name']}},</p>
                          <p>Greetings of the day!</p>
                          <p>As per our telephonic conversation, we have Rescheduled your interview for the position of {{$data['technology']}}  in our organization. Please find the new schedule details below:</p>
                          <p><b>Date:</b> {{$data['date']}}<br/>
                          <b>Time:</b> {{$data['time']}}<br/>
                          <b>Day:</b>  {{$data['day']}}<br/> 
                           
                          </p>

                          <p>Please revert us with your confirmation. Also below attached is your Google meet’s link for online interview.<br/>
                           {{$data['link']}}
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