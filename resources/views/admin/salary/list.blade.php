@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
  .sal .nav-item{
    line-height: 34px !important;
  }
  .col-xl-l {
    -webkit-box-flex: 0;
    flex: 0 0 19.666667%;
    max-width: 21.666667%;
  }
  /*@media (min-width: 768px) {
    .col-md-v {
      -webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 20%;max-width: 20%;
    }
  }
  @media (min-width: 1200px) {
    .col-md-v {
      -webkit-box-flex: 0;-ms-flex: 0 0 25%;flex: 0 0 20%;max-width: 20%;
    } 
  }*/
</style>
<input type="hidden" id="table_name" value="reply">
<input type="hidden" value="" name="id" id="id">
<input type="hidden" value="" name="count" id="count">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
        <div class="row">
          <div class="col-lg-12 filter-bar p-b-20">
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
              <ul class="nav navbar-nav sal">
                  <li class="nav-item">
                      <input type="month" class="form-control month" value="{{$data['month']}}">
                  </li>
                  <li class="nav-item">
                      <button type="button" class="btn btn-sm btn-primary waves-effect m-l-10 filtersalary">Filter</button>
                  </li>
              </ul>
              <div class="nav-item">
                  <h5 class="f-18"><b>Total Amount Paid: <span id="net-total">{{$data['sum']}}</span></b></h5>
              </div>
              <div class="nav-item">
                  <button type="button" class="btn btn-sm btn-primary waves-effect m-r-10 sendmail disabled" data-placement="top" title="Send Salary Slip">Send Mail</button>
              </div>
          </nav>
          </div>
        </div>
        
      <div class="row" id="data">
        @if(!empty($data['salary']))
        @foreach($data['salary'] as $val)
        <?php 
            $r = rand(0,4);
            
            $arr = array('primary','success','info','warning','danger');
            $color1 = $arr[$r];
            
            $array = array('lite-green','green','lite-green','yellow','pink');
            $color2 = $array[$r];
            
        ?>
        <div class="col-md-v col-lg-l">
          <div class="card">
            <div class="card-block user-radial-card">
              <div data-label="50%" class="radial-bar radial-bar-100 radial-bar-lg radial-bar-{{$color1}}">
                <img src="{{URL::to('uploads/users/'.$val->image)}}" alt="User-Image">
              </div>
              @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
                
                @endphp
               @if(getDepartment() == '1')
              <a href="{{URL::to('admin/employee_details/'.$val->emp_id)}}?type=salary_info" target="_blank">
                <span class="f-15 text-c-{{$color2}}">{{$val->full_name}}</span>
              </a>
              @elseif(isset($permission[6]->view) && $permission[6]->view == 1)
              <a href="{{URL::to('employee/employee_details/'.$val->emp_id)}}?type=salary_info" target="_blank">
                <span class="f-15 text-c-{{$color2}}">{{$val->full_name}}</span>
              </a>
              @endif
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->
@stop