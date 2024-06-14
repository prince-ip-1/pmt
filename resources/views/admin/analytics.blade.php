@extends('layouts.default')
@section('content')
<!-- animation css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/\animate.css\css\animate.css')}}">
<!-- Custom js -->
    <!-- <script type="text/javascript" src="{{URL::to('dist/assets\js\animation.js')}}"></script> -->
<div class="main-body">
    <div class="page-wrapper">
        @include('includes.breadcrumb')
        <div class="page-body">
            <div class="row">
                <div class="col-md-6 col-xl-3 animationSandbox" id="">
                                            
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="fa fa-android bg-c-green card1-icon"></i>
                        <span class="text-c-green f-w-600">Android Users</span>
                        <a href="{{URL::to('admin/department')}}">
                        <h4>{{ $data['android']}}</h4>
                         </a>
                    </div>
                </div>
               
            </div>
             <div class="col-md-6 col-xl-3 animationSandbox">
                <div class="card widget-card-1">
                    <div class="card-block-small">
                        <i class="fa fa-apple bg-c-yellow card1-icon"></i>
                        <span class="text-c-yellow f-w-600">iOS Users</span>
                        <a href="{{URL::to('admin/designation')}}">
                        <h4>{{ $data['ios']}}</h4>
                        </a>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fas fa-globe bg-c-blue card1-icon"></i>
                            <span class="text-c-yellow f-w-600">Today Web Users</span>
                            <!--<a href="{{URL::to('admin/designation')}}">-->
                            <h4>{{ $data['web']}}</h4>
                            <!--</a>-->
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fa fa-mobile bg-c-pink card1-icon"></i>
                            <span class="text-c-yellow f-w-600">Today Mobile Users</span>
                            <!--<a href="{{URL::to('admin/designation')}}">-->
                            <h4>{{ $data['mobile_users']}}</h4>
                            <!--</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <!-- task, page, download counter  start -->
                
                                           
                <div class="col-md-6 col-xl-3 animationSandbox" id="">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fa fa-sitemap bg-c-green card1-icon"></i>
                            <span class="text-c-green f-w-600">Total Department</span>
                            <a href="{{URL::to('admin/department')}}">
                            <h4>{{ $data['department']}}</h4>
                             </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fa fa-id-card-o bg-c-yellow card1-icon"></i>
                            <span class="text-c-yellow f-w-600">Total Designation</span>
                            <a href="{{URL::to('admin/designation')}}">
                            <h4>{{ $data['designation']}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fa fa-user bg-c-blue card1-icon"></i>
                            <span class="text-c-blue f-w-600">Active Employees</span>
                            <a href="{{URL::to('admin/employees_list/active')}}">
                            <h4>{{ $data['active_employee']}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card widget-card-1">
                        <div class="card-block-small">
                            <i class="fa fa-user-times bg-c-pink card1-icon"></i>
                            <span class="text-c-pink f-w-600">Deactive Employees</span>
                            <a href="{{URL::to('admin/employees_list?status=deactive')}}">
                            <h4>{{ $data['deactive_employee']}}</h4>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3 animationSandbox d-none">
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
              <div class="col-md-6 col-xl-3 animationSandbox d-none">
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
                <div class="col-md-6 col-xl-3 animationSandbox d-none">
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
               <div class="col-md-6 col-xl-3 animationSandbox d-none">
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
                        <a href="{{URL::to('admin/laptop_information')}}">
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
                        <a href="{{URL::to('admin/laptop_information')}}">
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
                        <a href="{{URL::to('admin/laptop_information')}}">
                        <div class="card-block" style="color: white;">
                            <h6>Laptop Investment</h6>
                            <h2><i class="icofont icofont-cur-rupee"></i>{{$data['laptop']}}</h2>
                            <p class="m-b-0">System Information </p>
                        </div>
                    </a>
                    </div>
                </div>
                 <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card bg-c-pink order-card">
                        <a href="{{URL::to('admin/mobile_information')}}">
                        <div class="card-block" style="color: white;">
                            <h6>Mobile Investment</h6>
                            <h2><i class="icofont icofont-cur-rupee"></i>{{$data['mobile']}}</h2>
                            <p class="m-b-0">System Information</p>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card bg-c-green order-card">
                        <a href="{{URL::to('admin/list_other_expense')}}">
                        <div class="card-block" style="color: white;">
                            <h6>Annual Expenses</h6>
                            <h2><i class="icofont icofont-cur-rupee"></i>{{$data['annual_expense']}}</h2>
                            <p class="m-b-0">Other Expenses</p>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3 animationSandbox">
                    <div class="card bg-c-orenge order-card">
                        <a href="{{URL::to('admin/list_other_expense')}}?type=monthly">
                        <div class="card-block" style="color: white;">
                            <h6>Monthly Expenses</h6>
                            <h2><i class="icofont icofont-cur-rupee"></i>{{$data['monthly_expense']}}</h2>
                            <p class="m-b-0">Other Expenses</p>
                        </div>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>

   
</div>

@stop