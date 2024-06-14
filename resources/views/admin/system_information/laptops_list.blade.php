@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
</style>
<div class="main-body">

   <input type="hidden" id="table_name" value="laptop">
   <input type="hidden" id="action" value="{{URL::to('/admin/add_system_information')}}">
   <input type="hidden" id="laptop_id" name="id" value="">
   <input type="hidden" name="old_invoice" id="old_invoice" value="">    
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
               @php
                $permission = getPermission();
            @endphp
                @if(isset($permission[9]->add) && $permission[9]->add == 1 || getDepartment() == 1)
                <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger" data-modal="modal-1"
                  >Add System Information
                </button>
                @endif
            </div>
            <div class="card-block">
               <div class="table-responsive">
                  <table id="alt-pg-dt" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Assign Name</th>
                           <th>Platform</th>
                           <th>System Model</th>
                           <th>RAM</th>
                           <th>Gen</th>
                           <th>Storage</th>
                           @if(isset($permission[9]->delete) && $permission[9]->delete == 1 || getDepartment() == 1)
                           <th>Status</th>
                           @endif
                            @if(isset($permission[9]->edit) && $permission[9]->edit == 1 || getDepartment() == 1)
                           <th>Action</th>
                            @endif
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['system_information'] as $k=>$row)
                         <tr id="table_tr_{{$row->id}}">
                           <th scope="row">{{$k+1}}</th>
                           
                           <td>
                            <span>
                                    @if($row->emp_id == "0")
                                         <span>Spare</span>
                                  
                           @else
                           <span>{{$row->first_name}} {{$row->last_name}}</span>
                           @endif
                           </td>
                           <td>
                              <span>
                              {{$row->platform}}</span> 
                           </td>

                           <td>
                            <span>
                              {{$row->system_model}} </span>
                           </td>
                           
                           <td>
                              <span>
                              {{$row->ram}}</span> 
                           </td>
                           <td>{{$row->gen}}</td>
                           
                           <td>
                              <span>
                              {{$row->storage}}</span> 
                           </td>
                           @if(isset($permission[9]->delete) && $permission[9]->delete == 1 || getDepartment() == 1)

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
                              <select class="form-control tabledit-input_{{$row->id}}" size="1"  id="status" name="status" style="display:none" >
                                 <option value="1">Active</option>
                                 <option value="0">Deactive</option>
                              </select>
                          
                           </td>
                           @endif
                               @if(isset($permission[9]->edit) && $permission[9]->edit == 1 || getDepartment() == 1)
                                 
                          <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                 <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                                @if(!empty($row->invoice))<button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light " style="float: none;margin: 5px;"><a style="color: #fff;margin-right: -5px;" href = "{{getImagePath($row->invoice,'invoice')}}" download><i class="icofont icofont-inbox"></i></a></button>@endif
                              </div>

                              <div class="tabledit-toolbar btn-toolbar tabledit-input_{{$row->id}}" style="text-align: left;display: none;">
                                 <div class="btn-group btn-group-sm" style="float: none;">
                                    <button data-id="{{$row->id}}"  type="button" class="tabledit-edit-button btn btn-primary waves-effect waves-light edit_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span>
                                    </button>
                                    
                                 </div>
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
         <h3>System Information</h3>
         <div>
            @include('admin.system_information.add_laptop')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>


@stop