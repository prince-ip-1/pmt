 @php
 $session = Session('user_data');
 
$employee = $data['employee_details'];

@endphp
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Official Information</h5>
            </div>
             <div class="card-block">
                <div id="view-info" class="row">
                    <div class="col-lg-12 col-xl-6">
                         <div class="table-responsive">
                            <table class="table table-responsive">
                                <tr>
                                    <th class="social-label b-none p-t-0">Date of joining
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{dateformat($employee->join_date)}}</td>
                                </tr>
                                
                                <tr>
                                    <th class="social-label b-none p-t-0">Department</th>
                                    <td class="social-user-name b-none text-muted p-t-0">{{$employee->department_name}}</td>
                                </tr>
                                    @if($employee->training_start_date != "")
                                <tr>
                                    <th class="social-label b-none p-t-0">Training Start Date</th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{dateformat($employee->training_start_date)}}</td>
                                </tr>
                                 @endif
                                 @if(isset($permission[6]->edit) && $permission[6]->edit == 1 || isset($userdata->department_id) && $userdata->department_id == 1)
                                  <tr>
                                     <th  class="social-label b-none p-t-0" scope="row">Office Pin</th>
                                     <td class="social-user-name b-none p-t-0 text-muted">{{$employee->office_pin}}</td>
                                  </tr>
                                @endif
                                 @if(getDepartment() == 1)
                                <tr>
                                    <th class="social-label b-none p-t-0">Office Email Password</th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{base64_decode($employee->office_email_password)}}</td>
                                </tr>
                                @endif
                            </table>
                    </div>
                    </div>
                     <div class="col-lg-12 col-xl-6">
                          <div class="table-responsive">
                         <table class="table table-responsive">
                                <tr>
                                    <th class="social-label b-none p-t-0">Work Experience
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->experience}}</td>
                                </tr>
                                <tr>
                                    <th class="social-label b-none p-t-0">Designation
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->designation_name}}</td>
                                </tr>
                                 @if($employee->training_end_date != "")
                                <tr>
                                    <th class="social-label b-none p-t-0">Training End Date
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{dateformat($employee->training_end_date)}}</td>
                                </tr>
                                @endif
                            </table>
                            </div>
                     </div>
                </div>  
</div>
</div>
</div>
</div>

<!--2nd-->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Experience Information</h5>
            </div>
             <div class="card-block">
                <div id="view-info" class="row">
                    <div class="col-lg-6">
                            <table class="table table-responsive">
                               @if($employee->term != NULL)
                                  <tr>
                                     <th class="social-label b-none p-t-0">Term</th>
                                     <td class="social-user-name b-none text-muted p-t-0" >{{$employee->term == 1 ? "Bond" : "Security Deduction"}}</td>
                                  </tr>
                                  @if($employee->term == 1)
                                  <tr>
                                     <th class="social-label b-none p-t-0">Bond Duration</th>
                                     <td class="social-user-name b-none text-muted p-t-0" >{{$employee->bond_duration}} years &nbsp; ({{dateformat($employee->bond_start).' - '. dateformat($employee->bond_end)}})</td>
                                  </tr>
                                  @else
                                  <tr>
                                     <th class="social-label b-none p-t-0">Deduction Amount</th>
                                     <td class="social-user-name b-none text-muted p-t-0">{{$employee->deduction_amt}}</td>
                                  </tr>
                                  @endif
                                  @endif
                                <tr>
                                    <th class="social-label b-none p-t-0">Current CTC</th>
                                    <td class="social-user-name b-none text-muted p-t-0">{{$employee->currentCTC}}</td>
                                </tr>
                                 @if(getDepartment() == 1)
                                  <tr>
                                    <th class="social-label b-none p-t-0">Office Pin</th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->office_pin}}</td>
                                  </tr>
                                  @endif   
                            </table>
                    </div>
                     <div class="col-lg-6 ">
                         <table class="table table-responsive">
                                <tr>
                                    <th class="social-label b-none p-t-0">Leave Balance
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->leave_balance}}</td>
                                </tr>
                                <tr>
                                    <th class="social-label b-none p-t-0">Device Type
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->device_Type}}</td>
                                </tr>
                                <tr>
                                    <th class="social-label b-none p-t-0">App Version
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{$employee->app_version}}</td>
                                </tr>
                                
                            </table>
                     </div>
                     
                </div>  
</div>
</div>
</div>
</div>

<!--3rd-->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Bank Information</h5>
            </div>
             <div class="card-block">
                <div id="view-info" class="row">
                    <div class="col-lg-6">
                            <table class="table table-responsive">
                                <tr>
                                    <th class="social-label b-none p-t-0">Bank Name
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{isset($data['bankDetail']->bank_name) ? $data['bankDetail']->bank_name : '-'}}</td>
                                </tr>
                                <tr>
                                    <th class="social-label b-none p-t-0">Branch Name</th>
                                    <td class="social-user-name b-none text-muted p-t-0">{{isset($data['bankDetail']->branch_name) ? $data['bankDetail']->branch_name : '-'}}</td>
                                </tr>
                            </table>
                    </div>
                     <div class="col-lg-6 ">
                         <table class="table table-responsive">
                                <tr>
                                    <th class="social-label b-none p-t-0">Account No
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{isset($data['bankDetail']->account_no) ? $data['bankDetail']->account_no : '-'}}</td>
                                </tr>
                                <tr>
                                    <th class="social-label b-none p-t-0">IFSC Code
                                    </th>
                                    <td class="social-user-name b-none p-t-0 text-muted">{{isset($data['bankDetail']->ifsc_code) ? $data['bankDetail']->ifsc_code : '-'}}</td>
                                </tr>
                            </table>
                     </div>
                </div>  
</div>
</div>
</div>
</div>