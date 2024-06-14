@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
</style>
<input type="hidden" id="table_name" value="reply">
<input type="hidden" value="" name="id" id="id">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->   
      <div class="row">
         @forelse($data['attendance'] as $row)
          <?php 
            $r = rand(0,4);
            
            $arr = array('primary','success','info','warning','danger');
            $color = $arr[$r];
            
            $array = array('lite-green','green','lite-green','yellow','pink');
            $color2 = $array[$r];
            
             ?>
         <div class="col-md-6 col-lg-3">
            <div class="card">

               <div class="card-block user-radial-card">
                 
                  <div data-label="" class="radial-bar radial-bar-100 radial-bar-lg radial-bar-{{$color}}">
                      <img src="{{ getImagePath($row->image,'users')}}" alt="User-Image">
                  </div>
                  <br>
                  @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
                
                @endphp
                  @if(getDepartment() == '1')
                  <a href="{{ URL::to('admin/attendance_details/'.$row->employee_id)}}">
                  <span class="f-36 text-c-{{$color2}}" style="font-size: 20px;">{{$row->full_name}}</span>
                   </a>
                   @elseif(isset($permission[6]->view) && $permission[6]->view == 1)
                       <a href="{{ URL::to('employee/attendance_details/'.$row->employee_id)}}">
                      <span class="f-36 text-c-{{$color2}}" style="font-size: 20px;">{{$row->full_name}}</span>
                   </a>
                   @endif
                  <hr>
                   <p style="font-size: 18px;">{{$row->checkin}}|{{$row->checkout}}</p> <!-- <button class="btn btn-sm btn-primary f-right"><i class="icofont icofont-eye-alt f-20"></i></button> -->
                  <div>
                  
               </div>
               </div>
            </div>
         </div>
         @empty
         <div class="col-md-12">
          <div class="card">
           <div class="card-block user-radial-card">
             No Data Available.
           </div>
          </div>
         </div>
         @endforelse

      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->
@stop