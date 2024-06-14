 @php
 $session = Session('user_data');
 
$employee = $data['employee_details'];

@endphp
<div class="card">
@if($session->id == $employee->id)
                        <div class="card-header">
                           <h5 class="card-header-text">About Me</h5>
                           <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                           <i class="icofont icofont-edit"></i>
                           </button>
                        </div>
                        @endif
                        <div class="card-block">
                           <div class="view-info">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="general-info">
                                       <div class="row">
                                          <div class="col-lg-12 col-xl-6">
                                             <div class="table-responsive">
                                                <table class="table m-0">
                                                   <tbody>
                                                     
                                                      <tr>
                                                         <th scope="row">Employee Name</th>
                                                         <td>{{$employee->first_name}}</td>
                                                      </tr>
                                                      <tr>
                                                         <th scope="row">Gender</th>
                                                         <td>{{$employee->gender}}</td>
                                                      </tr>
                                                      <tr>
                                                         <th scope="row">Birth Date</th>
                                                         <td>{{dateformat($employee->dob)}}</td>
                                                      </tr>
                                                      
                                                      <tr>
                                                         <th scope="row">Location</th>
                                                         <td>{{$employee->address}}</td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <!-- end of table col-lg-6 -->
                                          <div class="col-lg-12 col-xl-6">
                                             <div class="table-responsive">
                                                <table class="table">
                                                   <tbody>
                                                      <tr>
                                                         <th scope="row">Email</th>
                                                         <td>{{$employee->email}}</td>
                                                      </tr>
                                                      <tr>
                                                         <th scope="row">Mobile Number</th>
                                                         <td>{{$employee->contact_no}}</td>
                                                      </tr>
                                                      
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                          <!-- end of table col-lg-6 -->
                                       </div>
                                       <!-- end of row -->
                                    </div>
                                    <!-- end of general info -->
                                 </div>
                                 <!-- end of col-lg-12 -->
                              </div>
                              <!-- end of row -->
                           </div>
                           <!-- end of view-info -->
                           <div class="edit-info">
                                <form id="main" method="post" action="/" novalidate="" >
                              <div class="row">
                                 <div class="col-lg-12">
                                       <input type="hidden" id="table_name" value="myprofile">
                                    <div class="general-info">
                                       <div class="form-group row">
                                          <div class="col-lg-6">
                                             <table class="table">
                                                <tbody>
                                                   <tr>
                                                      <td>
                                                         <div class="form-group">
                                                            <label class="col-form-label">Employee Name</label>
                                                            <input type="hidden" id="id" value="{{$employee->id}}">
                                                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter Employee Name" value="{{$employee->first_name}}">
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td>
                                                         <div class="form-radio">
                                                            <div class="group-add-on">
                                                               <div>Gender</div>
                                                               <div class="radio radiofill radio-inline">
                                                                 
                                                                  <label>
                                                                <input type="radio" name="gender" id="gender" value="Male" @if($employee->gender == 'Male') checked @endif>
                                                                <i class="helper"></i>Male
                                                            </label>

                                                               </div>
                                                               <div class="radio radiofill radio-inline">
                                                               
                                                                  <label>
                                                                <input type="radio" name="gender" id="gender" value="Female" @if($employee->gender == 'Female') checked @endif>
                                                                <i class="helper"></i>Female
                                                            </label>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td>
                                                    <div class=" form-group">
                                                       <label class="block">Date of Birth</label>
                                                    <input name="dob" type="date" id="dob" class=" form-control" value="{{$employee->dob}}">
                                                       
                                                   </div>
                                                </td>
                                                   </tr>
                                                     <tr>
                                                      <td>
                                                    <div class=" form-group">
                                                      
                                                       <label class="col-form-label">Address</label>
                                                    <textarea class="form-control" id="address" name="address"  placeholder="Enter Address"> {{$employee->address}}</textarea>
                                                   </div>
                                                </td>
                                                   </tr>
                                                   
                                                   
                                                </tbody>
                                             </table>
                                          </div>
                                          <!-- end of table col-lg-6 -->
                                          <div class="col-lg-6">
                                             <table class="table">
                                                <tbody>
                                                   <tr>

                                                   <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Email</label>
                                                      <input name="email" type="email" id="email" class=" form-control" placeholder="Enter Email Email" value="{{$employee->email}}">
                                                    </div>
                                                </td>
                                                      </tr>
                                                      <tr>
                                                         <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Contact No</label>
                                                       <input name="contact" type="number" id="contact" class=" form-control " placeholder="Enter Contact Number" value="{{$employee->contact_no}}">
                                                    </div>
                                                </td>
                                                      </tr>
                                                    
                                                   
                                                  
                                                   
                                                </tbody>
                                             </table>
                                          </div>
                                          <!-- end of table col-lg-6 -->
                                       </div>
                                       <!-- end of row -->
                                       <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light  m-b-0">Save</button>
                                    
                                    <button type="button" id="edit-cancel" class="btn btn-default waves-effect">Close</button>
                                 </div>
                                    </div>
                                    <!-- end of edit info -->
                                 </div>
                                 <!-- end of col-lg-12 -->
                              </div>
                              <!-- end of row -->
                           </div>
                           <!-- end of edit-info -->
                        </div>
                        <!-- end of card-block -->
                     </div>