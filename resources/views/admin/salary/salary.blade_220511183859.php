@extends('layouts.default')
@section('content')
<style type="text/css">
   table td,table th{
   padding: 0!important;
   }
   .table2 th, .table2 td{
   border-right: 1px solid #ccc;
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
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table  invoice-detail-table" style="width:100%">
                           <tbody>
                              <tr>
                                 <td><img src="{{URL::to('dist/login/images/logo.png')}}" class="m-b-10" style="width:10%;">
                                    <img src="{{URL::to('dist/login/images/horizontal-logo.png')}}" class="m-b-10" alt="" style="height:50px;">
                                 </td>
                                 <td>
                                    <center>
                                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;<b>Bluepixel Technologies LLP</b></h5>
                                    <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1203,Elite Business Park,Opp.Sapath Hexa,Sola,Ahmedabad-380060, Since 2015</center>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table  invoice-detail-table" style="width:100%">
                           <thead>
                              <tr class="thead-default">
                                 <th colspan="4">
                                    <center>Pay Slip For The Month of May - 2022</center>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><b>Emp Id :</b> {{$salary[0]->id}}</td>
                                 <td style="text-align:left;"><b>PF No</b></td>
                              </tr>
                              <tr>
                                 <td><b>Emp Name :</b> {{$salary[0]->first_name}}</td>
                                 <td style="text-align:left;"><b>Bank A/C No</b></td>
                              </tr>
                              <tr>
                                 <td><b>Department :</b>{{$dept[0]->department_name}}</td>
                                 <td style="text-align:left;"><b>Bank Name</b></td>
                              </tr>
                              <tr>
                                 <td><b>Designation :</b> {{$salary[0]->designation_id}}</td>
                                 <td style="text-align:left;"><b>Date of Joining</b>&nbsp;&nbsp;&nbsp;{{$salary[0]->join_date}}</td>
                              </tr>
                              <tr>
                                 <td><b>PF/UAN No</b></td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table2 " style="width:100%">
                           <thead>
                              <tr class="thead-default">
                                 <th>&nbsp;&nbsp;&nbsp;<span>Working Details</span></th>
                                 <th>&nbsp;&nbsp;&nbsp;Actual</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                                 <th>&nbsp;&nbsp;&nbsp;<span>Earnings</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                                 <th>&nbsp;&nbsp;&nbsp;<span>Deductions</span><span style="float: right;">Amount(Rs.)&nbsp;&nbsp;&nbsp;</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>WD</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Basic</span><span class="tbody-tr">500&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Basic</span><span class="tbody-tr">500&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>PT</span><span class="tbody-tr">200&nbsp;&nbsp;&nbsp;</span></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>WO</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Conveyance</span><span class="tbody-tr">500&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Conveyance</span><span class="tbody-tr">500&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>PH</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Education Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Education Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>SL</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>HRA</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>HRA</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>CL</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Leave Travel Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Leave Travel Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>PL</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Medical Reimbursement</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Medical Reimbursement</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Coff</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Other Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Other Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>Present</span><span class="tbody-tr">24&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Special Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<span>Special Allowance</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<span>LWP</span><span class="tbody-tr">0&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td colspan="3"></td>
                              </tr>
                              &nbsp;&nbsp;&nbsp;
                              <tr>
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total Pay Day</b><span class="tbody-tr">0.00&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total</b><span class="tbody-tr">1000&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total Earning</b><span class="tbody-tr">1000&nbsp;&nbsp;&nbsp;</span></td>
                                 &nbsp;&nbsp;&nbsp;
                                 <td>&nbsp;&nbsp;&nbsp;<b>Total Deduction</b><span class="tbody-tr">500&nbsp;&nbsp;&nbsp;</span></td>
                              </tr>
                              <tr>
                                 <td colspan="4"><span class="tbody-tr"><b>Net Salary : </b>10000&nbsp;&nbsp;&nbsp;</span></td>
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
               <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
               <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
            </div>
         </div>
      </div>
   </div>
</div>
@stop 