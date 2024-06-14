@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   .tabledit-input{
      display: none;
   }
</style>
<input type="hidden" id="table_name" value="department">
<input type="hidden" id="action" value="{{URL::to('adddepartment')}}">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
        
         <!-- Edit With Button card end -->
         <div class="card">
            <div class="card-header">
                @php
                $permission = getPermission();
                @endphp
               @if(isset($permission[0]->add) && $permission[0]->add == 1 || getDepartment() == 1)
               <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form"  data-modal="modal-1"
                  >Add Department
               </button>
               @endif
            </div>
            <div class="card-block">
               <div class="dt-responsive table-responsive">
                  <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Department Name</th>
                            @if(isset($permission[0]->delete) && $permission[0]->delete == 1 || getDepartment() == 1)
                           <th>Status</th>
                           @endif
                            @if(isset($permission[0]->edit) && $permission[0]->edit == 1 || getDepartment() == 1)
                           <th>Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['department'] as $k=>$row)
                        <tr id="table_tr_{{$row->id}}"  class="view_tr_{{$row->id}}">
                           <th scope="row">
                              <span class="tabledit-span">{{$k+1}}</span>
                              
                           </th>
                           <td>
                              <span class="tabledit-span department_{{$row->id}} tabledit-span_{{$row->id}}">{{$row->department_name}}</span>
                               <input class="form-control tabledit-input_{{$row->id}}" type="text" name="department_name" id="department_name_{{$row->id}}" value="{{$row->department_name}}" style="display:none">
                           </td>
                              @if(isset($permission[0]->delete) && $permission[0]->delete == 1 || getDepartment() == 1)

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
                              @endif
                               @if(isset($permission[0]->edit) && $permission[0]->edit == 1 || getDepartment() == 1)
                                 
                           <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                              </div>
                              
                              
                              <div class="tabledit-toolbar btn-toolbar tabledit-input_{{$row->id}}" style="text-align: left;display: none;">
                                 <div class="btn-group btn-group-sm" style="float: none;"><button data-id="{{$row->id}}" type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light close_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-close"></span>
                                    </button>
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
            </div>
         </div>
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->
<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-1">
      <div class="md-content">
         <h3>Department</h3>
         <div>
            @include('admin.department.add')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
@stop