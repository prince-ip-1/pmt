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
    <input type="hidden" id="table_name" value="designation">
    <input type="hidden" id="action" value="{{URL::to('add_designation')}}">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
               @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
              
                @endphp
               @if(isset($permission[1]->add) && $permission[1]->add == 1 || getDepartment() == '1')
               <a href="{{URL::to('admin/add_designation')}}"><button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect " 
                  >Add Designation
               </button></a>
               @endif
            </div>
            <div class="card-block">
               <div class="dt-responsive table-responsive">
                  <table id="alt-pg-dt" class="table table-striped table-bordered nowrap">
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Department Name</th>
                           <th>Designation Name</th>
                            @if(isset($permission[1]->delete) && $permission[1]->delete == 1 || getDepartment() == '1')
                           <th>Status</th>
                             @endif 
                              @if(isset($permission[1]->edit) && $permission[1]->edit == 1 || getDepartment() == '1') 
                           <th>Action</th>
                           @endif
                           
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['designation'] as $k=>$row)
                        <tr id="table_tr_{{$row->id}}" class="view_tr_{{$row->id}}">
                           <th scope="row">{{$k+1}}</th>
                           <td>
                              <span class="tabledit-span tabledit-span_{{$row->id}} department_{{$row->id}}">{{$row->department_name}}</span>
                              <select class="tabledit-input form-control input-sm tabledit-input_{{$row->id}}" id="department_id_{{$row->id}}" size="1"  name="department_id" >
                                @foreach($department as $row1)
                                 <option value="{{$row1->id}}">{{$row1->department_name}}</option>
                                 @endforeach
                              </select>
                             
                           </td>
                           <td>
                              <span class="tabledit-span_{{$row->id}} designation_{{$row->id}}">{{$row->designation_name}}</span>
                              <input class="tabledit-input tabledit-input_{{$row->id}} form-control input-sm" type="text" name="designation_name" id="designation_name_{{$row->id}}" value="{{$row->designation_name}}">
                             
                           </td>
                            @if(isset($permission[1]->delete) && $permission[1]->delete == 1 || getDepartment() == '1')
                          <td style="text-align: center;">
                              @php 
                               $status = StatusDisplay($row->status);
                               @endphp 
                              <span id="change_status{{$row->id}}" class="tabledit-span_{{$row->id}} status_{{$row->id}}">
                               <a href="" class="change_status"  data-id="{{ $row->id }}" data-type="{{$row->status}}">
                                  @php
                                   print_r($status)
                                  @endphp 
                               </a>
                               </span>
                               <select class="tabledit-input tabledit-input_{{$row->id}} form-control" size="1"  id="status_{{ $row->id}}" name="status" >
                                 <option value="1">Active</option>
                                 <option value="0">Deactive</option>
                              </select>
                           </td>
                           @endif
                            @if(isset($permission[1]->edit) && $permission[1]->edit == 1 || getDepartment() == '1')
                          <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                
                                 <a href="{{URL::to('admin/edit_designation/'.$row->id)}}" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light  " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></a>
                               
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
         <!-- Edit With Button card end -->
      </div>
      <!-- Page-body end -->
   </div>
</div>

@stop