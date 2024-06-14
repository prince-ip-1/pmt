<!DOCTYPE html>
<html lang="en">

<head>
    <title>PMT - Salary Slip</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    
    <style type="text/css">
    	@page { 
    		size: 40cm 50cm;
    		margin-right:1.5cm;
    		margin-left:1.5cm;
    	}
  	.top_rw{ background-color:#e9ecef; }
  	.td_w{ }
    .invoice-box {
        max-width: 1200px;
        margin: auto;
        padding:10px;
        border: 1px solid #000;
        /*box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
        font-size: 17px;
        line-height: 24px;
        font-family: "Open Sans",sans-serif;
        color: #000;
    }
    .invoice-box table {
        width: 1190px!important;
        line-height: inherit;
        /*text-align: left;*/
    /*border-bottom: solid 1px #ccc;*/
    }
    .invoice-box table td {
        padding: 5px;
        vertical-align:middle;
    }
    .invoice-box table tr td:nth-child(2) {
        /*text-align: right;*/
    }
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #000;
    }
    .invoice-box table tr.information table td {
        /*padding-bottom: 40px;*/
        font-size:17px;
    }
    table td,table th{
     padding: 5px!important;
    }
     .table2 th, .table2 td{
     border-right: 1px solid #000;
     }
     .table2 th:nth-child(4){
     border-left: 1px solid #000;
     }
     .tbody-tr{
     float: right;
     }
    .heading {
      background: #D3D1D1;
      border-bottom: 1px solid #000;
      color: #353c4e;
      font-size:17px;
    }
    .invoice-box table tr.heading td {
        background: #D3D1D1;
        border-bottom: 1px solid #000;
        font-weight: bold;
        font-size:17px;
    }
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    .invoice-box table tr.item td{
        border-bottom: 1px solid #000;
    }
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    .invoice-box table tr.total td:nth-child(2) {
        /*border-top: 2px solid #000;*/
        font-weight: bold;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            /*width: 100%;*/
            /*display: block;*/
            text-align: center;
        }
        .invoice-box table tr.information table td {
            /*width: 100%;*/
            /*display: block;*/
            text-align: center;
        }
    }
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: "Open Sans",sans-serif;
    }
    .rtl table {
        text-align: right;
    }
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .emp-info td {
      border-bottom : 1px solid #000
    }
    .salary-info td {
      border : 1px solid #000;
      font-size:17px;
    }
    .tbody-tr{
     float: right;
     }
	</style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <span style="">
                <img src="{{URL::to('dist/login/images/logo.png')}}" class="m-b-10" style="width:50px;margin-right:5px;">
                <img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" class="m-b-10" alt="" style="height:50px;">
              </span>
            </td>
            <td style="width:50%;margin-right: 10px;text-align: center;">
                  <span style="font-size:30px;"><b>Bluepixel Technologies LLP</b></span><br>
                  1203, Elite Business Park, Opp.Sapath Hexa,<br>Sola, Ahmedabad-380060, Since 2015
            </td>
          </tr>
          <tr class="top">
            <td colspan="3">
              <table>
                  <tr class="heading">
                     <th>
                        <center>Pay Slip For The Month of {{Carbon\Carbon::parse($data['salary']->date)->format('F - Y')}}</center>
                     </th>
                  </tr>
              </table>
            </td>
          </tr>
          <tr class="information">
            <td colspan="3">
              <table class="emp-info">
                
                  <tr>
                     <td><b>Emp Id :</b> {{$data['salary']->empId}}</td>
                     <td style="text-align:left;"><b>PF No:</b></td>
                  </tr>
                  <tr>
                     <td><b>Emp Name :</b> {{$data['salary']->full_name}}</td>
                     <td style="text-align:left;"><b>Bank A/C No:</b> {{$data['salary']->account_no}}</td>
                  </tr>
                  <tr>
                     <td><b>Department :</b> {{$data['salary']->department_name}}</td>
                     <td style="text-align:left;"><b>Bank Name:</b> {{$data['salary']->bank_name}}</td>
                  </tr>
                  <tr>
                     <td><b>Designation :</b> {{$data['salary']->designation_name}}</td>
                     <td style="text-align:left;"><b>Date of Joining:</b> {{dateformat($data['salary']->join_date)}}</td>
                  </tr>
                  <tr>
                     <td><b>PF/UAN No:</b> </td>
                     <td></td>
                  </tr>

              </table>
            </td>
          </tr>
          <tr>
            <td height="30"></td>
          </tr>
          <tr>
            <td colspan="3">
              <table cellspacing="0px" class="salary-info">
                <tr class="heading">
                  <th style="width:25%;text-align:left;">&nbsp;&nbsp;<span>Working Details</span></th>
	              <th style="width:25%;text-align:left;">&nbsp;&nbsp;Earnings</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
	              <th style="width:25%;text-align:left;">&nbsp;&nbsp;<span>Deductions</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                </tr>
                <tr class="item">
                  <td>&nbsp;&nbsp;&nbsp;<span>Month Days</span><span class="tbody-tr">{{$data['salary']->month_days}}&nbsp;&nbsp;&nbsp;</span></td>
                  <td>&nbsp;&nbsp;&nbsp;<span>Basic</span><span class="tbody-tr">{{$data['salary']->basic_salary}}&nbsp;&nbsp;&nbsp;</span></td>
                  &nbsp;&nbsp;&nbsp;
                  <td>&nbsp;&nbsp;&nbsp;<span>PT</span><span class="tbody-tr">{{$data['salary']->professional_tax}}&nbsp;&nbsp;&nbsp;</span></td>
                </tr>
                <tr class="item">
                  <td>&nbsp;&nbsp;&nbsp;<span>Leave Taken</span><span class="tbody-tr">{{$data['salary']->cl}}&nbsp;&nbsp;&nbsp;</span></td>
                  <td>&nbsp;&nbsp;&nbsp;<span>Conveyance</span><span class="tbody-tr">{{$data['salary']->conveyance}}&nbsp;&nbsp;&nbsp;</span></td>
                  &nbsp;&nbsp;&nbsp;
                  <td>&nbsp;&nbsp;&nbsp;<span>TDS</span><span class="tbody-tr">{{$data['salary']->tds}}&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr class="item">
                  <td>&nbsp;&nbsp;&nbsp;<span>Payable Days</span><span class="tbody-tr">{{$data['salary']->payable_days}}&nbsp;&nbsp;&nbsp;</span></td>
                  &nbsp;&nbsp;&nbsp;
                  <td>&nbsp;&nbsp;&nbsp;<span>HRA</span><span class="tbody-tr">{{$data['salary']->HRA}}&nbsp;&nbsp;&nbsp;</span></td>
                  &nbsp;&nbsp;&nbsp;
                  @if($data['salary']->security_deduction > 0)
                  <td>&nbsp;&nbsp;&nbsp;<span>Security Deduction</span><span class="tbody-tr">{{$data['salary']->security_deduction}}&nbsp;&nbsp;&nbsp;</span></td>
                  @else
                  <td></td>
                  @endif
                </tr>
                <tr class="item">
                  <td>&nbsp;&nbsp;&nbsp;<span>Current Leave Balance</span><span class="tbody-tr">{{$data['salary']->leave_balance}}&nbsp;&nbsp;&nbsp;</span></td>
                  <td>&nbsp;&nbsp;&nbsp;<span>Special Allowance</span><span class="tbody-tr">{{$data['salary']->special_allowance}}&nbsp;&nbsp;&nbsp;</span></td>&nbsp;&nbsp;&nbsp;
                  <td></td>
                </tr>
                <tr class="item">
                  <td></td>
                  <td>&nbsp;&nbsp;&nbsp;<span>TADA</span><span class="tbody-tr">{{$data['salary']->TADA}}&nbsp;&nbsp;&nbsp;</span></td>
                  &nbsp;&nbsp;&nbsp;
                  <td></td>
                </tr>
                <tr class="item">
                  <td colspan="3" height="20"></td>
                </tr>
                <tr class="item">
                  <td></td>
                   &nbsp;&nbsp;&nbsp;
                  <td>&nbsp;&nbsp;&nbsp;<b>Total Salary</b><span class="tbody-tr">{{$data['salary']->total_salary}}&nbsp;&nbsp;&nbsp;</span></td>
                   &nbsp;&nbsp;&nbsp;
                  <td>&nbsp;&nbsp;&nbsp;<b>Total Deduction</b><span class="tbody-tr">{{$data['salary']->total_deduction}}&nbsp;&nbsp;&nbsp;</span></td>
                </tr>
              </table>
            </td>
          </tr>
          
          <tr class="">
              <td colspan="5" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tbody-tr"> Net Salary :<b> {{$data['salary']->total_amount}} </b> </span></td>
          </tr>
          <tr>
            <td colspan="5"></td>
          </tr>
          <tr>
            <td colspan="5"><b>* This is system generated payslip and hence does not required stamp or signature.</b></td>
          </tr>
        </table>
    </div>
</body>

</html>