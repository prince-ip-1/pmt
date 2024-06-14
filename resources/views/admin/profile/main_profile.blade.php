@extends('layouts.default')
@section('content')
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
     @include('includes.breadcrumb')
     
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <!--profile cover start-->
         <div class="row">
            <div class="col-lg-12">
               <div class="cover-profile">
                  <div class="profile-bg-img">
                     <img class="profile-bg-img img-fluid" src="{{ URL::to('dist/assets\images\user-profile\bg-img1.jpg')}}" alt="bg-img">
                     <div class="card-block user-info">
                        <div class="col-md-12">
                           <div class="media-left">
                              <a href="#" class="profile-image">
                              <img class="user-img img-radius" src="{{ URL::to('dist/assets\images\user-profile\user-img.jpg')}}" alt="user-img">
                              </a>
                           </div>
                           <div class="media-body row">
                              <div class="col-lg-12">
                                 <div class="user-title">
                                    <h2>Josephin Villa</h2>
                                    <span class="text-white">Web designer</span>
                                 </div>
                              </div>
                              <div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--profile cover end-->
         <div class="row">
            <div class="col-lg-12">
               <!-- tab header start -->
               <div class="tab-header card">
                  <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#attendace_info" role="tab">Attendance Info</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#leave" role="tab">Leave</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#salary_info" role="tab">Salary Info</a>
                        <div class="slide"></div>
                     </li>
                  </ul>
               </div>
               <!-- tab header end -->
               <!-- tab content start -->
               <div class="tab-content">
                  <!-- tab panel personal start -->
                  <div class="tab-pane active" id="personal" role="tabpanel">
                     <!-- personal card start -->
                      @include('admin.profile.profile')
                     <!-- personal card end-->
                  </div>
                  <!-- tab pane personal end -->
                  <!-- tab pane attendace_info start -->
                  <div class="tab-pane" id="attendace_info" role="tabpanel">
                     <!-- info card start -->
                     @include('admin.profile.attendance')
                     <!-- info card end -->
                  </div>
                  <!-- tab pane attendace_info end -->
                  <!-- tab pane leave start -->
                  <div class="tab-pane" id="leave" role="tabpanel">
                    @include('admin.profile.leave')
                  </div>
                  <!-- tab pane attendance info end -->
                  <!-- tab pane salary info start -->
                  <div class="tab-pane" id="salary_info" role="tabpanel">
                     
                     @include('admin.profile.salary_slip')
                       
                  </div>
                    <!-- tab pane salary info end -->
               </div>
               <!-- tab content end -->
            </div>
         </div>
      </div>
      <!-- Page-body end -->
   </div>
</div>
</div>
@stop