@extends('layouts.default')
@section('content')
<style type="text/css">
    .disabled {
        cursor: not-allowed;
        background-color: #BBD2CF;
        border-color: #BBD2CF;
        color: #fff;
        -webkit-transition: all ease-in 0.3s;
        transition: all ease-in 0.3s;
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
            <div class="row">
                <div class="col-xl-6 col-lg-6 animationSandbox">
                    <div class="card">
                        <div class="card-block text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="feather icon-clock text-c-lite-green d-block f-20"></i>
                                    <div class="label-main">
                                    <input type="hidden" id="remaining_time" value="{{$data['remaining_time']}}">
                                        <input type="hidden" id="current_time" value="{{$data['current_time']}}">
                                        <h1 class="m-t-15 rTime" id="displayTime">{{$data['remainTime']}}</h1>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6 animationSandbox">
                                    <?php
                                        $checkin = "0";
                                        $break = "0";

                                        if(!empty($data['checkinData'])) {
                                            $checkin = "1";
                                        }
                                        if(!empty($data['checkBr']) && $data['checkBr']->time_out == "") {
                                            $break = "1";
                                        }

                                        if(!empty($data['checkinData']) && $data['checkinData']->time_out != NULL) {
                                            $checkin = "2";
                                            $break = "2";
                                        }
                                    ?>
                                    <button class="btn btn-primary btn-round btn-block checkin" data-type="in" onclick="getLocation()" id="in" data-val="{{$checkin}}">Check In</button><br>
                                    <button class="btn btn-primary btn-round btn-block" data-type="out" id="out">Check Out</button>
                                </div>
                            </div>
                            <!-- <p class="m-b-20">Your main list is growing</p> -->
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 animationSandbox">
                    <div class="card">
                        <div class="card-block text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="feather icon-clock text-c-lite-green d-block f-20"></i>
                                    <h1 class="m-t-15" id="breakTime">{{$data['totalBreak']}}</h1>
                                    <input type="hidden" id="breakDr" value="{{$data['currentBreakDr']}}">
                                    <input type="hidden" id="breakPre" value="{{$data['prevBreakHr']}}">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block btn-round break" data-type="bin" id="bin" data-val="{{$break}}">Break In</button><br>
                                    <button class="btn btn-primary btn-block btn-round break" data-type="bout" id="bout">Break Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-xl-3 col-md-6 animationSandbox">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div data-label="50%" class="radial-bar radial-bar-90 radial-bar-lg radial-bar-danger">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div><button class="btn btn-primary btn-round">Primary Button</button></div>
                                    <div><button class="btn btn-primary btn-round">Primary Button</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-6 animationSandbox">
                    <div class="card">
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-styling">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Sr No</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                     @if(!empty($data['checkinData']->date))
                                     <input type="hidden" value="{{date('m/d/Y',strtotime($data['checkinData']->date))}}" id="date_c">
                                       @endif
                                    <tbody id="checkinRow">
                                   
                                        <tr>
                                            <th scope="row">1</th>
                                            <td id="checkin_c">{{isset($data['checkinData']->time_in) ? timeformat($data['checkinData']->time_in) : "-"}}</td>
                                            <td class="checkOutTime">{{isset($data['checkinData']->time_out) ? timeformat($data['checkinData']->time_out) : "-"}}</td>
                                            <td>{{isset($data['checkinData']->date) ? dateformat($data['checkinData']->date) : "-"}}</td>
                                            <td id="duration_c">{{$data['duration']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 animationSandbox">
                    <div class="card">
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table table-styling" id="break">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Sr No</th>
                                            <th>Break In</th>
                                            <th>Break Out</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody id="breakRow">
                                            <?php $i = 1; ?>
                                            @foreach($data['break'] as $b)
                                            <?php
                                                $e = date('H:i');
                                                if($b['time_out'] != "") {
                                                    $e = Carbon\Carbon::parse($b['time_out']);
                                                }
                                                $s = Carbon\Carbon::parse($b['time_in']);

                                                $dur =  $s->diff($e)->format('%H:%I:%S');
                                            ?>
                                            <tr>
                                                <th scope="row">{{$i++}}</th>
                                                <td>{{timeformat($b['time_in'])}}</td>
                                                <td class="timeOut">{{isset($b['time_out']) ? timeformat($b['time_out']) : '-'}}</td>
                                                <td>{{dateformat($b['date'])}}</td>
                                                <td>{{$dur}}</td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 function getLocation() {
       
        navigator.permissions.query({
             name: 'geolocation'
         }).then(function(result) {
             if (result.state == 'granted') {
                 report(result.state);
                 geoBtn.style.display = 'none';
             } else if (result.state == 'prompt') {
                 report(result.state);
                 geoBtn.style.display = 'none';
        
                 navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, geoSettings);
             } else if (result.state == 'denied') {
                 report(result.state);
                 geoBtn.style.display = 'inline';
             }
             result.onchange = function() {
                 report(result.state);
             }
         });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
    }
    function report(state) {
      console.log('Permission ' + state);
    }
    function showPosition(position) {
        console.log(position);
        const cars = ["Latitude:"+position.coords.latitude,"Longitude:"+position.coords.longitude,"accuracy:"+position.coords.accuracy];
        console.log(cars);
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;
        $.ajax({
            type: "post",
            url: "{{URL::to('saveCheckin')}}",
            data: {_token:'{{csrf_token()}}',type:$('#in').attr('data-type'),lat:lat,long:long,accuracy:accuracy},
            success: function (res) {
              if(res.status){
                var data = res.data;
                alertMessage('success',res.message);

                $('#in').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                $('#out').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
                $('#checkinRow').html('<tr><td>1</td><td>'+data.time_in+'</td><td>-</td><td>'+data.date+'</td><td>'+res.duration+'</td></tr>');
                $('.dCheckin').text(data.time_in);
                window.location.reload();
              } else {
                alertMessage('error',res.message);
              }
            }         
        });
        
        

    }
</script>
@stop