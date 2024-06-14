@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   #alt-pg-dt .form-control{
       width:80%;
   }
</style>
@php
$permission = getPermission();
@endphp
<div class="main-body">
   <input type="hidden" id="table_name" value="holiday">
   <input type="hidden" id="action" value="{{URL::to('add_holiday')}}">
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
               @if(isset($permission[5]->add) && $permission[5]->add == 1 || getDepartment() == 1)
               <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form" data-modal="modal-1"
                  >Add Holiday
               </button>
               @endif
            </div>
            <div class="card-block">
               <div class="table-responsive">
                  <table id="dt-ordering" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Holiday Name</th>
                           <th>Holiday Description</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Status</th>
                            @if(isset($permission[5]->edit) || isset($permission[5]->delete) || getDepartment() == 1)
                           <th>Action</th>
                           @endif   
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['holiday'] as $k=>$row)
                        <tr id="table_tr_{{$row->id}}"  class="view_tr_{{$row->id}}">
                           <th scope="row">{{$k+1}}</th>
                           <td>
                              <span class="tabledit-span holiday_name_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{$row->holiday_name}}
                              </span>
                              <input class="form-control tabledit-input_{{$row->id}}" type="text" name="holiday_name" id="holiday_name_{{$row->id}}" value="{{$row->holiday_name}}" style="display:none">
                           </td>
                           <td style="max-width:200px;overflow: hidden;text-overflow: ellipsis;">
                              <span class="tabledit-span holiday_description_{{$row->id}} tabledit-span_{{$row->id}}">
                                 {{$row->holiday_description}}
                              </span>
                              <input class="form-control tabledit-input_{{$row->id}}" type="text" name="holiday_description" id="holiday_description_{{$row->id}}" value="{{$row->holiday_description}}" style="display:none">

                           </td>
                           <td>
                              <span class="tabledit-span start_date_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{dateformat($row->start_date)}}
                              </span> 
                              <input class="form-control tabledit-input_{{$row->id}}" type="date" name="start_date" id="start_date{{$row->id}}" value="{{$row->start_date}}" style="display:none">
                           </td>
                           <td>
                              <span class="tabledit-span end_date_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{dateformat($row->end_date)}}
                              </span> 
                               <input class="form-control tabledit-input_{{$row->id}}" type="date" name="end_date" id="end_date{{$row->id}}" value="{{$row->end_date}}" style="display:none">
                           </td>
                           <td style="text-align: center;">
                              @php 
                              $status = StatusDisplay($row->status);
                              @endphp 
                              <span id="change_status{{$row->id}}" class="tabledit-span_{{$row->id}} status_{{$row->id}}">
                              <a href="" class="change_status"  data-id="{{ $row->id }}"data-type="{{$row->status}}">
                              @php
                              print_r($status)
                              @endphp 
                              </a>
                           </span>
                           <select class="form-control tabledit-input_{{$row->id}}" size="1"  id="status_{{$row->id}}" name="status" style="display:none" >
                                 <option value="1">Active</option>
                                 <option value="0">Deactive</option>
                              </select>
                          
                           </td>
                           @if(isset($permission[5]->edit) || isset($permission[5]->delete) || getDepartment() == 1)
                           <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;display: flex;">
                              @if(isset($permission[5]->edit) && $permission[5]->edit == 1 || getDepartment() == 1)
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                   @endif
                                  @if(isset($permission[5]->delete) && $permission[5]->delete == 1 || getDepartment() == 1)
                                 <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                                 @endif
                              </div>
                              <div class="tabledit-toolbar tabledit-input_{{$row->id}}" style="text-align: left;display: none;">
                                 <div class="btn-group btn-group-sm" style="float: none;display: flex;"><button data-id="{{$row->id}}" type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light close_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-close"></span>
                                    </button>
                                     @if(isset($permission[5]->delete) && $permission[5]->delete == 1 || getDepartment() == 1)
                                    <button  data-id="{{$row->id}}" type="button" class="tabledit-delete-button btn btn-danger waves-effect waves-light delete_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                                    @endif
                                 </div>
                                 <button type="button" class="tabledit-save-button btn btn-sm btn-success save_tr" data-id="{{$row->id}}" style="float: none;">Save</button>
                              </div>
                           </td>
                           @endif
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!--  <button type="button" class="btn btn-primary waves-effect waves-light add" onclick="add_row();">Add Row
                  </button> -->
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
         <h3>Holiday</h3>
         <div>
            @include('admin.holiday.add')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
@stop