
@extends('layouts.default')
@section('content')
 @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
              
                @endphp
<div class="main-body">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
    
            padding: 8px 30px 8px 20px!important;
        }
    </style>
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
       
        <div class="row">
            
            <div class="col-lg-12 filter-bar">
                
                 
            
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
              <ul class="nav navbar-nav sal">
                  <li class="nav-item m-r-25" style="width: 300px;">
                      <div class="col-lg-12">
                      <select class="js-example-basic-single col-sm-12 select2-hidden-accessible" id="projectId2" name="project_id" >
                                                               <option value="">Select Project</option>
                          @foreach($data['project_list'] as $row)
                          <option value="{{$row->project_name}}">{{$row->project_name}}</option>
                          @endforeach
                                                            </select>
                     </div>
                   
                  </li>
                  <li class="nav-item m-r-25">
                    <button  id="filterProject" class="btn btn-primary"  title="">Filter</button>
                  </li>
                  <li class="nav-item m-r-25">
                    <button  id="clear" name="clear" class="btn btn-primary "  title="">Reset</button>
                  </li>
              </ul>
             
              <div class="nav-item">
                   @if(getDepartment() == 1)
                   <a href=" {{URL::to('admin/add_project')}}" class="btn btn-primary  waves-effect waves-light waves-effect md-trigger"
                  >Add Project
                </a>
                @elseif(isset($permission[11]->add) && $permission[11]->add == 1)
                <a href=" {{URL::to('employee/add_project')}}" class="btn btn-primary waves-effect waves-light waves-effect md-trigger"
                  >Add Project
                </a>
                @endif
                
               </div>
          </nav>
          </div>
          </div>
       <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
               
                  <table id="ProjectTable" class="table table-striped table-bordered nowrap" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Name</th>
                                    <th>Project Manager</th>
                                    <th>Priority</th>
                                    
                                    <th>Created Date</th>
                                    <th>Due Date</th>
                                    <th>No of Employee</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($data['project_list'] as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->project_name}}</td>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>
                                        @if($row->project_priority == 1) 
                                            <label class="label label-success">High</label>
                                        @elseif($row->project_priority == 2)
                                            <label class="label label-warning">Medium</label>
                                        @elseif($row->project_priority == 3)
                                            <label class="label label-danger">Low</label>    
                                        @endif
                                    </td>
                                   
                                    <td>{{dateformat($row->start_date)}}</td>
                                    <td>{{dateformat($row->end_date)}}</td>
                                     <td>
                                           
                                          	<?php 
                                           	$a = explode(',',$row->employee_id);
                                           	$x =  count($a);
                                           ?>
                                       		<span>{{$x}}</span>
                                       	
                                       		</td>
                                     <td>
                                   
                                    @if($row->project_status == 0)
                                        <label class="label label-success">Active</label>
                                    @elseif($row->project_status == 1)
                                        <label class="label label-warning">Complete</label>
                                    @elseif($row->project_status == 2)
                                        <label class="label label-danger">Deactive</label>
                                    @elseif($row->project_status == 3)
                                        <label class="label label-warning">Hold</label>
                                    @elseif($row->project_status == 4)
                                        <label class="label label-warning">InHouse</label>
                                    @elseif($row->project_status == 5)
                                        <label class="label label-success">InProgress</label>
                                    @elseif($row->project_status == 6)
                                        <label class="label label-warning">Sleep</label>
                                    @elseif($row->project_status == 7)
                                        <label class="label label-danger">Cancel</label>
                                    @elseif($row->project_status == 8)
                                        <label class="label label-other">Other</label>
                                    @endif
                                    </td>
                                    <!--if(isset($permission[11]->view) && $permission[11]->view == 1)-->
                                    <td>
                                         <div class="btn-group-sm tabledit-span_1 " style="float: none;">
   
                                         @if(getDepartment() == 1)   
                                            <a href="{{URL::to('admin/edit_project/'.$row->id)}}" class="btn btn-primary waves-effect waves-light"> <span class="icofont icofont-ui-edit"></span></a>
                                            <a href="{{URL::to('admin/view_project_details/'.$row->id)}}" class="btn btn-warning waves-effect waves-light mr-1 "> <span class="icofont icofont-eye"></span></a>
                                            <a href="javascript:void(0);" class="task-report-exp" data-id="{{$row->id}}"> <button type="button"  class="btn btn-warning waves-effect waves-light btn-group-sm btn-sm "><span class="fa fa-download"></span></button></a>
                                         @else 
                                          <a href="{{URL::to('employee/view_project_details/'.$row->id)}}" class="btn btn-warning waves-effect waves-light mr-1 "> <span class="icofont icofont-eye"></span></a>
                                         
                                         @endif
                                        @if(isset($permission[11]->edit) && $permission[11]->edit == 1)
                                          <a href="{{URL::to('employee/edit_project/'.$row->id)}}" class="btn btn-primary waves-effect waves-light"> <span class="icofont icofont-ui-edit"></span></a>
                                        @endif
                                        
                                         
                                       
                                        </div>
                                    <!--<a href="{{URL::to('admin/view_project_details/'.$row->id)}}" class=" btn btn-warning waves-effect waves-light  btn-group-sm btn-sm " ><span class="icofont icofont-eye"></span></a>-->
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="task-report-exp-mdl" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Please select month : <span id="display-date"></span></h4>  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>         
        <div class="modal-body">
           <div class="modal-body">
              <input type="hidden" name="project_id" id="project_id" value="">
              <div class="form-group row">
                <div class="col-md-12">
                  <input class="form-control" type="month" id="month" name="month">
                </div>           
              </div>
            </div>
        </div>
        <div class="modal-footer">
             <button type="button" class="btn btn-primary waves-effect waves-light" id="task_report_submit">Submit</button>
            <button type="button" class="btn  btn-default waves-effect exp-close-btn" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@stop