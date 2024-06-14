@extends('layouts.default')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/\animate.css\css\animate.css')}}">

<div class="main-body">
    <div class="page-wrapper">
        @include('includes.breadcrumb')
        <div class="page-body">
            <div class="row">
                <div class="col-md-6 col-xl-3 animationSandbox" id="">
                                            
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-alert-triangle bg-c-green card1-icon"></i>
                            <span class="text-c-green f-w-600">Android Users</span>
                           
                            <h4>{{ $data['android']}}</h4>
                            
                        </div>
                    </div>
                   
                </div>
                 <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-twitter bg-c-yellow card1-icon"></i>
                            <span class="text-c-yellow f-w-600">iOS Users</span>
                            <h4>{{ $data['ios']}}</h4>
                            
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                            <span class="text-c-yellow f-w-600">Today Web Users</span>
                           <h4>{{ $data['web']}}</h4>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="feather icon-home bg-c-pink card1-icon"></i>
                            <span class="text-c-yellow f-w-600">Today Mobile Users</span>
                            <h4>{{ $data['mobile_users']}}</h4>
                           </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <!-- task, page, download counter  start -->
                                            <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                        <i class="feather icon-alert-triangle bg-c-green card1-icon"></i>
                                                        <span class="text-c-green f-w-600">Total Department</span>
                                                        <a href="{{URL::to('employee/department')}}">
                                                        <h4>{{ $data['department']}}</h4>
                                                         </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                        <i class="feather icon-twitter bg-c-yellow card1-icon"></i>
                                                        <span class="text-c-yellow f-w-600">Total Designation</span>
                                                        <a href="{{URL::to('employee/designation')}}">
                                                        <h4>{{ $data['designation']}}</h4>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                        <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                                                        <span class="text-c-blue f-w-600">Active Employees</span>
                                                        <a href="{{URL::to('employee/employees_list/active')}}">
                                                        <h4>{{ $data['active_employee']}}</h4>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-card-1">
                                                    <div class="card-block-small">
                                                        <i class="feather icon-home bg-c-pink card1-icon"></i>
                                                        <span class="text-c-pink f-w-600">Deactive Employees</span>
                                                        <a href="{{URL::to('employee/employees_list/deactive')}}">
                                                        <h4>{{ $data['deactive_employee']}}</h4>
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                          <div class="col-md-12 col-xl-3 animationSandbox">
                                                <div class="card widget-statstic-card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <h5>Total Project</h5>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                                                        <div class="text-left">
                                                            <h3 class="d-inline-block">{{ $data['project']}}</h3>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
              <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-statstic-card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <h5>Active Projects</h5>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <i class="feather icon-users st-icon bg-c-pink txt-lite-color"></i>
                                                        <div class="text-left">
                                                            <h3 class="d-inline-block">10</h3>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-statstic-card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <h5>Upcoming Projects</h5>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <i class="feather icon-shopping-cart st-icon bg-c-blue"></i>
                                                        <div class="text-left">
                                                            <h3 class="d-inline-block">5</h3>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card widget-statstic-card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <h5>Completed Projects</h5>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <i class="feather icon-shopping-cart st-icon bg-c-green"></i>
                                                        <div class="text-left">
                                                            <h3 class="d-inline-block">5</h3>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                        
                
                <!-- task, page, download counter  end -->

            
                                            <div class="col-md-12 col-xl-3 animationSandbox">
                                                <div class="card bg-c-yellow order-card">
                                                    <a href="{{URL::to('employee/laptop_information')}}">
                                                    <div class="card-block" style="color: white;">
                                                        
                                                        <h6>Total Investment</h6>
                                                        <h2><i class="icofont icofont-cur-rupee"></i>{{$data['systeminfo']}}</h2>
                                                        <p class="m-b-0">System Information</p>
                                                       
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card bg-c-blue order-card">
                                                    <a href="{{URL::to('employee/laptop_information')}}">
                                                    <div class="card-block" style="color: white;">
                                                        <h6>This Year Investment</h6>
                                                        <h2><i class="icofont icofont-cur-rupee"></i>{{$data['curr_year']}}</h2>
                                                        <p class="m-b-0">System Information</p>
                                                       
                                                    </div>
                                                </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card bg-c-green order-card">
                                                    <a href="{{URL::to('employee/laptop_information')}}">
                                                    <div class="card-block" style="color: white;">
                                                        <h6>Laptop Investment</h6>
                                                        <h2 i class="icofont icofont-cur-rupee"></i>{{$data['laptop']}}</h2>
                                                        <p class="m-b-0">System Information </p>
                                                    </div>
                                                </a>
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-xl-3 animationSandbox">
                                                <div class="card bg-c-pink order-card">
                                                    <a href="{{URL::to('employee/mobile_information')}}">
                                                    <div class="card-block" style="color: white;">
                                                        <h6>Mobile Investment</h6>
                                                        <h2><i class="icofont icofont-cur-rupee"></i>{{$data['mobile']}}</h2>
                                                        <p class="m-b-0">System Information</p>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>


            </div>
        </div>
    </div>

   
</div>

@stop