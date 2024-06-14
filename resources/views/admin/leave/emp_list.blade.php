<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   .md-modal{
      width: 35%;
   }
   .btn-sm_1{
       padding:5px 8px;
       border-radius:0.2rem;
   }
</style>
<input type="hidden" id="table_name" value="leave_details">
<input type="hidden" id="action" value="{{URL::to('add_empleave')}}">
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
               <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form" data-modal="modal-1"
                  >Add Leave
               </button>
            </div>
           
            <div class="card-block">
               <div class="dt-responsive table-responsive">
                  <table id="dt-ordering" class="table table-striped table-bordered nowrap">
                     <thead>
                        
                        <tr>
                           <th>Sr No</th>
                          <!--  <th>Employee Name</th> -->
                           <th>Title</th>
                           <th>Reason</th>
                           <th>Start Date</th>
                           <th>End Date</th>
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
                              {{$row->title}}</span> 
                           </td>
                           <td>
                              @php
                              $string = strip_tags($row->reason);
                              @endphp
                              <span>
                              {{ substr($row->reason,0,20)}}</span> 
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
                              @php
                                print_r($status)
                              @endphp 
                               </a>
                               </td>
                               <td style="white-space: nowrap; width: 1%;">
                             
                            <div class="btn-group btn-group-sm " style="float: none;">
                              <button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light  display_data btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-eye"></span></button>
                             
                           </div>
                            <div class="btn-group btn-group-sm " >
                             @php
                             $status_type = 0;
                             if(strtotime($row->start_date) >= strtotime(date('Y-m-d')) && $row->status == 1 )
                                 $status_type = 1;
                             @endphp      
                              @if(strtotime($row->start_date) >= strtotime(date('Y-m-d')))
                             <button type="button" data-id="{{$row->id}}" class=" btn btn-primary waves-effect waves-light  cancel_leave btn-group-sm "   id="removeleave" style="float: none;margin: 5px;"><span class="fa fa-times" aria-hidden="true"></span></button>
                             
                             @endif
                                
                           </div>
                            <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                             @if(strtotime($row->start_date) >= strtotime(date('Y-m-d')))
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                 @endif
                                 
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