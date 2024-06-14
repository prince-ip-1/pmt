@extends('layouts.default')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        @include('includes.breadcrumb')
        <div class="page-body">
            <div class="row">
            </div>
            <div class="row">
            
            <div class="col-md-12 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6>Total Investment</h6>
                        <h2><i class="icofont icofont-cur-rupee"></i>{{ $data['total']}}</h2>
                        
                        <i class="system-icon fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>
        <h3><b>Total Investment</b></h3>
            <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6>Window</h6>
                        <h2><i class="icofont icofont-cur-rupee"></i>{{ $data['windows']}}</h2>
                        
                        <i class="system-icon fa fa-windows"></i>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6>Mac</h6>
                        <h2><i class="icofont icofont-cur-rupee"></i>{{ $data['mac']}}</h2>
                        
                        <i class="system-icon fa fa-apple"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6>IOS</h6>
                        <h2><i class="icofont icofont-cur-rupee"></i>{{ $data['ios']}}</h2>
                        
                        <i class="system-icon fa fa-apple"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6>Android</h6>
                        <h2><i class="icofont icofont-cur-rupee"></i>{{ $data['android']}}</h2>
                        
                        <i class="system-icon fa fa-android"></i>
                    </div>
                </div>
            </div>
           
            </div>
            <h3><b>Total Devices</b></h3>
            <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6>Windows</h6>
                        <h2>{{ $data['total_windows']}}</h2>
                        
                        <i class="system-icon fa fa-windows"></i>
                    </div>
                </div>
            </div>
             <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6>Mac</h6>
                        <h2>{{ $data['total_mac']}}</h2>
                        
                        <i class="system-icon fa fa-apple"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6>IOS</h6>
                        <h2>{{ $data['total_ios']}}</h2>
                        
                        <i class="system-icon fa fa-apple"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-pink order-card">
                    <div class="card-block">
                        <h6>Android</h6>
                        <h2>{{ $data['total_android']}}</h2>
                        
                        <i class="system-icon fa fa-android"></i>
                    </div>
                </div>
            </div>
           
            </div>
        </div>
    </div>

   
</div>
@stop