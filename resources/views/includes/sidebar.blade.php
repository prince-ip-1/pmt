    <nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <div class="pcoded-navigatio-lavel">Admin</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ $data['sidebar']== 'Dashboard' ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/dashboard')}}">
                    <span class="pcoded-micon"><i class="fa fa-tachometer"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                
            </li>
          
            <li class="{{ $data['sidebar']== 'Analytics' ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/analytics')}}">
                    <span class="pcoded-micon"><i class="fa fa-line-chart"></i></span>
                    <span class="pcoded-mtext">Analytics</span>
                </a>
                
            </li>
         
            @if(Session('user_type') != 'admin')
            <li class="{{  request()->is('admin/checkin') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/checkin')}}">
                    <span class="pcoded-micon"><i class="fa fa-check-square-o"></i></span>
                    <span class="pcoded-mtext">Checkin</span>
                </a>
                
            </li>
              @endif
             <div class="pcoded-navigatio-lavel">Employee</div>
            <li class="pcoded-hasmenu  {{ $data['sidebar']== 'Employee' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                    <span class="pcoded-mtext">Employees</span>
                </a>
                <ul class="pcoded-submenu">
                    
                    <li class="{{ request()->is('admin/employees_list') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/employees_list')}}">
                            <span class="pcoded-mtext">View</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/add_employee') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/add_employee')}}">
                            <span class="pcoded-mtext">Add</span>
                        </a>
                    </li>
                   
                </ul>
            </li>
            <div class="pcoded-navigatio-lavel">HR</div>
            <li class="{{ request()->is('admin/attendance_list') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/attendance_list')}}">
                    <span class="pcoded-micon"><i class="fa fa-calendar"></i><b>H</b></span>
                    <span class="pcoded-mtext">Attendance</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/view_break_detail') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/view_break_detail')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i><b>H</b></span>
                    <span class="pcoded-mtext">On Board</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/task_board') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/task_board')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i><b>H</b></span>
                    <span class="pcoded-mtext">Task Board</span>
                </a>
            </li>
          
           <li class="{{ request()->is('admin/candidate_list') ? 'active' : ''  }} " >
                    <a href="{{ URL::to('admin/candidate_list')}}">
                        <span class="pcoded-micon"><i class="fa fa-user-o"></i></span>
                        <span class="pcoded-mtext">Candidate</span>
                    </a>
                    <!--<ul class="pcoded-submenu">
                        <li class="{{ request()->is('admin/candidate_list') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/candidate_list')}}">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/candidate') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/candidate')}}">
                                <span class="pcoded-mtext">Add</span>
                            </a>
                        </li>
                        
                    </ul>-->
            </li>
             <li class="{{ $data['sidebar']== 'Holiday' ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/holidays')}}">
                    <span class="pcoded-micon"><img alt="holiday" src="{{URL::to('dist/assets/images/holiday.png')}}" width="18"></span>
                    <span class="pcoded-mtext">Holidays</span>
                </a>
            </li> 
           
            
             <li class="pcoded-hasmenu {{ $data['sidebar']== 'Leave' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                    <span class="pcoded-mtext">Leaves</span>
                </a>
                <ul class="pcoded-submenu">
                    
                    <li class="{{ request()->is('admin/leave/pending_leave') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/leave/pending_leave')}}">
                            <span class="pcoded-mtext">Pending</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/leave/all_leave') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/leave/all_leave')}}">
                            <span class="pcoded-mtext">List</span>
                        </a>
                    </li>
                   
                </ul>
            </li>
            <li class="pcoded-hasmenu  {{ $data['sidebar']== 'notification Type' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-bell"></i></span>
                    <span class="pcoded-mtext">Notification</span>
                </a>
                <ul class="pcoded-submenu">
                    
                    <li class="{{ request()->is('admin/notification') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/notification')}}">
                            <span class="pcoded-mtext">Type</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/notification_list') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/notification_list')}}">
                            <span class="pcoded-mtext">List</span>
                        </a>
                    </li>
                     <li class="{{ request()->is('admin/send_notification') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/send_notification')}}">
                            <span class="pcoded-mtext">Send Notification</span>
                        </a>
                    </li>
                    </ul>
                      </li>
                       <!--<li class="pcoded-hasmenu {{ $data['sidebar']== 'Client' ? 'active pcoded-trigger' : ''  }}">-->
                       <!--                 <a href="javascript:void(0)">-->
                       <!--                     <span class="pcoded-micon"><i class="feather icon-layers"></i></span>-->
                       <!--                     <span class="pcoded-mtext">Clients</span>-->
                       <!--                 </a>-->
                       <!--                 <ul class="pcoded-submenu">-->
                       <!--                     <li class=" ">-->
                       <!--                         <a href="{{ URL::to('admin/clients_list')}}">-->
                       <!--                             <span class="pcoded-mtext">Clients List</span>-->
                       <!--                         </a>-->
                       <!--                     </li>-->
                       <!--                     <li class=" ">-->
                       <!--                         <a href="{{ URL::to('admin/add-client')}}">-->
                       <!--                             <span class="pcoded-mtext">Add Client</span>-->
                       <!--                         </a>-->
                       <!--                     </li>-->
                                            
                       <!--                 </ul>-->
                       <!--         </li>-->
                   <li class="pcoded-hasmenu {{ $data['sidebar']== 'Other Expense' ? 'active pcoded-trigger' : ''  }}">
                     <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="fa fa-usd"></i></span>
                        <span class="pcoded-mtext">Other Expense</span>
                    </a>
                     <ul class="pcoded-submenu">
                        <li class="{{ request()->is('admin/list_other_expense') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/list_other_expense')}}">
                                <span class="pcoded-mtext">List</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/other_expense') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/other_expense')}}">
                                <span class="pcoded-mtext">Add</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/expense_category_list') ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/expense_category_list')}}">
                                <span class="pcoded-mtext">Category List</span>
                            </a>
                        </li>
                        
                    </ul>
                    </li>
            <li class="pcoded-hasmenu {{ $data['sidebar']== 'Salary' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-credit-card"></i></span>
                    <span class="pcoded-mtext">Payout</span>
                </a>
                <ul class="pcoded-submenu">
                    
                    <li class="{{ request()->is('admin/salary_list') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/salary_list')}}">
                            <span class="pcoded-mtext">Salary List</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/listsalaryslip') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/listsalaryslip')}}">
                            <span class="pcoded-mtext">Generate Salary Slip</span>
                        </a>
                    </li>
                   
                </ul>
            </li> 
           
              <li class="pcoded-hasmenu {{ $data['sidebar']== 'System Information' ? 'active pcoded-trigger' : ''  }}">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-laptop"></i></span>
                    <span class="pcoded-mtext">System Information</span>
                </a>
                <ul class="pcoded-submenu">
                    
                    <li class="{{ request()->is('admin/analystics_system_information') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/analystics_system_information')}}">
                            <span class="pcoded-mtext">Analytics</span>
                        </a>
                    </li>

                    <li class="pcoded-hasmenu {{ $data['sidebar']== 'System Information' ? 'active pcoded-trigger' : ''  }}">
                             <a href="javascript:void(0)">
                            <span class="pcoded-mtext">List</span>
                            </a>
                        <ul class="pcoded-submenu">
                        <li class="{{ request()->is('admin/mobile_information')  ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/mobile_information')}}">
                                <span class="pcoded-mtext">Mobiles</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/laptop_information')  ? 'active' : '' }}">
                            <a href="{{ URL::to('admin/laptop_information')}}">
                                <span class="pcoded-mtext">Laptops</span>
                            </a>
                        </li>
                    </ul>
                    </li>
                   
                </ul>
            </li>
                                
            
            
               
                   <div class="pcoded-navigatio-lavel">Clients</div> 
                   <li class="{{ request()->is('admin/clients_list') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/clients_list')}}">
                            <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                            <span class="pcoded-mtext">Clients</span>
                        </a>
                        <!--<ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ URL::to('admin/clients_list')}}">
                                    <span class="pcoded-mtext">List</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ URL::to('admin/add-client')}}">
                                    <span class="pcoded-mtext">Add</span>
                                </a>
                            </li>
                            
                            <li class="pcoded-hasmenu {{ $data['sidebar']== 'Client' ? 'active pcoded-trigger' : ''  }}">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                                    <span class="pcoded-mtext">Milestone</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class=" ">
                                        <a href="{{ URL::to('admin/clients_list')}}">
                                            <span class="pcoded-mtext">List</span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="{{ URL::to('admin/add-client')}}">
                                            <span class="pcoded-mtext">Add</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>-->
                    </li>
                   <div class="pcoded-navigatio-lavel">Projects</div> 
                    <li class="{{ request()->is('admin/projects_list') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/projects_list')}}">
                            <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                            <span class="pcoded-mtext">Projects</span>
                        </a>
                        <!--<ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ URL::to('admin/projects_list')}}">
                                    <span class="pcoded-mtext">List</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ URL::to('admin/add_project')}}">
                                    <span class="pcoded-mtext">Add</span>
                                </a>
                            </li>
                           
                        </ul>-->
                    </li>
           
           <!-- <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-tasks"></i></span>
                    <span class="pcoded-mtext">Tasks</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ URL::to('admin/tasks_list')}}">
                            <span class="pcoded-mtext">List</span>
                        </a>
                    </li>
                </ul>
            </li>-->
             <li class="{{ request()->is('admin/tasks_list') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/tasks_list')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i><b>T</b></span>
                    <span class="pcoded-mtext">Tasks</span>
                </a>
            </li>
             
            
             <li class="{{ request()->is('admin/feedback-list') ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/feedback-list')}}">
                    <span class="pcoded-micon"><i class="fa fa-th-large"></i><b>F</b></span>
                    <span class="pcoded-mtext">Feedback List</span>
                </a>
            </li>
             <div class="pcoded-navigatio-lavel">Settings</span></div>
             <li class="{{ $data['sidebar']== 'Company Details' ? 'active' : ''  }}">
                <a href="{{ URL::to('admin/company_profile')}}">
                    <span class="pcoded-micon"><img alt="company" src="{{URL::to('dist/assets/images/blue_circle_white.png')}}" width="18"></span>
                    <span class="pcoded-mtext">Company Details</span>
                </a>
                
            </li>
            <li class="{{ request()->is('admin/department') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/department')}}">
                    <span class="pcoded-micon"><i class="fa fa-sitemap"></i></span>
                    <span class="pcoded-mtext">Department</span>
                </a>
            </li>
             <li class="{{ request()->is('admin/designation') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/designation')}}">
                    <span class="pcoded-micon"><i class="fa fa-id-card-o"></i></span>
                    <span class="pcoded-mtext">Designation</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/database_backup') ? 'active' : '' }}">
                <a href="{{ URL::to('admin/database_backup')}}">
                    <span class="pcoded-micon"><i class="fa fa-id-card-o"></i></span>
                    <span class="pcoded-mtext">Database Backup</span>
                </a>
            </li>
            <li class="">
                    <a href="{{ URL::to('logout')}}">
                        <span class="pcoded-micon"><i class="fa fa-sign-out"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                    
                </li>
                  
                </ul>
            
            
        

    </div>
</nav>