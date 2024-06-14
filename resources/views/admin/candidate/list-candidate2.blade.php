@extends('layouts.default')
@section('content')
 @php
                                $usersession = Session('user_data');
                                $userdata = EmployeeDetailById($usersession->id);
                                $permission = $userdata->permissions;
                               
                                @endphp
<style type="text/css">
   .waves-light{
   float: right;
   }

    .nodisplay {
        display: none;
    }
    .display {
        display: all;
    }
    .col-auto{
        text-align: center;
    }
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="candidate">
    
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
          <div class="row simple-cards">
 <div class="col-lg-12">
        <div class="row">
               <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                        <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">Pending</h5>
                                    <span class="m-b-0">{{$data['Pending']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">Selected</h5>
                                    <span class="m-b-0">{{$data['Selected']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">OnHold</h5>
                                    <span class="m-b-0">{{$data['Onhold']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">Interview</h5>
                                    <span class="m-b-0">{{$data['Interview']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">Reschedule</h5>
                                    <span class="m-b-0">{{$data['Reschedule']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-6">
                    <div class="card">
                        <div class="card-block">
                            <div class="row align-items-center">
                                
                                <div class="col-auto">
                                    <h5 class="">Rejected</h5>
                                    <span class="m-b-0">{{$data['Rejected']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
      <div class="page-body">
         <div class="card">
            <div class="card-header">
                <div class="row">
              <div class="col-4">
                   <select class="form-control 123" id="candidate_status" name="candidate_status">
                       <option value="">Select</option>
                          @foreach(GetCandidateStatusList() as $k=>$row)
                          <option value="{{$k}}">{{$row}}</option>
                          @endforeach
                           
                    </select>
               </div>
              
               <div class="col-md-8 text-right">
                   <a href=" {{URL::to('admin/candidate')}}" class="btn btn-primary  waves-effect waves-light waves-effect md-trigger" style="margin-right:2px;">Add Candidate
                  </a>
               </div>
          </div>
            </div>
            <div class="card-block">
               <div class="table-responsive">
                 
                   <table id="CandidateTable" class="table table-bordered ">
                <thead>
                   <tr>
                         <th>Sr No</th>
                         <th>Name</th>
                         <th>Email Id</th>
                         <th>Mobile No</th>
                         <th>Technology</th>
                         <th>Status</th>
                         <th> Changed Status</th>
                         <th>Interview Date</th>
                          @if(getDepartment() == 1 || (isset($permission[7]) && $permission[7]->view == 1 || isset($permission[7]) && $permission[7]->edit == 1 || isset($permission[7]) && $permission[7]->delete == 1))
                         <th>Action</th>
                         @endif
                        </tr>
                </thead>
                <tbody></tbody>
            </table>
               </div>
            </div>
         </div>
         <!-- Edit With Button card end -->
      </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->

{{-- modal-8 --}}

<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-8">
      <div class="md-content">
         <h3>Candidate Status</h3>
         <div>
              <form  method="post" action="/" novalidate="" id="candidate_status">
                <input type="hidden" name="candidate_id" class="candidate_id">
                <input type="hidden" name="type" id="type">

                <div class="form-group row">
                <label class="col-sm-4 col-form-label">Rejection In</label>
                  <div class="col-sm-6">
                      <select class="form-control" id="rejected_in"  name="rejected_in">
                             <option value="">Select </option>
                             <option value="technical"> Technical</option>
                             <option value="practical"> Practical</option>
                             <option value="HR Round"> HR Round</option>
                             <option value="Employee"> Employee</option>
                         </select>
                  </div>
               </div>
  <div class="form-group row">
      <label class="col-sm-4 col-form-label">Reason</label>
      <div class="col-sm-6">
         <textarea class="form-control" id="reason" name="reason" placeholder="Reason"></textarea>
      </div>
  </div>
    
    <!-- Radio Button -->
    <div class="form-group row "  id="">
        <label class="col-sm-4 col-form-label " >Send Mail</label>
        <div class="col-sm-8">
        <div class="form-radio">
            <div class="radio radio-inline">
                <label>
                    <input type="radio" class="term" name="rejected_mail_status"  data-type="0" data-value="0"  value="0" >
                    <i class="helper"></i>Send Mail
                </label>
            </div>
            
        </div>
    </div>
    </div>
    <!-- Radio Button -->
  
   <div class="modal-footer">
     <button type="submit" class="btn btn-primary btn-round   m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round btn-close">Close</button>
   </div>
 </form>
</div>
</div>
</div>
   <div class="md-overlay"></div>
</div>



{{-- model-9 --}}

<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-9">
      <div class="md-content">
         <h3>Candidate Status</h3>
         <div>
              <form  method="post" action="/" novalidate="" class="interview_schedule">
                <input type="hidden" name="candidate_id" class="candidate_id">
                <input type="hidden" name="interview_type" id="interview_type">
                                             <div class="form-group row text-center " id="term5">
                                            <label class="col-sm-4 col-form-label ">Subject</label>
                                                <div class="col-sm-8">
                                                     <input type="text" class="form-control form-control-primary" name="subject" id="subject" placeholder="Enter Title">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <label class="col-sm-4 col-form-label text-center">Select Status</label>
                                                <div class="col-sm-8">
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" id="schedule" data-type="0" data-value="0" value="0" >
                                                                <i class="helper"></i>Schedule
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" id="reschedule" data-type="1" data-value="1" value="1" >
                                                                <i class="helper"></i>Reschedule
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" id="Cancel" data-type="2" data-value="2" value="2" >
                                                                <i class="helper"></i>Cancel
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                 <div class="form-group row text-center "  id="term0">
                                                    <label class="col-sm-4 col-form-label" >Schedule Date</label>
                                                <div class="col-sm-8 ">
                                           
                                                    
                                                    <div style="display:flex;">
                                                        <input type="datetime-local" class="form-control" name="interview_date" > 
                                                    </div>
                                                </div>
                                                </div>
                                               <div class="form-group row text-center nodisplay"  id="term1">
                                                    <label class="col-sm-4 col-form-label" >Reschedule Date</label>
                                                <div class="col-sm-8 ">
                                           
                                                    
                                                    <div style="display:flex;">
                                                        <input type="datetime-local" class="form-control" name="interview_date_reschedule" > 
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- Radio Button -->
                                                <div class="form-group row  "  id="term3">
                                                    <label class="col-sm-4 col-form-label text-center" >Interview Place</label>
                                                    <div class="col-sm-8">
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="interview_place_status" id="schedule" data-type="3" data-value="3"  value="3" >
                                                                <i class="helper"></i>On-Floor
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="interview_place_status" id="reschedule" data-type="4" data-value="4"  value="4" >
                                                                <i class="helper"></i>On-Line
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- Radio Button -->
                                                 <!--Employee-->
                                                <div class="form-group row text-center ">
                                                  <label  class="col-sm-4">Select Employee</label>
                                                  <div class="col-sm-8">
                                                    <select name="employee_id" class="form-control  show-tick" >
                                                       <option value="">Select</option>
                                                       @foreach(employeelist() as $user)
                                                       <option value="{{$user->id}}">{{$user->full_name}} ({{$user->designation_name}})</option>
                                                       @endforeach      
                                                    </select>
                                                    </div>
                                                  </div>
                                                <!--Employee-->
                                                <!-- Mail Radio Button -->
                                                 <div class="form-group row  nodisplay"  id="term4">
                                                    <label class="col-sm-4 col-form-label text-center" >Send Mail</label>
                                                    <div class="col-sm-8">
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="send_mail" id="" data-type="5" data-value="5" value="5" >
                                                                <i class="helper"></i>Send Mail
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="send_mail" id="" data-type="6" data-value="6" value="6" >
                                                                <i class="helper"></i>Mail Later
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- Mail Radio Button -->
                                                 <!--Link Inputs-->
                                                <div class="form-group row text-center nodisplay " id="term6">
                                            <label class="col-sm-4 col-form-label ">Link</label>
                                                <div class="col-sm-8">
                                                     <input type="text" class="form-control form-control-primary" name="link" id="link" placeholder="Enter Link">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                                <!--Link Inputs-->
                                            </div> 
                                 <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-round   m-b-0">Submit</button>
                                    <button type="button" class="btn btn-primary waves-effect md-close btn-round btn-close">Close</button>
                                    
                                 </div>
                  </form>
         </div>
      </div>
      <div class="md-overlay"></div>
   </div>
   
</div>


@stop