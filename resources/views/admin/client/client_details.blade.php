@extends('layouts.default')
@section('content')
<style>
.btn i {
    margin-right: 0px;
}
.logo{
   margin-bottom:0px;
}
/*.logo-empty{*/
/*   margin-bottom:2px;*/
/*}*/
.m-l-4{
    margin-left:4px;
}
.img-radius{
    width: 60px;
    height: 60px;
}
</style>
<div class="main-body">
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-body start -->
      <div class="content social-timeline">
         <input type="hidden" name="client_id" id="client_id" value="{{$data['client_details']->id}}">
         <div class="">
            <!-- Row Starts -->
           
         </div>
         <!-- Row end -->
         <!-- Row Starts -->
         <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
               <!-- Social timeline left start -->
               <div class="social-timeline-left" style="top: 20px!important;width:-webkit-fill-available">
                  <!-- social-profile card start -->
                  <div class="card" >
                     
                          <div class="card-header contact-user" style="display:flex;">
                              <div class="">
                            <img class="img-radius " src="{{getImagePath($data['client_details']->image,'clients')}}" alt="">
                            </div>
                            <div class="">
                           <h5 class="ml-4">{{$data['client_details']->firstname}}&nbsp;{{$data['client_details']->lastname}} <br><span style="color:#000000;">{{$data['client_details']->country_name}}</span></h5>
                          </div>
                        </div>
                     @php
                     if(!empty($data['client_details']->contact_no) || !empty($data['client_details']->email) || !empty($data['client_details']->skype) || !empty($data['client_details']->linkedin) )
                     {
                     $class = "logo";
                     }
                     else{
                     $class="logo-empty";
                     }
                     @endphp
                     <div class="card-block social-follower {{$class}}" style="padding:0.25rem;height:82px;">
                        
                    
                        <div class="row follower-counter  " style="margin-right: 3px;margin-top: inherit;margin-block:28px;">
                            
                          @if(!empty($data['client_details']->contact_no))
                           <div class="col-3">
                              
                              <a target="_blank" href="https://web.whatsapp.com/"><button class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Whatsapp"><i class="icofont icofont-social-whatsapp"></i></button></a>
                           
                           </div>
                          @endif
                            @if(!empty($data['client_details']->email))
                           <div class="col-3">
                              
                              <a target="_blank" href="https://mail.google.com/mail/u/0/#inbox"><button class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="Send Email"><i class="icofont icofont-send-mail"></i></button></a>
                            
                           </div>
                          @endif
                             @if(!empty($data['client_details']->skype))
                           <div class="col-3">
                              
                              <a target="_blank" href="https://{{$data['client_details']->skype}}"><button class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="Skype"><i class="icofont icofont-social-skype"></i></button></a>
                          
                           </div>
                            @endif
                             @if(!empty($data['client_details']->linkedin))
                           <div class="col-3">
                               
                              <a target="_blank" href="{{$data['client_details']->linkedin}}"><button class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="icofont icofont-social-linkedin"></i></button></a>
                           
                           </div>
                           @endif
                        </div>
                        
                     </div>
                  </div>
                  <!-- social-profile card end -->
                  <!-- Who to follow card start -->
                  <div class="card d-none">
                     <div class="card-header">
                        <h5 class="card-header-text">Who to follow</h5>
                     </div>
                     <div class="card-block user-box">
                        <div class="media m-b-10">
                           <a class="media-left" href="#!">
                              <!--<img class="media-object img-radius" src="..\files\assets\images\avatar-1.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">-->
                              <div class="live-status bg-danger"></div>
                           </a>
                           <div class="media-body">
                              <div class="chat-header">Josephin Doe</div>
                              <div class="text-muted social-designation">Softwear Engineer</div>
                           </div>
                        </div>
                        <div class="media m-b-10">
                           <a class="media-left" href="#!">
                              <!--<img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">-->
                              <div class="live-status bg-success"></div>
                           </a>
                           <div class="media-body">
                              <div class="chat-header">Josephin Doe</div>
                              <div class="text-muted social-designation">Softwear Engineer</div>
                           </div>
                        </div>
                        <div class="media m-b-10">
                           <a class="media-left" href="#!">
                              <!--<img class="media-object img-radius" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">-->
                              <div class="live-status bg-danger"></div>
                           </a>
                           <div class="media-body">
                              <div class="chat-header">Josephin Doe</div>
                              <div class="text-muted social-designation">Softwear Engineer</div>
                           </div>
                        </div>
                        <div class="media m-b-10">
                           <a class="media-left" href="#!">
                              <!--<img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image" data-toggle="tooltip" data-placement="top" title="user image">-->
                              <div class="live-status bg-success"></div>
                           </a>
                           <div class="media-body">
                              <div class="chat-header">Josephin Doe</div>
                              <div class="text-muted social-designation">Softwear Engineer</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Who to follow card end -->
                  <!-- Friends card start -->
                  <div class="card d-none">
                     <div class="card-header">
                        <h5 class="card-header-text d-inline-block">Friends</h5>
                        <!-- <span class="friend-more f-right">see 12 more</span> -->
                        <span class="label label-primary f-right"> See 12 More </span>
                     </div>
                     <div class="card-block friend-box">
                        <!--<img class="media-object img-radius" src="..\files\assets\images\avatar-1.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-3.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-4.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-1.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-4.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-3.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                        <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">-->
                     </div>
                  </div>
                  <!-- Friends card end -->
               </div>
               <!-- Social timeline left end -->
            </div>
            <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
               <!-- Nav tabs -->
              
                <div class="row">
               <div class="col-md-6 col-xl-4 animationSandbox" id="">
                  <div class="card widget-card-1">
                     <div class="card-block-small">
                        <i class="feather icon-alert-triangle bg-c-green card1-icon"></i>
                        <span class="text-c-green f-w-600">Total Project</span>
                        <span>
                           <h4>{{$data['total_project']}}</h4>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-4 animationSandbox">
                  <div class="card widget-card-1">
                     <div class="card-block-small">
                        <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                        <span class="text-c-blue f-w-600">Total Revenue</span>
                        <span>
                           <h4>{{$data['total_revenue']}}</h4>
                       </span>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-4 animationSandbox">
                  <div class="card widget-card-1">
                     <div class="card-block-small">
                        <i class="feather icon-home bg-c-pink card1-icon"></i>
                        <span class="text-c-pink f-w-600">Project Technology</span>
                        <span>
                           <h4>{{$data['total_technology']}}</h4>
                       </span>
                     </div>
                  </div>
               </div>
            </div>
               <div class="card social-tabs">
                  <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                     <li class="nav-item ">
                        <a class="nav-link active" data-toggle="tab" href="#about" role="tab">About</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#contact" role="tab">Contact</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#description" role="tab">Description</a>
                        <div class="slide"></div>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#projects" role="tab">Projects</a>
                        <div class="slide"></div>
                     </li>
                  </ul>
               </div>
              
               </div>
               <!-- Row end -->
               
               </div>
               <div class="row">
                 <!-- Tab panes -->
                 <div class="col-xl-12 col-lg-8 col-md-8 col-xs-12 ">
               <div class="tab-content">
                  <!-- About tab start -->
                     @include('admin.client._about')
                  <!-- About tab end -->
                  <!-- Contact tab start -->
                  <div class="tab-pane " id="contact">
                     @include('admin.client._contact')
                  </div>
                  <!-- Contact tab end -->
                  <!-- Description tab start -->
                  <div class="tab-pane" id="description">
                        @include('admin.client._description')
                  </div>
                  <!-- Description tab end -->
                  <!-- Project tab start -->
                  <div class="tab-pane" id="projects">
                     @include('admin.client._projects')
                  </div>
                  </div>
                  <!-- Project tab end -->
            </div>
         </div>
      </div>
   </div>
   <!-- Page-body end -->
</div>
</div>
@stop