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
@php
  $permission = getPermission();
@endphp
<input type="hidden" id="table_name" value="reply">
 <input type="hidden" value="" name="id" id="id">
 <input type="hidden" value="" name="leave_id" id="leave_id">
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
                                <td><input class="form-control" type="month" id="min" name="min" value="<?=date('Y-m')?>"></td>
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
                            @if(isset($permission[3]->edit) && $permission[3]->edit == 1 || getDepartment() == 1)
                            <th>Status</th>
                           <th>Action</th>
                           @endif
                          
                        </tr>
                       
                     </thead>
                     <tbody>
                         @php $i = 1; @endphp
                         @foreach($data['leave'] as $row)
                        <tr id="deprt_{{$row->id}}">
                           <th scope="row">{{$i++}}</th>
                           <td>
                            <span>{{$row->full_name}}</span>
                           </td>
                           <td class="text-length">
                              <span>
                              {{$row->title}}</span> 
                           </td>
                           <td class="text-length" style="width:200px!important;max-width:200px;overflow: hidden;text-overflow: ellipsis;">
                              <span>
                              {{$row->reason}}</span> 
                           </td>
                           <td>
                              <span>{{dateformat($row->start_date)}}</span> 
                           </td>
                           <td>
                              <span>{{ isset($row->end_date) ? dateformat($row->end_date) : '-'}}</span> 
                           </td>
                           <td>
                               <span>{{dateformat($row->created_at)}}</span>
                           </td>
                           <td>
                           @if($row->leavetype == '11')
                              <span>{{$row->leave_days_others}}</span>
                           @else 
                              <span>{{$row->leavetype}}</span> 
                           @endif
                           </td>
                           <td id="change_status{{$row->id}}" class="status_{{$row->id}}">
                              @php 
                               $status = StatusDisplay(2);
                               @endphp 
                              
                               <a href="" class="change_status"  data-id="{{ $row->id }}"data-type="{{$row->status}}">
                                  @php
                                   print_r($status)
                                  @endphp 
                               </a>
                               
                           </td> 
                           
                           {{-- <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm" style="float: none;">
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                 
                                 <button type="button" data-id="{{$row->id}}" class=" delete_data btn btn-danger waves-effect waves-light"  style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                              </div>
                           </td> --}}

                           {{-- view reply --}}
                        
                           <td>
                                @if(isset($permission[3]->edit) && $permission[3]->edit == 1 || getDepartment() == 1)
                              <div class="btn-group btn-group-sm" style="float: none;">
                             <button type="button" data-id="{{ $row->id}}" class="reply-btn btn btn-info waves-effect waves-light " style="float: none; margin: 5px;" 
                  >Reply
               </button></div>
               @endif
               <div class="btn-group btn-group-sm " style="float: none;">
                    <a href="{{URL::to('admin/employee_details/'.$row->emp_id)}}" target="_blank"><button type="button"  class=" btn btn-danger waves-effect waves-light btn-sm_1  btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-user"></span></button></a>
                              <button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light  display_data btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-eye"></span></button>
                              <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data_leave" style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                
                               <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
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
            @include('admin.leave.edit')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div> 
<div class="animation-model reply">
   <div class="md-modal md-effect-1" id="modal-2">
      <div class="md-content">
         <h3>Reply</h3>
         <div>
            @include('admin.leave.reply')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
<div class="animation-model reply">
   <div class="md-modal md-effect-1" id="modal-3">
      <div class="md-content">
         <h3>Leave Details</h3>
         <div>
            @include('admin.leave.leave_details')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div
@stop