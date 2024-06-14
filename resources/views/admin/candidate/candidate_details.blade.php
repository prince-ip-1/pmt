<style>
      .bar {
  display: -webkit-box;
  width:353px;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="candidate">
<input type="hidden" name="candidate_id" class="candidate_id" >
<input type="hidden" name="type" value="{{$data['candidate_details']->status}}" >
<input type="hidden" name="interview_place_status" id="interview_place_status" value="{{$data['candidate_details']->interview_place_status}}" >
<input type="hidden" name="employee_id" value="{{$data['candidate_details']->employee_id}}">
<div class="main-body">
    <div class="page-wrapper">
        @include('includes.breadcrumb')
        <div class="page-body">

        	<div class="row">
                <div class="col-md-12">
                   <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Interview Information</h5>
                        </div>
                         <div class="card-block">
                        <div id="view-info">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                       <table class="table">
                                            <tr>
                                               @if($data['candidate_details']->interview_date_reschedule == "")
                                               <th> Schedule</th>
                                                @if($data['candidate_details']->interview_date == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                <td style="text-align:right;">{{date('d-m-Y H:i:s A',strtotime($data['candidate_details']->interview_date))}}</td>
                                                @endif
                                                @endif
                                                 @if($data['candidate_details']->interview_date != "" && $data['candidate_details']->interview_date_reschedule != "")
                                               <th> Reschedule</th>
                                                @if($data['candidate_details']->interview_date_reschedule == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                <td style="text-align:right;">{{date('d-m-Y H:i:s A',strtotime($data['candidate_details']->interview_date_reschedule))}}</td>
                                                @endif
                                                @endif
                                                
                                            </tr> 
                                           
                                            <tr>
                                                <th>Interview Type</th>
                                                @if($data['candidate_details']->interview_place_status == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                @if($data['candidate_details']->interview_place_status == 3)
                                                <td style="text-align:right;">On-Floor</td>
                                                @elseif($data['candidate_details']->interview_place_status == 4)
                                                <td style="text-align:right;">Online</td>
                                                @endif
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>Employee Name</th>
                                                @if($data['candidate_details']->employee_id == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                <td style="text-align:right;">{{$data['candidate_details']->full_name}} ({{$data['candidate_details']->designation_name}})</td>
                                                @endif
                                            </tr>
                                            
                                    </table>
                               
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                   <table class="table">
                                          
                                            <tr>
                                                <th>Link</th>
                                                @if($data['candidate_details']->link == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                <td style="text-align:right;" ><a href="{{$data['candidate_details']->link}}" target="_blank">Click Here</a></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>Reason</th>
                                                @if($data['candidate_details']->reason == "")
                                                <td style="text-align:right;">-</td>
                                                @else
                                                <td style="text-align:right;">{{$data['candidate_details']->reason}}</td>
                                                @endif
                                            </tr>
                                            
                                            @if(getDepartment() == 1 && $data['candidate_details']->status == 4 || $data['candidate_details']->status == 8)
                                         
                                            <tr>
                                                <th>Mail Send</th>
                                                <td>
                                                    <input type="checkbox" class="send_mail_status" name="mail_status[]" id="candidate" value="0" >
                                                    <span class="text-inverse">Candidate</span>
                                                    <input type="checkbox" class="send_mail_status" name="mail_status[]" id="employee" value="1"> 
                                                    <span class="text-inverse">Employee</span>
                                                
                                                    <button type="button" class="f-right btn btn-primary waves-effect waves-light btn-sm " data-type="{{$data['candidate_details']->status}}"  id="send_mail" data-id="{{$data['candidate_details']->id}}">
                        	                        Send Mail
                        	                        </button>
                                                </td>
                                            </tr>
                                            
                                            @endif
                                    </table>
                                
                                </div>
                            </div>
                         
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Personal Information</h5>
                        </div>
                         <div class="card-block">
                        <div id="view-info">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                       <table class="table">
                                           <tr>
                                              <th>Full Name</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->fullname}}</td>
                                             </tr>
                                            <tr>
                                              <th>Mobile No</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->mobile_no}}</td>
                                              </tr>
                                            <tr>
                                               <th>Address</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->address}}</td>
                                             </tr> 
                                            <tr>
                                              <th>City</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->city}}</td>
                                               </tr>
                                    </table>
                               
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <table class="table">
                                           <tr>
                                               <th style="padding-right:75px;">Email Id</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->email_id}}</td>
                                           </tr>
                                            <tr>
                                              <th>Application Date</th>
                                              <td style="text-align:right;">{{dateformat($data['candidate_details']->application_date)}}</td>
                                              
                                            </tr>
                                            <tr>
                                              <th>DOB</th>
                                              <td style="text-align:right;">{{dateformat($data['candidate_details']->dob)}}</td>
                                              
                                            </tr> 
                                            <tr>
                                              <th>State</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->state}}</td>
                                            </tr>
                                    </table>
                                
                                </div>
                            </div>
                         
                            </div>
                        </div>
                    </div>
                      <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Experience Information</h5>
                        </div>
                         <div class="card-block">
                        <div id="view-info">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <table class="table">
                                           <tr>
                                              <th>Experience</th>
                                              <td style="text-align:right;">
                                                @if($data['candidate_details']->duration == 'other')
                                                  <span>{{$data['candidate_details']->other_years}} Y </span>
                                                @else
                                                  <span>{{$data['candidate_details']->duration}} Y </span>  
                                                @endif
                                                @if($data['candidate_details']->experience == "")
                                                    <span>0 M</span>
                                                @else
                                                    <span>{{$data['candidate_details']->experience}} M </span>
                                                @endif
                                              </td>
                                              </tr>
                                            <tr>
                                              <th>Current Employer</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->current_employer}}</td>
                                              </td>
                                              
                                            </tr>
                                            <tr>
                                               <th>Position Applied For</th>
                                              <td style="text-align:right;">
                                                  @if($data['candidate_details']->desi_id == 1)
                                                  <span>Android Tech Lead</span>
                                                  @elseif($data['candidate_details']->desi_id == 2)
                                                  <span>iOS Tech Lead</span>
                                                  @elseif($data['candidate_details']->desi_id == 3)
                                                  <span>React Native Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 4)
                                                  <span>iOS Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 5)
                                                  <span>Android Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 6)
                                                  <span>Flutter Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 7)
                                                  <span>Python Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 8)
                                                  <span>Digital Marketing</span>
                                                  @elseif($data['candidate_details']->desi_id == 9)
                                                  <span>QA</span>
                                                  @elseif($data['candidate_details']->desi_id == 10)
                                                  <span>BDE</span>
                                                  @elseif($data['candidate_details']->desi_id == 11)
                                                  <span>PHP Trainee</span>
                                                   @elseif($data['candidate_details']->desi_id == 12)
                                                  <span>Android Trainee</span>
                                                   @elseif($data['candidate_details']->desi_id == 13)
                                                  <span>IOS Trainee</span>
                                                  @elseif($data['candidate_details']->desi_id == 14)
                                                  <span>PHP Developer</span>
                                                  @elseif($data['candidate_details']->desi_id == 15)
                                                  <span>Sr.PHP Tech Lead</span>
                                                  @elseif($data['candidate_details']->desi_id == 16)
                                                  <span>Project Manager</span>
                                                  @elseif($data['candidate_details']->desi_id == 17)
                                                  <span>Human Resource Executive</span>
                                                  @endif
                                              </td>
                                                </tr> 
                                                @if(getDepartment() == 1)
                                            <tr>
                                              <th>Current CTC</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->current_ctc}}</td>
                                              </tr>
                                              @endif
                                    </table>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <table class="table">
                                           <tr>
                                             <th >Reason For Leaving</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->reason_for_leaving}}</td>
                                           </tr>
                                            <tr>
                                              <th>Notice Period</th>
                                              <td style="text-align:right;">
                                                  @if($data['candidate_details']->notice_period == 1)
                                                  <span>15 Days</span>
                                                  @elseif($data['candidate_details']->notice_period == 2)
                                                  <span>1 Month</span>
                                                  @elseif($data['candidate_details']->notice_period == 3)
                                                  <span>2 Month</span>
                                                  @elseif($data['candidate_details']->notice_period == 4)
                                                  <span>Immediate Joining</span>
                                                  @endif
                                              </td>
                                              
                                            </tr>
                                            <tr>
                                               <th>Position</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->position}}</td>
                                              
                                            </tr> 
                                             @if(getDepartment() == 1)
                                            <tr>
                                              <th>Expected CTC</th>
                                              <td style="text-align:right;">{{$data['candidate_details']->expected_ctc}}</td>
                                            </tr>
                                            @endif
                                    </table>
                                </div>
                            </div>
                             
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Other Information</h5>
                        </div>
                         <div class="card-block">
                        <div id="view-info">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                       <table class="table">
                                           <tr>
                                                @php 
                                                $a = "";
                                                if($data['candidate_details']->education == "7"){
                                                    $a = $data['candidate_details']->eduction_text;
                                                }else{
                                                    $a = getvalue($data['candidate_details']->education,'Qualification');
                                                }
                                                
                                                @endphp
                                              <th>Qualification</th>
                                              <td style="text-align:right;">{{$a}}</td>
                                             </tr>
                                            <tr>
                                              <th>Additional Notes</th>
                                              <td style="word-wrap:break-word;white-space:inherit;padding:.5em; ">{{$data['candidate_details']->additional_notes}}</td>
                                              </tr>
                                            
                                           
                                    </table>
                               
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <table class="table">
                                           <tr>
                                               <th style="padding-right:75px;">Skill</th>
                                              <td style="text-align:right;">{{rtrim($html,',')}}</td>
                                           </tr>
                                            <tr>
                                              <th>Portal</th>
                                              <td style="text-align:right">{{$data['candidate_details']->portal}}</td>
                                              
                                            </tr>
                                            
                                    </table>
                                
                                </div>
                            </div>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@stop
