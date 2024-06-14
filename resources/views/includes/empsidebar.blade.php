@php
    $userdata = Session('user_data');
@endphp
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->is('employee/dashboard') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/dashboard')}}">
                    <span class="pcoded-micon"><i class="fa fa-tachometer"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                
            </li>
             <li class="{{ request()->is('employee/checkin') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/checkin')}}">
                    <span class="pcoded-micon"><i class="fa fa-check-square-o"></i><b>A</b></span>
                    <span class="pcoded-mtext">Checkin</span>
                </a>
            </li>
             <li class="{{ request()->is('employee/projects_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/projects_list')}}">
                    <span class="pcoded-micon"><i class="feather icon-box"></i><b>A</b></span>
                    <span class="pcoded-mtext">Projects</span>
                </a>
            </li>
            <li class="{{ request()->is('employee/tasks_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/tasks_list')}}">
                    <span class="pcoded-micon"><i class="fa fa-tasks"></i><b>A</b></span>
                    <span class="pcoded-mtext">Tasks</span>
                </a>
            </li>
             <li class="{{ $data['sidebar'] == 'Attendance' ? 'active' : '' }}">
                <a href="{{ URL::to('employee/attendance_details/'.$userdata->id)}}">
                    <span class="pcoded-micon"><i class="fa fa-calendar"></i></span>
                    <span class="pcoded-mtext">Attendance</span>
                </a>
            </li>
             <li class="{{ request()->is('employee/leave_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/leave_list')}}">
                    <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                    <span class="pcoded-mtext">Leave</span>
                </a>
            </li>
            <!-- <li>
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Project</span>
                </a>
            </li> -->
             <li class="{{ request()->is('employee/salary_details') ? 'active' : '' }} ">
                <a href="{{ URL::to('employee/salary_details')}}">
                    <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                    <span class="pcoded-mtext">Salary</span>
                </a>
            </li>
             <li class="{{ request()->is('employee/holidays_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/holidays_list')}}">
                    <span class="pcoded-micon"><img alt="holiday" src="{{URL::to('dist/assets/images/holiday.png')}}" width="18"></span>
                    <span class="pcoded-mtext">Holiday List</span>
                </a>
            </li>
            <li class="{{ request()->is('employee/notification_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/notification_list')}}">
                    <span class="pcoded-micon"><i class="fa fa-bell"></i></span>
                    <span class="pcoded-mtext">Notification List</span>
                </a>
            </li>
             <li class="{{ request()->is('employee/interview_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/interview_list')}}">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Interview List</span>
                </a>
            </li>
            <li class="{{ request()->is('employee/feedback') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/feedback')}}">
                   <span class="pcoded-micon"><i class="fa fa-th-large"></i><b>F</b></span>
                    <span class="pcoded-mtext">Feedback</span>
                </a>
            </li>
             <li class="">
                <a href="{{ URL::to('logout')}}">
                    <span class="pcoded-micon"><i class="fa fa-sign-out"></i></span>
                    <span class="pcoded-mtext">Logout</span>
                </a>
                
            </li>
           <!--  <li>
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Task</span>
                </a>
            </li> -->
            <!--  <li>
                <a href="#">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Notification</span>
                </a>
            </li> -->
        </ul>
        
    </div>
</nav>