 @php
    $usersession = Session('user_data');
    $userdata = EmployeeDetailById($usersession->id);
    if($usersession->department_id == 1){
        $url = URL::to('admin/notification_list');
    }else{
        $url = URL::to('employee/notification_list');
    }
    @endphp
    <style>
 .dropdown-menu a:hover {
    background-color: #f1f1f1!important;
    
}
    </style>
<nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)">
                            <i class="feather icon-menu"></i>
                        </a>

                            @if($usersession->department_id == 1)
                             <a href="{{ URL::to('admin/dashboard')}}">
                            @else
                             <a href="{{ URL::to('employee/dashboard')}}">
                            @endif
                            <!--<img class="img-fluid" src="{{URL::to('dist\assets\images\logo.png')}}" alt="Theme-Logo">-->
                            <img class="img-fluid logo-image" src="{{AdminLogo(1)}}" alt="Bluepixel">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                       
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <!-- <span class="badge bg-c-pink">{{GetTableRowCount('notification_list',['read_status'=>0,'receiver_id'=>$usersession->id])}}</span> -->
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6><!-- <a href="{{ URL::to('employee/notification_list')}}">
                                            <label class="label label-danger">View All</label>
                                        </a> -->
                                        </li>
                                        @php
                                        $notification = GetNotificationList($usersession->id);
                                     
                                        @endphp
                                        @if(!empty($notification))
                                        @foreach($notification as $row)
                                       
                                        <li style="    padding: 0em 20px;" class="read-notification" data-id="{{$row->id}}">
                                      <!--   <a href="{{URL::to('admin/leave/allleave')}}"> -->
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius" src="{{getImagePath($row->image,'users')}}" alt="User">
                                                <div class="media-body">
                                                    <h5 class="notification-user " style="display:inline">{{$row->title}}</h5>
                                                    <span class="notification-time" style="float: right;">{{ get_timeago($row->created_at)}}</span>
                                                    <p class="notification-msg">{{$row->message}}</p>
                                                   
                                                </div>
                                            </div>
                                       <!--  </a> -->
                                        </li>
                                       @endforeach
                                       <li style="    text-align: center;">
                                      <a href="{{ $url }}"><h5 class="notification-user " style="display:inline">View All</h5></a>
                                       </li>
                                       @else
                                       <li>
                                       <p>No Notification</p>
                                       </li>
                                       @endif
                                    </ul>
                                </div>
                            </li>
                           
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                  
                                       <img src="{{ getImagePath($userdata->image,'users')}}" style="height: 30px;object-fit: cover;" class="img-radius" alt="User-Profile-Image">
                                        <span>{{ $userdata->full_name }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="{{ URL::to('admin/company_profile')}}">
                                                <i class="feather icon-user"></i>Company Profile
                                            </a>
                                        </li>
                                        <li>
                                            @if(session('user_data')->department_id == 1)
                                                <a href="{{ URL::to('admin/myprofile')}}">
                                                <i class="feather icon-user"></i>My Profile
                                            </a>
                                            @else
                                            <a href="{{ URL::to('employee/myprofile')}}">
                                                <i class="feather icon-user"></i>My Profile
                                            </a>
                                            @endif
                                            
                                        </li>
                                         <li>

                                            <a href="javascript:void(0)"  class="md-trigger" data-modal="modal-c">
                                                <i class="feather icon-lock" ></i>Change Password
                                            </a>

                                        </li>
                                        <li>
                                            <a href="{{ URL::to('logout')}}">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
</nav>
