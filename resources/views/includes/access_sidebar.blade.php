@php
$usersession = Session('user_data');
$userdata = EmployeeDetailById($usersession->id);
$permission = $userdata->permissions;
//p($permission,0);
@endphp
<nav class="pcoded-navbar">
   <div class="pcoded-inner-navbar main-menu">
      <div class="pcoded-navigatio-lavel">Menu</span></div>
      <ul class="pcoded-item pcoded-left-item">
      
      <!-- employee side -->
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
       <li class="{{ $data['sidebar'] == 'Attendance' ? 'active' : '' }}">
         <a href="{{ URL::to('employee/attendance_details/'.$userdata->id)}}">
             <span class="pcoded-micon"><i class="fa fa-calendar"></i></span>
             <span class="pcoded-mtext">Attendance Info</span>
         </a>
         </li>
      <li class="{{ request()->is('employee/leave_list') ? 'active' : '' }}">
         <a href="{{ URL::to('employee/leave_list')}}">
         <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
         <span class="pcoded-mtext">Leave Info</span>
         </a>
      </li>
      <li class="{{ request()->is('employee/salary_details') ? 'active' : '' }}">
         <a href="{{ URL::to('employee/salary_details')}}">
         <span class="pcoded-micon"><i class="fa fa-money"></i></span>
         <span class="pcoded-mtext">Salary Info</span>
         </a>
      </li>
      <li class="{{ request()->is('employee/holidays_list') ? 'active' : '' }}">
         <a href="{{ URL::to('employee/holidays_list')}}">
         <span class="pcoded-micon"><img alt="holiday" src="{{URL::to('dist/assets/images/holiday.png')}}" width="18"></span>
         <span class="pcoded-mtext">Holiday List</span>
         </a>
      </li>
      <li class="{{ request()->is('employee/interview_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/interview_list')}}">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Interview List</span>
                </a>
            </li>
           
            <li class="{{ request()->is('employee/feedback') ? 'active' : ''  }}">
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
      <div class="pcoded-navigatio-lavel">Role Permission</div>
          @if(isset($permission[16]))
            <li class="{{ $data['sidebar']== 'Dashboard' ? 'active' : ''  }}">
                <a href="{{ URL::to('employee/admin_dashboard')}}">
                    <span class="pcoded-micon"><i class="fa fa-tachometer"></i></span>
                    <span class="pcoded-mtext">Admin Dashboard</span>
                </a>
                
            </li>
          @endif
          @if(isset($permission[17]))
            <li class="{{ $data['sidebar']== 'Analytics' ? 'active' : ''  }}">
                <a href="{{ URL::to('employee/analytics')}}">
                    <span class="pcoded-micon"><i class="fa fa-line-chart"></i></span>
                    <span class="pcoded-mtext">Analytics</span>
                </a>
                
            </li>
          @endif
         
            
      @if(isset($permission[2]))
      <div class="pcoded-navigatio-lavel">Employee</div>
      <li class="pcoded-hasmenu  {{ $data['sidebar']== 'Employee' ? 'active pcoded-trigger' : ''  }}">
         <a href="javascript:void(0)">
         <span class="pcoded-micon"><i class="fa fa-users"></i></span>
         <span class="pcoded-mtext">Employees</span>
         </a>
         <ul class="pcoded-submenu">
            @if(isset($permission[2]->view) && $permission[2]->view == 1)
            <li class="{{ request()->is('employee/employees_list') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/employees_list')}}">
               <span class="pcoded-mtext">List</span>
               </a>
            </li>
            @endif
            @if(isset($permission[2]->add) && $permission[2]->add == 1)
            <li class="{{ request()->is('employee/add_employee') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/add_employee')}}">
               <span class="pcoded-mtext">Add</span>
               </a>
            </li>
            @endif
         </ul>
      </li>
      @endif
     
      @if(isset($permission[3]) || isset($permission[4]) || isset($permission[5]) || isset($permission[6]) || isset($permission[7]) || isset($permission[9]) || isset($permission[14]))
      <div class="pcoded-navigatio-lavel">HR</div>
      @endif
      @if(isset($permission[6]->view) && $permission[6]->view == 1)
      <li class="{{ $data['sidebar']== 'Attendance' ? 'active' : ''  }}">
         <a href="{{ URL::to('employee/attendance_list')}}">
         <span class="pcoded-micon"><i class="fa fa-calendar"></i><b>H</b></span>
         <span class="pcoded-mtext">Attendance</span>
         </a>
      </li>
      @endif
     
    @if(isset($permission[18]))
            <li class="{{ $data['sidebar']== 'Attendance' ? 'active' : ''  }}">
                <a href="{{ URL::to('employee/view_break_detail')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i></span>
                    <span class="pcoded-mtext">Onboard</span>
                </a>
                
            </li>
          @endif
       @if(isset($permission[20]))
            <li class="{{ $data['sidebar']== 'Task Board' ? 'active' : ''  }}">
                <a href="{{ URL::to('employee/task_board')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i></span>
                    <span class="pcoded-mtext">Task Board</span>
                </a>
                
            </li>
          @endif  
      @if(isset($permission[7]))
      <li class="{{ request()->is('employee/candidate_list') ? 'active' : '' }} " >
         <a href="{{ URL::to('employee/candidate_list')}}">
         <span class="pcoded-micon"><i class="fa fa-user-o"></i></span>
         <span class="pcoded-mtext">Candidate</span>
         </a>
         
         <!--<ul class="pcoded-submenu">
            @if(isset($permission[7]->view) && $permission[7]->view == 1)
            <li class="{{ request()->is('employee/candidate_list') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/candidate_list')}}">
               <span class="pcoded-mtext">List</span>
               </a>
            </li>
            @endif
            @if(isset($permission[7]->add) && $permission[7]->add == 1)
            <li class="{{ request()->is('employee/candidate') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/candidate')}}">
               <span class="pcoded-mtext">Add</span>
               </a>
            </li>
            @endif
         </ul>-->
      </li>
      @endif
       @if(isset($permission[19]->view) && $permission[19]->view == 1)
       <li class="{{ request()->is('employee/template_list') ? 'active' : '' }}">
                <a href="{{ URL::to('employee/template_list')}}">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">Custom Templates</span>
                </a>
        </li>
        @endif
      @if(isset($permission[5]->view) && $permission[5]->view == 1)
      <li class="{{ request()->is('employee/holidays') ? 'active' : '' }}">
         <a href="{{ URL::to('employee/holidays')}}">
         <span class="pcoded-micon"><img src="{{URL::to('dist/assets/images/holiday.png')}}" width="18"></span>
         <span class="pcoded-mtext">Holidays</span>
         </a>
      </li>
      @endif
      @if(isset($permission[3]))
       <li class="pcoded-hasmenu {{ $data['sidebar']== 'Leave' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                    <span class="pcoded-mtext">Leaves</span>
                </a>
                <ul class="pcoded-submenu">
                    
                  @if(isset($permission[3]->edit) && $permission[3]->edit == 1)
                  <li class="{{ request()->is('employee/leave/pending_leave') ? 'active' : '' }}">
                                    <a href="{{ URL::to('employee/leave/pending_leave')}}">
                                        <span class="pcoded-mtext">Pending</span>
                                    </a>
                                </li>
                  @endif
                   @if(isset($permission[3]->view) && $permission[3]->view == 1)
                  <li class="{{ request()->is('employee/leave/all_leave') ? 'active' : '' }}">
                                    <a href="{{ URL::to('employee/leave/all_leave')}}">
                                        <span class="pcoded-mtext">List</span>
                                    </a>
                                </li>
                  @endif
       </ul>
            </li>
    @endif
      @if(isset($permission[10]))     
      <li class="pcoded-hasmenu  {{ $data['sidebar']== 'notification Type' ? 'active pcoded-trigger' : ''  }}">
         <a href="javascript:void(0)">
         <span class="pcoded-micon"><i class="fa fa-bell"></i></span>
         <span class="pcoded-mtext">Notification</span>
         </a>
         <ul class="pcoded-submenu">
            @if(isset($permission[10]->view) && $permission[10]->view == 1)
            <li class="{{ request()->is('employee/notification_list') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/notification_list')}}">
               <span class="pcoded-mtext">List</span>
               </a>
            </li>
            @endif
         </ul>
      </li>
      @endif
      @if(isset($permission[14]->view) && $permission[14]->view == 1)
      <li class="pcoded-hasmenu {{ $data['sidebar']== 'Other Expense' ? 'active pcoded-trigger' : ''  }}">
                     <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="fa fa-usd"></i></span>
                        <span class="pcoded-mtext">Other Expense</span>
                    </a>
                     <ul class="pcoded-submenu">
                          @if(isset($permission[14]->view) && $permission[14]->view == 1)
                        <li class="{{ request()->is('employee/list_other_expense') ? 'active' : '' }}">
                            <a href="{{ URL::to('employee/list_other_expense')}}">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                         @endif
                         @if(isset($permission[14]->add) && $permission[14]->add == 1)
                        <li class="{{ request()->is('employee/other_expense') ? 'active' : '' }}">
                            <a href="{{ URL::to('employee/other_expense')}}">
                                <span class="pcoded-mtext">Add</span>
                            </a>
                        </li>
                         @endif
                    </ul>
         </li>
      @endif
      @if(isset($permission[4]))
      <li class="pcoded-hasmenu {{ $data['sidebar']== 'Salary' ? 'active pcoded-trigger' : ''  }}">
         <a href="javascript:void(0)">
         <span class="pcoded-micon"><i class="fa fa-credit-card"></i></span>
         <span class="pcoded-mtext">Payout</span>
         </a>
         <ul class="pcoded-submenu">
            @if(isset($permission[4]->view) && $permission[4]->view == 1)
            <li class="{{ request()->is('employee/salary_list') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/salary_list')}}">
               <span class="pcoded-mtext">List</span>
               </a>
            </li>
            @endif
            @if(isset($permission[4]->add) && $permission[4]->add == 1)
            <li class="{{ request()->is('employee/listsalaryslip') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/listsalaryslip')}}">
               <span class="pcoded-mtext">Generate Salary Slip</span>
               </a>
            </li>
            @endif
         </ul>
      </li>
      @endif
      @if(isset($permission[9]->view) && $permission[9]->view == 1)
      <li class="pcoded-hasmenu {{ $data['sidebar']== 'System Information' ? 'active pcoded-trigger' : ''  }}">
         <a href="javascript:void(0)">
         <span class="pcoded-micon"><i class="fa fa-laptop"></i></span>
         <span class="pcoded-mtext">System Information</span>
         </a>
         <ul class="pcoded-submenu">
            <li class="{{ request()->is('employee/analystics_system_information') ? 'active' : '' }}">
               <a href="{{ URL::to('employee/analystics_system_information')}}">
               <span class="pcoded-mtext">Analytics</span>
               </a>
            </li>
            <li class="pcoded-hasmenu {{ $data['sidebar']== 'System Information' ? 'active pcoded-trigger' : ''  }}">
               <a href="javascript:void(0)">
               <span class="pcoded-mtext">List</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('employee/mobile_information') ? 'active' : '' }}">
                     <a href="{{ URL::to('employee/mobile_information')}}">
                     <span class="pcoded-mtext">Mobiles</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('employee/laptop_information') ? 'active' : '' }}">
                     <a href="{{ URL::to('employee/laptop_information')}}">
                     <span class="pcoded-mtext">Laptops</span>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </li>
       @endif
        @if(isset($permission[8]))
      <div class="pcoded-navigatio-lavel">Clients</span></div>
     
      <li class="{{ request()->is('employee/clients_list') ? 'active' : '' }} ">
         <a href="{{ URL::to('employee/clients_list')}}">
         <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
         <span class="pcoded-mtext">Clients</span>
         </a>
         <!--<ul class="pcoded-submenu">
            @if(isset($permission[8]->view) && $permission[8]->view == 1)
            <li class=" ">
               <a href="{{ URL::to('employee/clients_list')}}">
               <span class="pcoded-mtext">List</span>
               </a>
            </li>
            @endif
            @if(isset($permission[8]->view) && $permission[8]->view == 1)
            <li class=" ">
               <a href="{{ URL::to('employee/add-client')}}">
               <span class="pcoded-mtext">Add</span>
               </a>
            </li>
            @endif
         </ul>-->
      </li>
      @endif
      @if(isset($permission[11]) ||  isset($permission[12]) || isset($permission[13]))
       <li class="{{ request()->is('employee/projects_list') ? 'active' : '' }}">
         <a href="{{ URL::to('employee/projects_list')}}">
         <span class="pcoded-micon"><i class="feather icon-box"></i></span>
         <span class="pcoded-mtext">Projects</span>
         </a>
      </li>
      @endif
     
      @if(isset($permission[12]))
       <li class="{{ request()->is('employee/tasks_list') ? 'active' : '' }} ">
         <a href="{{ URL::to('employee/tasks_list')}}">
         <span class="pcoded-micon"><i class="fa fa-tasks"></i></span>
         <span class="pcoded-mtext">Tasks</span>
         </a>
      </li>
      @endif
     
      <div class="pcoded-navigatio-lavel">Settings</span></div>
      <li class="{{ $data['sidebar']== 'Company Details' ? 'active' : ''  }}">
         <a href="{{ URL::to('employee/company_profile')}}">
         <span class="pcoded-micon"><img alt="company" src="{{URL::to('dist/assets/images/blue_circle_white.png')}}" width="18"></span>
         <span class="pcoded-mtext">Company Details</span>
         </a>
      </li>
      @if(isset($permission[0]->view) && $permission[0]->view == 1)
      <li class="{{ $data['sidebar']== 'Department' ? 'active' : ''  }}">
         <a href="{{ URL::to('employee/department')}}">
         <span class="pcoded-micon"><i class="fa fa-sitemap"></i></span>
         <span class="pcoded-mtext">Department</span>
         </a>
      </li>
      @endif
      @if(isset($permission[1]->view) && $permission[1]->view == 1)
      <li class="{{ $data['sidebar']== 'Designation' ? 'active' : ''  }}">
         <a href="{{ URL::to('employee/designation')}}">
         <span class="pcoded-micon"><i class="fa fa-id-card-o"></i></span>
         <span class="pcoded-mtext">Designation</span>
         </a>
      </li>
      @endif
    
   </div>
</nav>