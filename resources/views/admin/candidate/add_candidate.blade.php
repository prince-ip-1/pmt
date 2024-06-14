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
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="candidate">
<input type="hidden" id="candidate_id" value="">
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
                                <!--<div id="wizard1">-->
                                <!--<section>-->
                                   
                                         <div class="row">
                                                
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Full Name</label>
                                                    <input name="fullname" type="text" class=" form-control" placeholder="Enter Full Name">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Email ID</label>
                                                    <input  type="email" name="email_id" class=" form-control" placeholder="Enter Email Id">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Mobile No</label>
                                                    <input name="mobile_no" type="number" class=" form-control" placeholder="Enter Mobile No">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Application Date</label>
                                                    <input name="application_date" type="date" class=" form-control">
                                                    <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">City</label>
                                                    <input name="city" type="text" class=" form-control" placeholder="Enter City">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">State</label>
                                                    <input name="state" type="text" class=" form-control" placeholder="Enter State">
                                                    <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Address</label>
                                                    <textarea class="form-control" name="address"  placeholder="Address"></textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Date Of Birth</label>
                                                    <input name="dob" type="date" class=" form-control">
                                                    <span class="messages"></span>
                                                </div>
                                                
                                               
                                            </div>
                                             </div>
                                        </div>
                                        <!--2nd Card-->
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
                                                           <option value="">Select Year</option>
                                                           <option value="0">0</option>
                                                           <option value="1">1</option>
                                                           <option value="2">2</option>
                                                           <option value="3">3</option>
                                                           <option value="4">4</option>
                                                           <option value="5">5</option>
                                                           <option value="6">6</option>
                                                           <option value="7">7</option>
                                                           <option value="8">8</option>
                                                           <option value="9">9</option>
                                                           <option value="10">10</option>
                                                           <option value="11">11</option>
                                                           <option value="12">12</option>
                                                           <option value="other">Other</option>
                                                        </select>
                                                        <span class="messages"></span>
                                                    </div>
                                                <div class="col-sm-3">
                                                        <label class="block">Month</label>
                                                        <select name="experience" id="experience" class="form-control show-tick" >
                                                           <option value="">Select Month</option>
                                                           <option value="0">0</option>
                                                           <option value="1">1</option>
                                                           <option value="2">2</option>
                                                           <option value="3">3</option>
                                                           <option value="4">4</option>
                                                           <option value="5">5</option>
                                                           <option value="6">6</option>
                                                           <option value="7">7</option>
                                                           <option value="8">8</option>
                                                           <option value="9">9</option>
                                                           <option value="10">10</option>
                                                           <option value="11">11</option>
                                                           <option value="12">12</option>
                                                        </select>
                                                        <span class="messages"></span>
                                                    </div>
                                                    
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Reason for Leaving</label>
                                                    <textarea class="form-control" name="reason"  placeholder="Reason"></textarea>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group" id="other_year" style="display: none;">
                                                            <label class="block">Other Year</label>
                                                             <input name="other_years" type="number" class=" form-control" placeholder="Enter Other Year ">
                                                             <span class="messages"></span>
                                                   </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Last Employer(Company)</label>
                                                    <input name="current_employer" type="text" class=" form-control" placeholder="Enter Current Employer">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Notice Period</label>
                                                      <select name="notice_period" id="notice_period" class="form-control show-tick" >
                                                   <option value="">Select Notice Period</option>
                                                   <option value="1">15 Days</option>
                                                   <option value="2">1 Month</option>
                                                   <option value="3">2 Month</option>
                                                   <option value="4">Immediate Joining</option>
                                                   
                                                       
                                                </select>
                                                    <span class="messages"></span>
                                                </div>
                                                 
                                            </div>
                                           
                                            <div class="row">
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Last Designation</label>
                                                    <input name="position" type="text" class=" form-control" placeholder="Enter Position">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Position Applied for</label>
                                                     <select name="desi_id" id="designation" class="form-control show-tick">
                                                        <option value="">Select Designation</option>
                                                        <option value="1">Android Tech Lead</option>
                                                        <option value="2">iOS Tech Lead</option>
                                                        <option value="3">React Native Developer</option>
                                                        <option value="4">iOS Developer</option>
                                                        <option value="5">Android Developer</option>
                                                        <option value="6">Flutter Developer</option>
                                                        <option value="7">Python Developer</option>
                                                        <option value="8">Digital Marketing</option>
                                                        <option value="9">QA</option>
                                                        <option value="10">BDE</option>
                                                        <option value="11">PHP Trainee</option>
                                                        <option value="12">Android Trainee</option>
                                                        <option value="13">IOS Trainee</option>
                                                        <option value="14">PHP Developer</option>
                                                        <option value="15">Sr.PHP Tech Lead</option>
                                                        <option value="16">Project Manager</option>
                                                        <option value="17">Human Resource Executive</option>
                                                        <option value="18">Full Stack Developer</option>
                                                        </select>
                                                    <span class="messages"></span>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Current CTC (In Month)</label>
                                                    <input name="cctc" type="text" class=" form-control" placeholder="Enter Current CTC">
                                                    <span class="messages"></span>
                                                </div>
                                              <div class="col-sm-6 form-group">
                                                    <label class="block">Expected CTC</label>
                                                    <input name="ectc" type="text" class=" form-control" placeholder="Enter Expected CTC">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <!--3rd Card-->
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
                                            <select name="education" class="form-control show-tick  qualification_list"  id="education">
                                                <option value="">Select Qualification</option>
                                                 @foreach($qualification as $row)
                                                        <option value="">{{$row->name}}</option>
                                                @endforeach
                                                <option class="font-color" value="qualification">Add Qualification</option>
                                            </select>
                                            </div>
                                           
                                            <div class="col-sm-6 form-group">
                                            <label >Skills</label>
                                            <select name="skills[]" class="skill select2" id="skills" multiple="multiple">
                                                <option value="id">Select</option>
                                                    @foreach($skill as $user)
                                                    <option value="{{$user->id}}">{{$user->skill_name}}</option>
                                                    @endforeach      
                                                </select>
                                            </div>
                                            </div>
                                            <div class="row">
                                             <div class="col-sm-6 form-group"  id="eduction_text" style="display: none;">
                                            
                                             <label class="block">Other Qualification</label>
                                             <input name="eduction_text" type="text" class=" form-control" placeholder="Enter Other Qualification">
                                             <span class="messages"></span>
                                                
                                              
                                            </div>
                                            <div class="col-sm-6 form-group"  id="other_skill" style="display: none;">
                                            <label class="block">Other Skills</label>
                                            <input name="other_skill" type="text" class=" form-control" placeholder="Enter Other Skill">
                                            <span class="messages"></span>
                                             
                                            </div>
                                                
                                            </div>
                                            
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Additional Notes</label>
                                                    <textarea class="form-control" name="notes"  placeholder="Add Additional Notes"></textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Upload CV</label>
                                                     <input class="form-control" type="file" name="cv" id="cv">
                                                     <span class="messages"></span>

                                                </div>
                                            </div>
                                             <div class="row">
                                             <div class="col-sm-6 form-group"  id="portal" >
                                            
                                             <label class="block">Portal</label>
                                             <input name="portal" type="text" class=" form-control" placeholder="Enter portal">
                                             <span class="messages"></span>
                                                
                                              
                                            </div>
                                           
                                                
                                            </div>
                                            </div>
                                            </div>
                                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                                            <button type="submit" data-id="save" class="btn btn-primary submit_btn save"  data-value="0">Submit</button>
                                            <button type="submit" data-id="draft" class="btn btn-primary submit_btn draft" data-value="1">Save As Draft</button>
                                            <button type="reset"   class="btn btn-default d-none">Reset</button>
                                    <!--</form>-->
                          <!--</section>-->
                          <!--  </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@stop
<!--Model-->
<div class="modal fade " id="qualification-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Qualification</h4>
           
                    </div>
                     <form method="post" action="/" id="model_qualification_form" name="model_qualification_form">
                  
                    <div class="modal-body qualification_form">
                           
                            <div class=" row">
                                               
                                 <div class="col-sm-6 form-group ">
                                    <input name="name" id="name" type="text" class=" form-control" placeholder="Enter Qualification" style="width:266px">
                                    <span class="messages"></span>
                                </div>
                            </div>
                      
                        </div>
                         <div class="modal-footer">
                         <div class="col-sm-4">
                                   
                                  <button type="button" class="btn  btn-primary waves-effect qualification" id="submit" value="" style="margin-left:-16px" >Submit</button>
                                  <button type="button" class="btn   btn-primary waves-effect waves-light close-model"  style="margin-left:-199px">Cancel</button>
                                  
                                </div>
                         </div>
                       </form>
                    </div>
                   
        </div>
    </div>