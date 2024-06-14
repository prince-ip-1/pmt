@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }

  
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="candidate">
     <input type="hidden" name="candidate_id" class="candidate_id" >
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
                         <th>Name</th>
                         <th>Email Id</th>
                         <th>Date/Time</th>
                         <th>Technology</th>
                         <th>Status</th>
                         <th>Action</th>
                        </tr>
                     </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($data['candidate_details_list'] as $row)
                        
                        <tr id="table_tr_{{$row->id}}">
                        <td>{{$i++}}</td>
                        <td>
                            <span class="tabledit-span holiday_name_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{$row->fullname}}
                            </span>
                        </td>
                        <td>
                            <span class="tabledit-span holiday_name_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{$row->email_id}}
                              </span>
                        </td>
                        <td data-sort="{{date('Ymd',strtotime($row->interview_date))}}">
                            @if($row->interview_date_reschedule == "")
                             <span>{{date('d-m-Y H:i:s A',strtotime($row->interview_date))}}</span>
                            @elseif($row->interview_date != "" && $row->interview_date_reschedule != "")
                             <span>{{date('d-m-Y H:i:s A',strtotime($row->interview_date_reschedule))}}</span>
                            @endif
                        </td>
                        <td>{{$row->position}}</td>
                        
                        <td>
                            @php
                            $employeestatus = GetEmployeeCanddiateStatusList();
                            @endphp
                           <select name="emp_status" id="dropDownId" class="form-control form-control-primary employeecandidatestatus dropDownId tabledit-input_{{$row->id}}"  data-id="{{$row->id}}" style="height:37px; width:100%; " >
                              <option value="" >Select</option>
                                 @foreach($employeestatus as $k=>$a)
                                   <option  <?php echo ($row->emp_status == $k)?'selected':''?> value="{{$k}}">{{$a}}</option>
                                 @endforeach
                           </select>
                        </td>
                        @php
                                $usersession = Session('user_data');
                                $userdata = EmployeeDetailById($usersession->id);
                                $permission = $userdata->permissions;
                                $view_url = "";
                            if(getDepartment() == 1){
                               $view_url = URL::to('admin/view_candidate/'.$row->id);
                              
                            }else {
                                $view_url = URL::to('employee/view_candidate/'.$row->id);
                                 }
                            @endphp
                        <td>
                            <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                  
                                  <a href="{{$view_url}}"  class="btn btn-warning waves-effect waves-light btn-group-sm "  style="float: none;">
                                 <i class="icofont icofont-eye" style="margin-right:1px;"></i>
                                 </a>

                                <button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light " style="float: none;margin: 5px;"><a style="color: #fff;margin-right: -5px;" href = "{{getImagePath($row->cv,'candidate')}}" target="_blank"><i class="icofont icofont-inbox"></i></a></button>
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
@stop