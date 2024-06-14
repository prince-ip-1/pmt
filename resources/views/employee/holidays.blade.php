<style type="text/css">
    .card_main{
        text-align: justify;
    }
</style>
@extends('layouts.default')
@section('content')
<div class="main-body">
    
<div class="page-wrapper">
    <!-- Page-header start -->
    @include('includes.breadcrumb')
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <div class="main-timeline">
                            <div class="cd-timeline cd-container">
                                @if(isset($data['holiday']))
                                @foreach($data['holiday'] as $val)
                                <?php 
                                $arr = array('bg-primary','bg-success','bg-info','bg-warning','bg-danger');
                                shuffle($arr);
                                $color = $arr[array_rand($arr)]; ?>
                                <div class="cd-timeline-block">
                                    <div class="cd-timeline-icon {{$color}}">
                                        <i class="icofont icofont-ui-file"></i>
                                    </div>
                                    <!-- cd-timeline-img -->
                                    <div class="cd-timeline-content card_main" style="box-shadow: 0 1px 20px 0 rgb(69 90 100 / 50%);">
                                        <!-- <img src="..\files\assets\images\timeline\img1.jpg" class="img-fluid width-100" alt=""> -->
                                        <div class="p-20">
                                            <h2>{{$val['name']}}</h2>
                                            <h6>{{$val['description']}}</h6>
                                        </div>
                                        <span class="cd-date">{{$val['date']}}</span>
                                    </div>
                                    <!-- cd-timeline-content -->
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- cd-timeline -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-body end -->
</div>
                            
</div>
@stop