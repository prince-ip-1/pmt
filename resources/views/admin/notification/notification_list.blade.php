@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="notification">
   <input type="hidden" id="pagination_url" value="notification_pagination"> 
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="card">
        
         <div class="card-block table_data">
            @include('admin.notification._notification_pagination')
        
     </div>
     
        
      </div>
      <!-- Edit With Button card end -->
      <!-- Page-body end -->

   </div>
</div>

<!-- Main-body end -->

@stop
