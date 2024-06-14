<div class="col-md-12">
   <!-- Greeting card start -->
   <div class="row">
      <div class="col-md-9 animationSandbox">
           <div class="">
               
             <style>
                .blink {
                    /*animation: blinker 1.5s linear infinite;*/
                    color: white;
                    font-family: "Open Sans" , sans-serif;
                    font-size: 19px;
                    background-color :lightred;
                    text-align:center;
                }
                @keyframes blinker {
                    50% {
                        opacity: 0;
                    }
                }
            </style>
            <body>
              
               <?php
               if($message != ""){ ?>
                 <div class="card borderless-card" style="background-color:red;animation: blinker 1.5s linear infinite;">
                     <div class="card-block caption-breadcrumb">
                <span class="blink"> <b>{{$message}}</b> </span>
                </div>
                </div>
                
              <?php } ?>
         
             
            </body>
            </div>
         <div class="card">
            <div class="card-header" style="margin-bottom: -21px;">
               <h5>{{ date('l, F jS Y')}}</h5>
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><i class="feather icon-minus minimize-card"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-block">
               <span class="d-block text-c-blue f-36" id="greeting"></span>
               <h4> {{session('user_data')->name}}</h4>
            </div>
            <div class="card-footer bg-c-blue">
               <h6 class="text-white m-b-0"></h6>
            </div>
         </div>
         <div class="row">
           
            <div class="col-md-4 animationSandbox">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-disc bg-c-green card1-icon"></i>
                     <span class="text-c-green f-w-600">Present days</span>
                     <h4>{{$data['presentDays']}}</h4>
                  </div>
               </div>
            </div>
           
            <div class="col-md-4 animationSandbox">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-check-circle bg-c-yellow card1-icon"></i>
                     <span class="text-c-yellow f-w-600">Late Entries</span>
                     <h4>{{count($lateEntry)}}</h4>
                  </div>
               </div>
            </div>
             </div>
             <div class="row">
                 <div class="col-md-4 d-none" >
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">Total Leave</span>
                     <h4>{{$howeverManyMonths}}</h4>
                  </div>
               </div>
            </div>
                 
                  <div class="col-md-4 animationSandbox">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-menu bg-c-pink card1-icon"></i>
                     <span class="text-c-pink f-w-600">Total Leave Taken</span>
                     <h4>{{$total_leave_taken}}</h4>
                  </div>
               </div>
            </div>
             <div class="col-md-4" >
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">Leave Balance</span>
                     <h4>{{$data['leave_balance']}}</h4>
                  </div>
               </div>
            </div>
            <div class="col-md-4" >
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">This Month Leave </span>
                        
                     <h4>{{ isset($leave) ? $leave : 0 }}</h4>
                  </div>
               </div>
            </div>
            </div>
            <div class="col-md-4  d-none">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">Assign Project</span>
                     <h4>0</h4>
                  </div>
               </div>
            </div>
            <div class="col-md-4  d-none">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">Assign Project</span>
                     <h4>0</h4>
                  </div>
               </div>
            </div>
        
      </div>
      <div class="col-xl-3 col-md-3">
         @php
         $userdata = Session('user_data');
         $user = EmployeeDetailById($userdata->id);
         $checkin = checkInDetails($userdata->id);
         
         $in = "0";
         $inTxt = "Check In";
         $outTxt = "CheckOut";
         if($checkin->time_in != 0) {
            $in = "1";
            $inTxt = timeformat($checkin->time_in);
         }

         if($checkin->time_in != 0 && $checkin->time_out != 0) {
            $in = "2";
            $inTxt = timeformat($checkin->time_in);
            $outTxt = timeformat($checkin->time_out);
         }
        
         @endphp
         <input type="hidden" value="{{date('m/d/Y')}}" id="date_c">
        
         <div class="card user-card2" >
            <div class="card-block text-center">
                @if(strtotime($checkin->duration) <= strtotime('01:00:00'))
                <div class="risk-rate" >
                    <span style=""><b>0</b></span>
                </div>
               @elseif(strtotime($checkin->duration) <= strtotime('03:00:00'))
               <div class="risk-rate" >
                    <span style="border-left-color: #fe9365;"><b>{{date('H',strtotime($checkin->duration))}}</b></span>
                </div>
               @elseif(strtotime($checkin->duration) >= strtotime('03:00:00') && strtotime($checkin->duration) <= strtotime('06:00:00'))
               <div class="risk-rate">
                    <span  style="border-top-color: #fe9365;border-left-color: #fe9365;"><b>{{date('H',strtotime($checkin->duration))}}</b></span>
                </div>
               @elseif(strtotime($checkin->duration) >= strtotime('06:00:00') && strtotime($checkin->duration) <= strtotime('10:00:00'))
               <div class="risk-rate">
                    <span  style="border-top-color: #fe9365;border-left-color: #fe9365;border-right-color: #fe9365;"><b>{{date('H',strtotime($checkin->duration))}}</b></span>
                </div>
               @endif
               <h6 class="m-b-10 m-t-10">Emp ID : {{ $user->id }}</h6>
               <h6 class="m-b-10 m-t-10">{{ $user->full_name }}</h6>
               <span class="text-c-yellow b-b-warning">{{ $user->designation_name }}</span>
               <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                  <div class="col m-t-15 b-r-default">
                    <button class="btn btn-primary btn-sm btn-round btn-block checkin dCheckin"onclick="getLocation()" data-type="in" id="in" data-val="{{$in}}">{{$inTxt}}</button>
                  </div>
                   <span id="checkin_c" style="display:none;">{{$inTxt}}</span>
                  <div class="col m-t-15">
                    <button class="btn btn-primary btn-sm btn-round btn-block dCheckout" data-type="out" id="out">{{$outTxt}}</button>
                  </div>
               </div>
            </div>
            
            <a href="{{ URL::to('employee/myprofile')}}"><button class="btn btn-warning btn-block">View Profile</button></a> <!--p-t-15 p-b-15-->
         </div>
         <div class="row">
          <div class="col-md-12  d-none">
               <div class="card widget-card-1">
                  <div class="card-block-small">
                     <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                     <span class="text-c-blue f-w-600">Late Entries</span>
                     <h4>{{count($lateEntry)}}</h4>
                  </div>
               </div>
            </div>
        </div>
      </div>

      <!-- Greeting card end -->
   </div>

</div>