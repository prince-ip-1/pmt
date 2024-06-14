@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="notification">
   <input type="hidden" id="pagination_url" value="{{URL::to('admin/notification_pagination')}}"> 
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
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->

<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-3">
      <div class="md-content">
         <h3>Notification Detail</h3>
         <div>
            @include('admin.notification.notification_details')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>

@stop