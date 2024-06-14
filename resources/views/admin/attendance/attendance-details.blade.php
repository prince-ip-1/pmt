@extends('layouts.default')
@section('content')
<style>
.cover-btn {
    bottom: -2px;
    right: 7px;
    position: absolute;
}
</style>
<input type="hidden" id="table_name" value="reply">
<input type="hidden" value="" name="id" id="id">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->   
      
      <!--profile cover start-->
      @include('admin.employee.profile_cover')
      <!--profile cover end-->
      <div id="toolbar-options" class="hidden">
          <a href="#" style="color:#fff;" class="display_address"></a>
      </div>
      <div class="col-md-12" style="padding-right: 1px;padding-left: 1px;">
         <div class="card">
            <div class="card-block">
               <div class="row">
                  <div class="col-sm-4">
                     <h2 class="d-inline-block text-c-green m-r-10" id="present_days">{{$data['present_days']}}</h2>
                     <div class="d-inline-block">
                        <p class="text-muted m-b-0">Present days</p>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <h2 class="d-inline-block text-c-pink m-r-10" id="leave_taken">{{$data['taken_leave']}}</h2>
                     <div class="d-inline-block">
                        <p class="text-muted m-b-0">Leave Taken</p>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <h2 class="d-inline-block text-c-yellow m-r-10" id="late_entries">{{$data['late_entry']}}</h2>
                     <div class="d-inline-block">
                        <p class="text-muted m-b-0">Late Entries</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
            <div class="col-md-9">
                <div class="card"  id="monthly-data">
                         @include('admin.attendance.monthly-list')
                                   
                    </div>
            </div>
             <div class="col-md-3">
           
            <div class="fb-timeliner">
                <select name="select_year"  class=" js-example-basic-single select-year col-sm-12">
                  @foreach($data['year'] as $row)
                  <option value="{{$row}}">{{$row}}</option>              
                  @endforeach                                
               </select><br>

              <!--  <h2>2022</h2> -->
              @php
              $month = $data['month'];
              @endphp
               <ul>
                  <li><a data-id="01" class="select-month {{ $data['month']== '01' ? 'active-month' : ''  }}" href="javascript:void(0)">January</a></li>
                  <li><a data-id="02" class="select-month {{ $data['month']== '02' ? 'active-month' : ''  }}" href="javascript:void(0)" >February</a></li>
                  <li><a data-id="03" class="select-month {{ $data['month']== '03' ? 'active-month' : ''  }}" href="javascript:void(0)" >March</a></li>
                  <li><a data-id="04" class="select-month {{ $data['month']== '04' ? 'active-month' : ''  }}" href="javascript:void(0)" >April</a></li>
                  <li><a data-id="05" class="select-month {{ $data['month']== '05' ? 'active-month' : ''  }}" href="javascript:void(0)" >May</a></li>
                  <li><a data-id="06" class="select-month {{ $data['month']== '06' ? 'active-month' : ''  }}" href="javascript:void(0)" >June</a></li>
                  <li><a data-id="07" class="select-month {{ $data['month']== '07' ? 'active-month' : ''  }}" href="javascript:void(0)" >July</a></li>
                  <li><a data-id="08" class="select-month {{ $data['month']== '08' ? 'active-month' : ''  }}" href="javascript:void(0)" >August</a></li>
                  <li><a data-id="09" class="select-month {{ $data['month']== '09' ? 'active-month' : ''  }}" href="javascript:void(0)" >September</a></li>
                  <li><a data-id="10" class="select-month {{ $data['month']== '10' ? 'active-month' : ''  }}" href="javascript:void(0)" >October</a></li>
                  <li><a data-id="11" class="select-month {{ $data['month']== '11' ? 'active-month' : ''  }}" href="javascript:void(0)" >November</a></li>
                  <li><a data-id="12" class="select-month {{ $data['month']== '12' ? 'active-month' : ''  }}" href="javascript:void(0)" >December</a></li>
               </ul>
            </div>
            
        </div>
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->
@stop