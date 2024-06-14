@extends('layouts.default')
@section('content')
<style type="text/css">
   table td,table th{
   padding: 4px!important;
   }
   .table2 th, .table2 td{
   /*border-right: 1px solid #ccc;*/
   }
   .table2 th:nth-child(4){
   border-left: 1px solid #ccc;
   }
   .tbody-tr{
   float: right;
   }
</style>
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page body start -->
      <div class="page-body">
         <!-- Invoice card start -->
         <div class="card">
            <div class="card-block">
               <div class="row">
                     <div class="col-md-3">
                        <img src="{{URL::to('dist/login/images/logo.png')}}" class="m-b-10" style="width:50px;">
                                    <img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" class="m-b-10" alt="" style="height:50px;">
                     </div>
                     <div class="col-md-7" style="margin-left:-40px;margin-top:-5px;text-align: center;padding-bottom:8px;">
                        <h4><b>Bluepixel Technologies LLP</b></h4>
                        1203, Elite Business Park, Opp.Sapath Hexa,<br>Sola, Ahmedabad-380060, Since 2015
                     </div>
                     @if($data['salary']->image != "")
                     <div class="col-md-2" style="padding-left: 12%;">
                        <img src="{{URL::to('uploads/users/'.$data['salary']->image)}}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;">
                     </div>
                     @endif
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table  invoice-detail-table" style="width:100%">
                           <thead>
                              <tr class="thead-default">
                                 <th colspan="4">
                                    <center>Pay Slip For The Month of {{Carbon\Carbon::parse($data['salary']->date)->format('F - Y')}}</center>
                                    
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
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
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="row" style="margin-top:-15px;">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table2 " style="width:100%">
                           <thead>
                              <tr class="thead-default">
                                 <th>&nbsp;&nbsp;&nbsp;<span>Working Details</span></th>
                                 <th>&nbsp;&nbsp;&nbsp;<span>Earnings</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                                 <th>&nbsp;&nbsp;&nbsp;<span>Deductions</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Month Days</span><span class="tbody-tr">{{$data['salary']->month_days}}&nbsp;&nbsp;&nbsp;</span></td>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Basic</span><span class="tbody-tr">{{$data['salary']->basic_salary}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>PT</span><span class="tbody-tr">{{$data['salary']->professional_tax}}&nbsp;&nbsp;&nbsp;</span></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Leave Taken</span><span class="tbody-tr">{{$data['salary']->cl}}&nbsp;&nbsp;&nbsp;</span></td>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Conveyance</span><span class="tbody-tr">{{$data['salary']->conveyance}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>TDS</span><span class="tbody-tr">{{$data['salary']->tds}}&nbsp;&nbsp;&nbsp;</td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Payable Days</span><span class="tbody-tr">{{$data['salary']->payable_days}}&nbsp;&nbsp;&nbsp;</span></td>
                                 <td>&nbsp;&nbsp;&nbsp;<span>HRA</span><span class="tbody-tr">{{$data['salary']->HRA}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 @if($data['salary']->security_deduction > 0)
                                 <td>&nbsp;&nbsp;&nbsp;<span>Security Deduction</span><span class="tbody-tr">{{$data['salary']->security_deduction}}&nbsp;&nbsp;&nbsp;</span></td>
                                 @else
                                 <td></td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Current Leave Balance</span><span class="tbody-tr">{{$data['salary']->leave_balance}} &nbsp;&nbsp;&nbsp;</span></td>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Special Allowance</span><span class="tbody-tr">{{$data['salary']->special_allowance}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td>&nbsp;&nbsp;&nbsp;<span>TADA</span><span class="tbody-tr">{{$data['salary']->TADA}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr class="item">
                                 <td colspan="3" height="30"></td>
                              </tr>
                              <tr>
                                 <td></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total Salary</b><span class="tbody-tr">{{$data['salary']->total_salary}}&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total Deduction</b><span class="tbody-tr">{{$data['salary']->total_deduction}}&nbsp;&nbsp;&nbsp;</span></td>
                              </tr>
                              
                              <tr>
                                 <td colspan="4"><span class="tbody-tr"><b>Net Salary : </b>{{$data['salary']->total_amount}}&nbsp;&nbsp;&nbsp;</span></td>
                              </tr>
                           </tbody>
                        </table>
                        <b>* This is system generated payslip and hence does not required stamp or signature.</b>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Invoice card end -->
         <div class="row text-center">
            <div class="col-sm-12 invoice-btn-group text-center">
               <a href="{{URL::to('downloadSalarySlip/'.$data['salary']->sid)}}" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Download</a>
               <!--<button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>-->
            </div>
         </div>
      </div>
   </div>
</div>
@stop 