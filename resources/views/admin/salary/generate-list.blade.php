@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
     float: right;
     }

   .dfs{
    border-bottom:1px dotted black ;
    }
  .dfs .text{
    position:absolute;
    width:130px;
    background-color:black ;
    color:#fff ;
    text-align:center;
    padding:5px 0;
    z-index:1;
    border-radius:6px;
    bottom:110%;
    left:50%;
    margin-left:-60px;
    opacity:0;
    transition:opacity 1s;
    visibility:hidden;
  }
  .dfs .text::after{
    position:absolute;
    content:"";
    border-style:solid ;
    border-width:5px;
    border-color: black transparent  transparent transparent;
    top:100%;
    left:50%;
    margin-left:-5px;
  }
  .dfs:hover .text{
    visibility:visible;
    opacity:1;
  }

</style>
<div class="main-body">

   <div class="page-wrapper">
      @include('includes.breadcrumb')

      <div class="page-body">
         <div class="row">
          <div class="col-lg-12 filter-bar p-b-20">
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
              <ul class="nav navbar-nav sal">
                  <li class="nav-item">
                    <input type="month" name="month" id="month" class="form-control" style="">
                  </li>
                  <li class="nav-item">
                    <button type="button" class="btn btn-cs btn-primary waves-effect waves-effect m-l-10 generate">Generate Salary Slip</button>
                  </li>
              </ul>
              @if(count($data['list']) > 0)
              <div class="nav-item">
                  <h5 class="f-18"><b>Total Amount Paid: <span>{{$data['total']}}</span></b></h5>
              </div>
              <div class="nav-item">
                <a href="{{URL::to('admin/deleteSalarySlip')}}" class="btn btn-primary btn-cs waves-effect waves-light waves-effect" style="margin-left: 10px;">Delete</a>
              </div>
              @endif
          </nav>
          </div>
        </div>
        
         <div class="card">
            <div class="card-block">
               <div class="table-responsive">
                  <table id="alt-pg-dt" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                         <th>No</th>
                         <th>Name</th>
                         <th>Date</th>
                         <th class="dfs">Total <span class="text">Total Salary</span> </th>
                         <th class="dfs">Basic <span class="text">Basic Salary</span></th>
                         <th class="dfs">Conv <span class="text">Conveyance</span></th>
                         <th>HRA</th>
                         <th class="dfs">SA <span class="text">Special Allowance</span></th>
                         <th>TADA</th>
                         <th>TDS</th>
                         <th class="dfs">SD <span class="text">Security Deduction</span></th>
                         <th class="dfs">PD <span class="text">Present Days</span></th>
                         <th class="dfs">PB <span class="text">Previous Leave Balance</span></th>
                         <th class="dfs">LT <span class="text">Leave Taken</span></th>
                         <th class="dfs">LB <span class="text">Leave Balance</span></th>
                         <th class="dfs">PT <span class="text">Professional Tax</span></th>
                         <th>Total</th>
                         <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $i = 1; @endphp
                        @foreach($data['list'] as $row)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$row->full_name}}</td>
                          <td>{{dateformat($row->date)}}</td>
                          <td>{{$row->total_salary}}</td>
                          <td>{{$row->basic_salary}}</td>
                          <td>{{$row->conveyance}}</td>
                          <td>{{$row->HRA}}</td>
                          <td>{{$row->special_allowance}}</td>
                          <td>{{$row->TADA}}</td>
                          <td>{{$row->tds}}</td>
                          <td>{{$row->security_deduction}}</td>
                          <td>{{$row->present_days}}</td>
                          <td>{{$row->previous_balance}}</td>
                          <td>{{$row->cl}}</td>
                          <td>{{$row->leave_balance}}</td>
                          <td>{{$row->professional_tax}}</td>
                          <td>{{$row->total_amount}}</td>
                          <td>
                            <div class="btn-group btn-group-sm" style="float: none;">
                                 <a href="{{URL::to('admin/editsalaryslip/'.$row->id)}}" class=" btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="card-footer">
              <form action="{{URL::to('admin/submitSalarySlip')}}" method="POST">
               @csrf
               <input type="submit" class="btn btn-primary btn-round waves-effect waves-light waves-effect" value="Submit">
              </form>
            </div>
         </div>
         <!-- Edit With Button card end -->
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->

@stop