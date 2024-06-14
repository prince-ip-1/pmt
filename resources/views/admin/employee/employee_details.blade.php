@extends('layouts.default')

@section('content')
<style>
    .separator {
      /*display: inline-block;*/
      /*position: relative;*/
    }
    .separator:before {
      content: url(https://www.pmt.bluepixeltech.com/public/dist/assets/images/bluepixel_white.png);
      position: absolute;
      /*width:20px;*/
      top:10px;
      right: 25px;
      margin: 0;
      padding: 0;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }
    .md-tabs .nav-item {
        width: calc(100% / 5) !important;
        text-align: center;
    }
    .nav-tabs .slide {
        width: calc(100% / 5) !important;
    }
   .blur-bg{
        filter: blur(10px);
  }
  
</style>


<div class="main-body">

    <div class="page-wrapper">

        @include('includes.breadcrumb')

         <div class="page-body">

         <!--profile cover start-->
         @include('admin.employee.profile_cover')
         <!--profile cover end-->

         <div class="row">

            <div class="col-lg-12">

               <!-- tab header start -->

               <div class="tab-header card">

                  <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">

                     <li class="nav-item">

                        <a class="nav-link tab active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>

                        <div class="slide"></div>

                     </li>
                     
                    

                     <li class="nav-item">

                        <a class="nav-link tab" data-toggle="tab" href="#attendace_info" role="tab">Attendance Info</a>

                        <div class="slide"></div>

                     </li>

                     <li class="nav-item">

                        <a class="nav-link tab" data-toggle="tab" href="#leave" role="tab">Leave Info</a>

                        <div class="slide"></div>

                     </li>
                     @php
                     if(getDepartment() == 1){
                         $class = "";
                     }else{
                         $class="salaryinfo";
                     }
                     @endphp
                     <li class="nav-item">

                        <a class="nav-link {{$class }} salaryInfo" data-toggle="tab" href="#salary_info" role="tab">Salary Info</a>
                    
                        <div class="slide"></div>

                     </li>
                      <li class="nav-item">

                        <a class="nav-link tab {{$class}}" data-toggle="tab" href="#official" role="tab">Official Info</a>

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

                      @include('admin.employee.profile')

                     <!-- personal card end-->

                  </div>

                  <!-- tab pane personal end -->

                  <!-- tab pane attendace_info start -->
                  
                  <div class="tab-pane" id="official" role="tabpanel">

                     <!-- personal card start -->

                      @include('admin.employee.office_info')

                     <!-- personal card end-->

                  </div>

                  <div class="tab-pane" id="attendace_info" role="tabpanel">

                     <!-- info card start -->

                     @include('admin.employee.attendance')

                     <!-- info card end -->

                  </div>

                  <!-- tab pane attendace_info end -->

                  <!-- tab pane leave start -->

                  <div class="tab-pane" id="leave" role="tabpanel">

                    @include('admin.employee.leave')

                  </div>

                  <!-- tab pane attendance info end -->

                  <!-- tab pane salary info start -->

                  <div class="tab-pane salaryInfo" id="salary_info" role="tabpanel">

                     

                     @include('admin.employee.salary_slip')

                       

                  </div>

                    <!-- tab pane salary info end -->

               </div>

               <!-- tab content end -->

            </div>

         </div>

      </div>

        

    </div>
 <!-- Lock screen start -->
 @include('admin.employee.pin')
  <!-- Lock screen end -->
@stop