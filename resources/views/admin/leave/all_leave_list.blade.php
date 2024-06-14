@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   .btn-sm_1{
       padding:5px 8px;
       border-radius:0.2rem;
   }
</style>
<input type="hidden" id="table_name" value="leave_details">
<input type="hidden" id="action" value="{{URL::to('admin/leave/allleave')}}">
<input type="hidden" id="leave_id" name="id" value="">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
               <!--  <h5>Departments List</h5> -->
               {{-- <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form" data-modal="modal-1"
                  >Add Row
               </button> --}}
               <div class="dt-responsive table-responsive">
                <table class="m-b-20">
                        <tbody>
                            <tr>
                                <td><input class="form-control" type="month" id="min" name="min"></td>
                                <td>&nbsp; <button  id="filterBtn" class="btn btn-primary" style="" title="">Filter</button></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            </div>
            <div class="card-block">
               <div class="dt-responsive table-responsive">
                  <table id="dt-range" class="table table-striped table-bordered nowrap">
                     <thead>
                        
                        <tr>
                           <th>Sr No</th>
                           <th>Name</th>
                           <th>Title</th>
                           <th>Reason</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Apply Date</th>
                           <th>Leave Days</th>
                           <th>Status</th>
                           <th>Action</th>
                          
                        </tr>
                       
                     </thead>
                     <tbody>
                         @php $i = 1; @endphp
                         @foreach($data['leave'] as $row)
                        <tr id="deprt_{{$row->id}}">
                           <th scope="row">{{$i++}}</th>
                           <td>
                            <span>
                              {{$row->first_name}} {{$row->last_name}}</span>
                           </td>
                           <td class="text-length" >
                              <span>
                              {{$row->title}}</span> 
                           </td>
                           <td class="text-length" style="width:200px!important;max-width:200px!important;overflow: hidden;text-overflow: ellipsis!important;">
                              <span>
                              {{$row->reason}}</span> 
                           </td>
                           <td>
                              <span>
                              {{dateformat($row->start_date)}}</span> 
                           </td>
                           <td>
                              <span>
                              {{dateformat($row->end_date)}}</span> 
                           </td>
                           <td>
                              <span>{{dateformat($row->created_at)}}</span>
                           </td>
                           <td>
                          
                           @if($row->leavetype == '11')
                              <span>{{$row->leave_days_others}}</span>
                           @else 
                           <span>
                               {{$row->leavetype}}</span> 
                           @endif
                           
                              
                           </td>
                           <td id="change_status{{$row->id}}" class="status_{{$row->id}}">
                              @php 
                               $status = StatusDisplayLabel($row->status);
                               @endphp 
                              
                               <a href="" class="change_status"  data-id="{{ $row->id }}"data-type="{{$row->status}}">
                                  @php
                                   print_r($status)
                                  @endphp 
                               </a>
                               
                           </td> 
                           
                         

                            <td>
                              <div class="btn-group btn-group-sm " style="float: none;">
                              <button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light  display_data btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-eye"></span></button>
                           </div>
                           <div class="btn-group btn-group-sm " style="float: none;">
                              <a href="{{URL::to('admin/employee_details/'.$row->emp_id)}}" target="_blank"><button type="button"  class=" btn btn-danger waves-effect waves-light btn-sm_1  btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-user"></span></button></a>
                           </div>
                           <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                          
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                 <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                              </div>
                              <div class="tabledit-toolbar btn-toolbar tabledit-input_{{$row->id}}" style="text-align: left;display: none;">
                                 <div class="btn-group btn-group-sm" style="float: none;">
                                    <button data-id="{{$row->id}}"  type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light edit_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span>
                                    </button>
                                    
                                 </div>
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
 <div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-1">
      <div class="md-content">
         <h3>Employee Leave</h3>
         <div>
            @include('admin.leave.add')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div> 
<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-3">
      <div class="md-content">
         <h3>Leave Details</h3>
         <div class="scroll-model system-form"> 
            @include('admin.leave.leave_details')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
@stop