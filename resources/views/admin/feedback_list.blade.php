@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   #alt-pg-dt .form-control{
       width:80%;
   }
   table td {
    word-wrap: break-word;
    white-space: inherit;
    padding: 0.5em;
    text-align: justify;
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
               
            </div>
            <div class="card-block">
               <div class="table-responsive">
                  <table id="dt-ordering" class="table table-striped table-bordered" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           <th>User Name</th>
                           <th>Description</th>
                           <th>Created Date</th>
                           
                        </tr>
                     </thead>
                     <tbody>
                         @if(isset($data['feedback']))
                        @foreach($data['feedback'] as $k=>$row)
                        <tr>
                           <?php $full_name = EmployeeName($row['user_id']); ?>
                           <td>{{$k+1}}</td>
                           <td>{{$full_name->full_name}}</td>
                           <td>{{$row['description']}}</td>
                           <td>{{dateformat($row['created_at'])}}</td>
                           
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