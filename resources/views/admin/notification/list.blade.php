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
<div class="main-body">
   <input type="hidden" id="table_name" value="notification">
   <input type="hidden" id="action" value="{{URL::to('admin/add_notification')}}">
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
               <button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form" data-modal="modal-1"
                  >Add Notification
               </button>
            </div>
            <div class="card-block">
               <div class="dt-responsive table-responsive">
                  <table id="alt-pg-dt" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>Title</th>
                           <th>Message</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['notification'] as $k=>$row)
                        <tr id="table_tr_{{$row->id}}"  class="view_tr_{{$row->id}}">
                           <th scope="row">
                                 <span class="tabledit-span">{{$k+1}}</span>
                              </th>
                           <td>
                              <span class="tabledit-span title_{{$row->id}} tabledit-span_{{$row->id}}">
                              {{$row->title}}
                              </span>
                              <input class="form-control tabledit-input_{{$row->id}}" type="text" name="title" id="title_{{$row->id}}" value="{{$row->title}}" style="display:none">
                           </td>
                           <td>
                              <span class="tabledit-span message_{{$row->id}} tabledit-span_{{$row->id}}">
                                 {{$row->message}}
                              </span>
                             
                              <textarea class="form-control tabledit-input_{{$row->id}}" name="message" id="message_{{$row->id}}" rows="4" value="{{$row->message}}" style="display:none">{{$row->message}}</textarea>
                           </td>

                            <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                 <button type="button" data-id="{{ $row->id}}" class=" btn btn-primary waves-effect waves-light edit_data " style="float: none;margin: 5px;"><span class="icofont icofont-ui-edit"></span></button>
                                 <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                              </div>
                              <div class="tabledit-toolbar btn-toolbar tabledit-input_{{$row->id}}" style="text-align: left;display: none;">
                                 <div class="btn-group btn-group-sm" style="float: none;"><button data-id="{{$row->id}}" type="button" class="tabledit-edit-button btn btn-warning waves-effect waves-light close_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-close"></span>
                                    </button>
                                    <button  data-id="{{$row->id}}" type="button" class="tabledit-delete-button btn btn-danger waves-effect waves-light delete_data" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                                 </div>
                                 <button type="button" class="tabledit-save-button btn btn-sm btn-success save_tr" data-id="{{$row->id}}" style="float: none;">Save</button>
                              </div>
                           </td>
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
         <h3>Notification Type</h3>
         <div>
            @include('admin.notification.add')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
@stop