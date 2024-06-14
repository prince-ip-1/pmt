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
<input type="hidden" id="emp_id" value="{{$data['employee_details']->id}}">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start --> 
      <div class="card-block table-border-style">
            <div class="card">
                <div class="card-header contact-user" style="display:flex;">
                    <div class="">
                        <img class="img-radius" src="{{getImagePath($data['employee_details']->image,'users')}}" alt="" style="height:100px;width:100px;">
                    </div>
                    <div class="">
                        <h5 class="ml-4">{{$data['employee_details']->full_name}}<br><span style="color:#000000;">{{$data['employee_details']->designation_name}}</span></h5>
                    </div>
                    
                </div>
            </div>
        </div>

      <div class="row">
       
            <div class="col-md-9">
                <div class="card"  id="monthly-data">
                         @include('admin.task.tasks_monthly_list')
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
                  <li><a data-id="01" class="select-month-task {{ $data['month']== '01' ? 'active-month' : ''  }}" href="javascript:void(0)">January</a></li>
                  <li><a data-id="02" class="select-month-task {{ $data['month']== '02' ? 'active-month' : ''  }}" href="javascript:void(0)" >February</a></li>
                  <li><a data-id="03" class="select-month-task {{ $data['month']== '03' ? 'active-month' : ''  }}" href="javascript:void(0)" >March</a></li>
                  <li><a data-id="04" class="select-month-task {{ $data['month']== '04' ? 'active-month' : ''  }}" href="javascript:void(0)" >April</a></li>
                  <li><a data-id="05" class="select-month-task {{ $data['month']== '05' ? 'active-month' : ''  }}" href="javascript:void(0)" >May</a></li>
                  <li><a data-id="06" class="select-month-task {{ $data['month']== '06' ? 'active-month' : ''  }}" href="javascript:void(0)" >June</a></li>
                  <li><a data-id="07" class="select-month-task {{ $data['month']== '07' ? 'active-month' : ''  }}" href="javascript:void(0)" >July</a></li>
                  <li><a data-id="08" class="select-month-task {{ $data['month']== '08' ? 'active-month' : ''  }}" href="javascript:void(0)" >August</a></li>
                  <li><a data-id="09" class="select-month-task {{ $data['month']== '09' ? 'active-month' : ''  }}" href="javascript:void(0)" >September</a></li>
                  <li><a data-id="10" class="select-month-task {{ $data['month']== '10' ? 'active-month' : ''  }}" href="javascript:void(0)" >October</a></li>
                  <li><a data-id="11" class="select-month-task {{ $data['month']== '11' ? 'active-month' : ''  }}" href="javascript:void(0)" >November</a></li>
                  <li><a data-id="12" class="select-month-task {{ $data['month']== '12' ? 'active-month' : ''  }}" href="javascript:void(0)" >December</a></li>
               </ul>
            </div>
            
        </div>
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->

<div class="modal fade" id="task-report-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Task Tracking Detail</h4>
             <div></div>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                    <!-- <span aria-hidden="true">&times;</span> -->
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                 <h6>Employee Name: <span id="employee_name_r"></span></h6>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <p>Date: <span id="date_r"></span></p>
                            
                            </div>
                        </div>
                           
                            <table class="table table-styling table-xs">

                            <div class="form-group row">
                            <thead>
                          <tr class="table-primary">
                            <th>Sr No.</th>
                            <th>Task Name</th>
                            <th>Time</th>
                            <th>Duration</th>
                          </tr>

                        </thead>
                        <tbody id="task-report-details">
                         <tr>
                            <td>
                            </td>
                         </tr>
                        </tbody>
                       </div>
                      </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light ">Submit</button> -->
                    </div>
        </div>
    </div>
</div>
@stop