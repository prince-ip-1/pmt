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
   <input type="hidden" id="table_name" value="db_backup">
   
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
            <div class="card-header">
                <a class="btn btn-primary btn-round" style="float: right;" href="{{URL::to('admin/generate_backup')}}">Generate Database</a>
               <!--<button type="button" class="btn btn-primary  btn-round waves-effect waves-light waves-effect md-trigger clear-form" data-modal="modal-1"
                  >Generate Database
               </button>-->
              
            </div>
            <div class="card-block">
               <div class="table-responsive">
                  <table id="dt-ordering" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>DataBase Name</th>
                           <th>Created Date</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                         @if(isset($data['db_backup']))
                        @foreach($data['db_backup'] as $k=>$row)
                        <tr id="table_tr_{{$row->id}}">
                           <td>{{$k+1}}</td>
                           <td>{{$row->db_name}}</td>
                           <td>{{dateformat($row->created_at)}}</td>
                           <td>
                              <div class="btn-group btn-group-sm tabledit-span_1687 " style="float: none;"> 
                                 <a data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light " href="{{URL::to('database_backup/'.$row->db_name)}}" download ><i class="icofont icofont-inbox"></i>
                                 </a>
                              <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin-left: 5px;"><span class="icofont icofont-ui-delete"></span></div>
                           </td>
                        </tr>
                        @endforeach
                         @endif
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

@stop