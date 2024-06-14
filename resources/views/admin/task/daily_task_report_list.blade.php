@extends('layouts.default')
@section('content')
 @php
                                $usersession = Session('user_data');
                                $userdata = EmployeeDetailById($usersession->id);
                                $permission = $userdata->permissions;
                               
                                @endphp
<style type="text/css">
   .waves-light{
   float: right;
   }

    .nodisplay {
        display: none;
    }
    .display {
        display: all;
    }
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="candidate">
    
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
        
      <div class="page-body">
         <div class="card">
            <div class="card-header">
                
            </div>
            <div class="card-block">
               <div class="table-responsive">
                  <table id="dt-ordering" class="table table-striped table-bordered nowrap" >
                     <thead>
                        <tr>
                         <th>Sr No</th>
                         <th>Employee Name</th>
                         <th>Total Time</th>
                         <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                        @php $i = 1;
                        
                        @endphp
                       @foreach($data['list'] as $row)
                        <tr  class="view_tr" >
                           <th scope="row"  style="width:8%;">{{$i++}}</th>
                           <td>
                             {{$row['full_name']}}
                           </td>
                           <td>
                             {{$row['total_time']}}
                            </td>
                           
                            <td> 
                                 <div class="btn-group btn-group-sm " style="float: none;">
                                    <a href="javascript:void(0)" data-id="{{$row['user_id']}}" data-start_date="{{$row['start_date']}}" class="btn btn-warning waves-effect waves-light   btn-group-sm view_task_report "  style="float: none;">
                                     <i class="icofont icofont-eye" style="margin-right:1px;"></i>
                                    </a>
                               </div>
                               <div class="btn-group btn-group-sm " style="float: none;">
                                   @if(getDepartment() == 1)
                                    <a href="{{URL::to('admin/tasks_report/'.$row['user_id'])}}" data-id="{{$row['user_id']}}" data-start_date="{{$row['start_date']}}" class="btn btn-success waves-effect waves-light   btn-group-sm"  style="float: none;">
                                     View Monthly Task
                                    </a>
                                    @else
                                    <a>
                                         <a href="{{URL::to('employee/tasks_report/'.$row['user_id'])}}" data-id="{{$row['user_id']}}" data-start_date="{{$row['start_date']}}" class="btn btn-success waves-effect waves-light   btn-group-sm"  style="float: none;">
                                     View Monthly Task
                                    </a>
                                    </a>
                                    @endif
                               </div>
                           </td>
                           
                          
                        </tr>
                      @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- Edit With Button card end -->
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->

</div>

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