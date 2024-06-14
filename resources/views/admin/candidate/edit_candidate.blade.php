<style>
    .select2 {
 color: white;
  padding: 1px;
  border: none;
  cursor: pointer;
}

 .select2-search__field {
        width: 325.968px !important;
        border:none !important;
    }
    .nodisplay {
        display: none;
    }
    .display {
        display: all;
    }
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="candidate">
<input type="hidden"  id="candidate_id" value="{{$data['candidate_details']->id}}">
 <input type="hidden" name="old_cv" id="old_cv" value="{{$data['candidate_details']->cv}}"> 
<div class="main-body">
    <div class="page-wrapper">
    	<!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">

        	<div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                    <form class="candidate-form" id="main" method="post" action="/" novalidate="" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <b>Personal Information</b>
                            </div>
                        </div>
                        <div class="card-block">
                                         <div class="row">
                                                
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Full Name</label>
                                                    <input name="fullname" type="text" class="form-control" value="{{$data['candidate_details']->fullname}}" placeholder="Enter Full Name">
                                                    <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Email ID</label>
                                                    <input  type="email" name="email_id" class=" form-control" value="{{$data['candidate_details']->email_id}}" placeholder="Enter Email Id">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Mobile No</label>
                                                    <input name="mobile_no" type="number" class=" form-control" value="{{$data['candidate_details']->mobile_no}}" placeholder="Enter Mobile No">
                                                    <span class="messages"></span>
                                                </div>
                                                  <div class="col-sm-6 form-group">
                                                    <label class="block">Application Date</label>
                                                    <input name="application_date" type="date" class=" form-control" value="{{$data['candidate_details']->application_date}}">
                                                    <span class="messages"></span>
                                                </div>
                                               
                                            </div>
                                            
                                            <div class="row">
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">City</label>
                                                    <input name="city" type="text" class=" form-control" value="{{$data['candidate_details']->city}}" placeholder="Enter City">
                                                    <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">State</label>
                                                    <input name="state" type="text" class=" form-control" value="{{$data['candidate_details']->state}}" placeholder="Enter State">
                                                    <span class="messages"></span>
                                                </div>
                                               
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Address</label>
                                                    <textarea class="form-control" name="address"  placeholder="Address">{{$data['candidate_details']->address}}</textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Date Of Birth</label>
                                                    <input name="dob" type="date" class=" form-control" value="{{$data['candidate_details']->dob}}">
                                                    <span class="messages"></span>
                                                </div>
                                               
                                               
                                            </div>
                                            </div>
                                            </div>
                                             <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-left">
                                                       <b>Experience Information</b>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                            <div class="row">
                                                 <div class="col-sm-3">
                                                    <label class="block">Years</label>
                                                        <select name="duration" id="duration" class="form-control show-tick duration" >
                                                           <option value="">Select Years</option>
                                                           <option value="0" @if($data['candidate_details']->duration == 0) selected @endif>0</option>
                                                           <option value="1" @if($data['candidate_details']->duration == 1) selected @endif>1</option>
                                                           <option value="2" @if($data['candidate_details']->duration == 2) selected @endif>2</option>
                                                           <option value="3" @if($data['candidate_details']->duration == 3) selected @endif>3</option>
                                                           <option value="4" @if($data['candidate_details']->duration == 4) selected @endif>4</option>
                                                           <option value="5" @if($data['candidate_details']->duration == 5) selected @endif>5</option>
                                                           <option value="6" @if($data['candidate_details']->duration == 6) selected @endif>6</option>
                                                           <option value="7" @if($data['candidate_details']->duration == 7) selected @endif>7</option>
                                                           <option value="8" @if($data['candidate_details']->duration == 8) selected @endif>8</option>
                                                           <option value="9" @if($data['candidate_details']->duration == 9) selected @endif>9</option>
                                                           <option value="10" @if($data['candidate_details']->duration == 10) selected @endif>10</option>
                                                           <option value="11" @if($data['candidate_details']->duration == 11) selected @endif>11</option>
                                                           <option value="12" @if($data['candidate_details']->duration == 12) selected @endif>12</option>
                                                           <option value="other" @if($data['candidate_details']->duration == 'other') selected @endif>Other</option>
                                                        </select>
                                                        <span class="messages"></span>
                                                    </div>
                                                 <div class="col-sm-3">
                                                        <label class="block">Month</label>
                                                        <select name="experience" id="experience" class="form-control show-tick" >
                                                           <option value="">Select Month</option>
                                                           <option value="0" @if($data['candidate_details']->experience == 0) selected @endif>0</option>
                                                           <option value="1" @if($data['candidate_details']->experience == 1) selected @endif>1</option>
                                                           <option value="2" @if($data['candidate_details']->experience == 2) selected @endif>2</option>
                                                           <option value="3" @if($data['candidate_details']->experience == 3) selected @endif>3</option>
                                                           <option value="4" @if($data['candidate_details']->experience == 4) selected @endif>4</option>
                                                           <option value="5" @if($data['candidate_details']->experience == 5) selected @endif>5</option>
                                                           <option value="6" @if($data['candidate_details']->experience == 6) selected @endif>6</option>
                                                           <option value="7" @if($data['candidate_details']->experience == 7) selected @endif>7</option>
                                                           <option value="8" @if($data['candidate_details']->experience == 8) selected @endif>8</option>
                                                           <option value="9" @if($data['candidate_details']->experience == 9) selected @endif>9</option>
                                                           <option value="10" @if($data['candidate_details']->experience == 10) selected @endif>10</option>
                                                           <option value="11" @if($data['candidate_details']->experience == 11) selected @endif>11</option>
                                                           <option value="12" @if($data['candidate_details']->experience == 12) selected @endif>12</option>
                                                        </select>
                                                        <span class="messages"></span>
                                                    </div>
                                                   
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Reason for Leaving</label>
                                                    <textarea class="form-control" name="reason"  placeholder="Reason">{{$data['candidate_details']->reason_for_leaving}}</textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                  
                                                 
                                            </div>
                                             @php
                                            $display1  = "";
                                         
                                            if($data['candidate_details']->duration == 'other'){
                                                $display1 .= 'display';
                                            }else{
                                                $display1 .= 'nodisplay';
                                            }
                                            
                                             @endphp
                                            <div class="row">
                                                <div class="col-sm-6 form-group {{$display1}}" id="other_year" >
                                                    <label class="block">Other Year</label>
                                                     <input name="other_years" type="number" class=" form-control" placeholder="Enter Other Year" value="{{$data['candidate_details']->other_years}}">
                                                     <span class="messages"></span>
                                                   </div>
                                            </div>
                                           <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Last Employer(Company)</label>
                                                    <input name="current_employer" type="text" class=" form-control" value="{{$data['candidate_details']->current_employer}}" placeholder="Enter Current Employer">
                                                    <span class="messages"></span>
                                                </div>
                                               <div class="col-sm-6 form-group">
                                                    <label class="block">Notice Period</label>
                                                      <select name="notice_period" id="notice_period" class="form-control show-tick" >
                                                   <option value="">Select Notice Period</option>
                                                   <option value="1" @if($data['candidate_details']->notice_period == 1) selected @endif>15 Days</option>
                                                   <option value="2" @if($data['candidate_details']->notice_period == 2) selected @endif>1 Month</option>
                                                   <option value="3" @if($data['candidate_details']->notice_period == 3) selected @endif>2 Month</option>
                                                   <option value="4" @if($data['candidate_details']->notice_period == 4) selected @endif>Immediate Joining</option>
                                                   
                                                       
                                                </select>
                                                    <span class="messages"></span>
                                                </div>
                                           </div>
                                            <div class="row">
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Last Position</label>
                                                    <input name="position" type="text" class=" form-control" value="{{$data['candidate_details']->position}}" placeholder="Enter Position">
                                                    <span class="messages"></span>
                                                </div>
                                               <div class="col-sm-6 form-group">
                                                    <label class="block">Position Applied for</label>
                                                     <select name="desi_id" id="designation" class="form-control show-tick">
                                                   <option value="">Select Designation</option>
                                                        <option value="1" @if($data['candidate_details']->desi_id == 1) selected @endif>Android Tech Lead</option>
                                                        <option value="2" @if($data['candidate_details']->desi_id == 2) selected @endif>iOS Tech Lead</option>
                                                        <option value="3" @if($data['candidate_details']->desi_id == 3) selected @endif>React Native Developer</option>
                                                        <option value="4" @if($data['candidate_details']->desi_id == 4) selected @endif>iOS Developer</option>
                                                        <option value="5" @if($data['candidate_details']->desi_id == 5) selected @endif>Android Developer</option>
                                                        <option value="6" @if($data['candidate_details']->desi_id == 6) selected @endif>Flutter Developer</option>
                                                        <option value="7" @if($data['candidate_details']->desi_id == 7) selected @endif>Python Developer</option>
                                                        <option value="8" @if($data['candidate_details']->desi_id == 8) selected @endif>Digital Marketing</option>
                                                        <option value="9" @if($data['candidate_details']->desi_id == 9) selected @endif>QA</option>
                                                        <option value="10" @if($data['candidate_details']->desi_id == 10) selected @endif>BDE</option>
                                                        <option value="11" @if($data['candidate_details']->desi_id == 11) selected @endif>PHP Trainee</option>
                                                        <option value="12" @if($data['candidate_details']->desi_id == 12) selected @endif>Android Trainee</option>
                                                        <option value="13" @if($data['candidate_details']->desi_id == 13) selected @endif>IOS Trainee</option>
                                                        <option value="14" @if($data['candidate_details']->desi_id == 14) selected @endif>PHP Developer</option>
                                                        <option value="15" @if($data['candidate_details']->desi_id == 15) selected @endif>Sr.PHP Tech Lead</option>
                                                        <option value="16" @if($data['candidate_details']->desi_id == 16) selected @endif>Project Manager</option>
                                                        <option value="17" @if($data['candidate_details']->desi_id == 17) selected @endif>Human Resource Executive</option>
                                                        <option value="18" @if($data['candidate_details']->desi_id == 18) selected @endif>Full Stack Developer</option>
                                                </select>
                                                    <span class="messages"></span>
                                                </div>
                                               
                                            </div>
                                             <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Current CTC (In Month)</label>
                                                    <input name="cctc" type="text" class=" form-control" value="{{$data['candidate_details']->current_ctc}}" placeholder="Enter Current CTC">
                                                    <span class="messages"></span>
                                                </div>
                                              <div class="col-sm-6 form-group">
                                                    <label class="block">Expected CTC</label>
                                                    <input name="ectc" type="text" class=" form-control" value="{{$data['candidate_details']->expected_ctc}}" placeholder="Enter Expected CTC">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                             <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-left">
                                                        <b>Other Information</b>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                            <label class="block">Qualification</label>
                                             <select name="education" class="form-control show-tick "  id="education">
                                                <option value="">Select Qualification</option>
                                              
                                                @foreach($qualification as $row)
                                                        <option value="{{$row->id}}" @if($data['candidate_details']->education == $row->id) selected @endif>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                             @php
                                            $skill_select = explode(',',$data['candidate_details']->skills);
                                            
                                            @endphp
                                            
                                            <div class="col-sm-6 form-group">
                                            <label >Skills</label>
                                            <select name="skills[]" class="skill  form-control show-tick select2" id="skills" multiple="multiple">
                                                <option value="">Select</option>
                                                        @foreach($skill as $key=>$val)
                                                        <option <?php echo (isset($skill_select) && in_array($val->id, $skill_select) ) ? 'selected="selected"' : "" ?> value="{{$val->id}}">{{$val->skill_name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            
                                                
                                            </div>
                                           
                                             
                                            <div class="row">
                                                @php
                                                $style = 'none';
                                               
                                                if($data['candidate_details']->education == "7"){
                                                    $style = 'block';
                                                    }
                                                    
                                                @endphp
                                             <div class="col-sm-6 form-group"  id="eduction_text" style="display: {{$style}};" >
                                            
                                             <label class="block">Other Qualification</label>
                                             <input name="eduction_text" type="text" class=" form-control" value="{{$data['candidate_details']->eduction_text}}" placeholder="Enter Other Qualification">
                                             <span class="messages"></span>
                                                
                                              
                                            </div>
                                            @php
                                            $style = 'none';
                                            $a = explode(',',$data['candidate_details']->skills);
                                            if(in_array("9", $a))
                                            {
                                                 $style = 'block';
                                            }
                                            @endphp
                                            <div class="col-sm-6 form-group"  id="other_skill" style="display: {{$style}};">
                                            <label class="block">Other Skills</label>
                                            <input name="other_skill" type="text" class="form-control" value="{{$data['candidate_details']->other_skill}}" placeholder="Enter Other Skill">
                                            <span class="messages"></span>
                                             
                                            </div>
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Additional Notes</label>
                                                    <textarea class="form-control" name="notes" value="" placeholder="Add Additional Notes">{{$data['candidate_details']->additional_notes}}</textarea>
                                                    <span class="messages"></span>
                                                </div>
                                            <div class="col-sm-6 form-group">
                                                    <label class="block">Upload CV</label>
                                                     <input class="form-control" type="file" name="cv" id="cv" value="{{URL::to('/uploads/candidate/'.$data['candidate_details']->cv)}} ">
                                                     <span class="messages"></span>
                                                      @if(!empty($data['candidate_details']->cv))
                                                         <a  data-id="{{ $data['candidate_details']->id}}" class="  waves-effect waves-light " style="float: none;margin: 5px;" style="color: #fff;margin-right: -5px;" href = "{{getImagePath($data['candidate_details']->cv,'candidate')}}" target="_blank">{{$data['candidate_details']->cv}}</a>
                                
                                                     @endif

                                                </div>
                                           
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Portal</label>
                                                    <input name="portal" type="text" class="form-control" value="{{$data['candidate_details']->portal}}" placeholder="Enter Portal">
                                            <span class="messages"></span>
                                                </div>
                                           
                                            </div>
                                            </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary submit_btn save" data-id="save" data-value="0">Update</button>
                                            <button type="reset"   class="btn btn-default d-none">Reset</button>
                                    </form>
                          </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@stop