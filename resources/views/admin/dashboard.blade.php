@extends('layouts.default')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        @include('includes.breadcrumb')
        <div class="page-body">
            <div class="row">
            @include('includes.admin_dashboard_message')
                <div class="col-md-6 col-lg-3">
                                                <div class="card statustic-card">
                                                    <div class="card-header" style="margin-bottom: -21px;">
                                                        <h5>Today's Present Employees</h5>
                                                         <div class="card-header-right">
                                                        <ul class="list-unstyled card-option">
                                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                     <div class="card-block text-center">
                                                        <a href="{{URL::to('admin/attendance_list')}}">
                                                        <span class="d-block text-c-blue f-36">{{$data['present_employee']}}</span>
                                                        </a>
                                                        <h4>Total</h4>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-c-blue" style="width:{{$data['progress_bar']}}%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                    </div>
                                                </div>
                                            </div>
            </div>
             @if(!empty($data['employee_birthday']))
            <div class="row">
            <!-- Birthday section start-->
                <div class="col-xl-4 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>This Month's Birthdays</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        @foreach($data['employee_birthday'] as $row)
                                                         <?php 
                                $arr = array('green','pink','yellow','blue');
                                shuffle($arr);
                                $color = $arr[array_rand($arr)]; ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <img src="{{getImagePath($row->image,'users')}}" alt="" class="img-radius img-40 align-top m-r-15">
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-c-{{$color}}"><b>{{$row->full_name}}</b></h6>
                                                                <p class=" m-b-0">{{dateformat($row->dob)}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>

                                            </div>
            <!-- Birthday section end -->
             <!-- Work anniversary section start -->
            @if(!empty($data['employee_joining']))
            <div class="col-xl-4 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>This Month's Work Anniversary</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        @foreach($data['employee_joining'] as $row)
                                                         <?php 
                                $arr = array('green','pink','yellow','blue');
                                shuffle($arr);
                                $color = $arr[array_rand($arr)]; ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <img src="{{getImagePath($row->image,'users')}}" alt="" class="img-radius img-40 align-top m-r-15">
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-c-{{$color}}"><b>{{$row->full_name}}</b></h6>
                                                                <p class=" m-b-0">{{dateformat($row->join_date)}}  ({{date_difference($row->join_date)}})</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>

                    </div>
            @endif
            <!-- Work anniversary section end -->
            </div>
            @endif
             @if(!empty($data['employee_upcomming_birthday']))
            <div class="row">
            <!-- Birthday section start-->
                <div class="col-xl-4 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>Next Month's Birthdays</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        @foreach($data['employee_upcomming_birthday'] as $row)
                                                         <?php 
                                $arr = array('green','pink','yellow','blue');
                                shuffle($arr);
                                $color = $arr[array_rand($arr)]; ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <img src="{{getImagePath($row->image,'users')}}" alt="" class="img-radius img-40 align-top m-r-15">
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-c-{{$color}}"><b>{{$row->full_name}}</b></h6>
                                                                <p class=" m-b-0">{{dateformat($row->dob)}}</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>

                                            </div>
            <!-- Birthday section end -->
             <!-- Work anniversary section start -->
            @if(!empty($data['employee_upcomming_joining']))
            <div class="col-xl-4 col-md-12">
                                                <div class="card feed-card">
                                                    <div class="card-header">
                                                        <h5>Next Month's Work Anniversary</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        @foreach($data['employee_upcomming_joining'] as $row)
                                                         <?php 
                                $arr = array('green','pink','yellow','blue');
                                shuffle($arr);
                                $color = $arr[array_rand($arr)]; ?>
                                                        <div class="row m-b-25">
                                                            <div class="col-auto p-r-0">
                                                                <img src="{{getImagePath($row->image,'users')}}" alt="" class="img-radius img-40 align-top m-r-15">
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-c-{{$color}}"><b>{{$row->full_name}}</b></h6>
                                                                <p class=" m-b-0">{{dateformat($row->join_date)}}  ({{date_difference($row->join_date)}})</p>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>

                    </div>
            @endif
            <!-- Work anniversary section end -->
            </div>
            @endif
        </div>
    </div>

   
</div>
@stop