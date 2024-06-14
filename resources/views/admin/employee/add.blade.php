@extends('layouts.default')

@section('content')
<style type="text/css">
    .nodisplay {
        display: none;
    }
    .display {
        display: all;
    }
    .select2-search__field {
        width: 325.968px !important;
        border:none !important;
    }
</style>
<div class="main-body">

    <div class="page-wrapper">

    	<!-- Page-header start -->

        @include('includes.breadcrumb')

        <!-- Page-header end -->

        <div class="page-body">



        	<div class="row">

                <div class="col-sm-12">

                    <!-- Basic Form Inputs card start -->

                    <div class="card">

                        <div class="card-header">

                            <div class="card-header-right">

                                <i class="icofont icofont-spinner-alt-5"></i>

                            </div>

                        </div>

                        <div class="card-block">

                        	<div id="wizard1">

                                <section>

                                    <form class="wizard-form emp-form" id="basic-forms">

                                        <h3> Personal Information </h3>

                                        <fieldset>

                                            <div class="form-group row">

                                                <div class="col-sm-6">

                                                    <label class="block">First Name</label>

                                                    <input name="fname" type="text" class="form-control required" placeholder="Enter First Name">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Last Name</label>

                                                    <input name="lname" type="text" class=" form-control required" placeholder="Enter Last Name">

                                                </div>

                                            </div>

                                            
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Primary Email</label>
                                                    <input name="email" type="email" id="email required" class=" form-control" placeholder="Enter Primary Email">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Office Email</label>
                                                    <input name="office_email" type="email" id="email" class=" form-control" placeholder="Enter Office Email">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Date of Birth</label>
                                                    <input name="dob" type="date" id="dob" class=" form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Gender</label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Male">
                                                                <i class="helper"></i>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Female">
                                                                <i class="helper"></i>Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Contact No</label>
                                                    <input name="contact" type="number" id="contact" class=" form-control" placeholder="Enter Contact Number">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Address</label>
                                                    <textarea class="form-control required" name="address"  placeholder="Address"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-6">

                                                    <label class="block">Image</label>

                                                    <input name="image" type="file" class="form-control" name="image">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Password</label>

                                                    <input name="password" type="password" class="form-control required" placeholder="Enter Password">

                                                </div>

                                            </div>

                                        </fieldset>

                                        <h3> Official Information </h3>

                                        <fieldset style="overflow-y: scroll;">
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Employee Type</label>
                                                    <select class="form-control required empType" name="emp_type">
                                                        <option>Select Employee Type</option>
                                                        <option value="user">Employee</option>
                                                        <option value="trainee">Trainee</option>
                                                    </select>
                                                </div>
                                               
                                                <div class="col-sm-6">

                                                    <label class="block">Office Email Password</label>

                                                    <input name="office_email_password" type="password" class="form-control " placeholder="Enter Office Email Password">

                                                </div>
                                           
                                            </div>
                                            
                                           <div class="form-group row nodisplay" id="traineeDur">

                                            	<div class="col-sm-6">

                                                    <label class="block">Training Start Date</label>

                                                    <input name="training_start_date" type="date" class=" form-control" placeholder="Select Training start date">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Training End Date</label>

                                                    <input name="training_end_date" type="date" class=" form-control" placeholder="Select Training end date">

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Department</label>
                                                    <select class="form-control required" id="dept" name="department">
                                                        <option>Select Department</option>
                                                        @foreach($dept as $val)
                                                        <option value="{{$val->id}}">{{$val->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Designation</label>
                                                    <select class="form-control" id="designation" name="designation">
                                                        <option value="">Select Designation</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6">

                                                    <label class="block">Work Experience</label>

                                                    <input name="experience" type="text" class=" form-control" placeholder="Work Experience">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Date of Joining</label>

                                                    <input name="join_date" type="date" class=" form-control">

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                            	<div class="col-sm-6">

                                                    <label class="block">Previous CTC</label>

                                                    <input name="preCTC" type="number" class=" form-control" placeholder="Enter Previous CTC">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Current CTC</label>

                                                    <input name="currCTC" type="number" class=" form-control" placeholder="Enter Current CTC">

                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Select one:</label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" data-type="1" value="1">
                                                                <i class="helper"></i>Bond
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" data-type="2" value="2">
                                                                <i class="helper"></i>Security Deduction
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <label class="block">Professional Tax</label>
                                                    <input name="pTax" type="text" class=" form-control" placeholder="Enter Professional Tax">
                                                </div>
                                                <div class="col-sm-6 nodisplay" id="term1">
                                                    <label class="block">Bond Duration</label>
                                                    <select name="bond_duration" class="form-control">
                                                         <option value="1">1</option>
                                                        <option value="1.5">1.5</option>
                                                        <option value="2">2</option>
                                                        <option value="2.5">2.5</option>
                                                        <option value="3">3</option>
                                                        <option value="3.5">3.5</option>
                                                        <option value="4">4</option>
                                                        <option value="4.5">4.5</option>
                                                        <option value="5">5</option>
                                                    </select><br>
                                                    <label>Bond Duration Date</label>
                                                    <div style="display:flex;">
                                                        <input type="date" class="form-control" name="bondStart"> - <input type="date" class="form-control" name="bondEnd">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 nodisplay" id="term2">
                                                    <label class="block">Deduction Amount</label>
                                                    <input name="deduct_amt" type="text" class="form-control" placeholder="Enter Deduction Amount">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">TDS</label>
                                                    <input name="tds" type="number" class="form-control" placeholder="Enter TDS Amount">
                                                </div>
                                            </div>

                                        </fieldset>

                                        <h3> Documents </h3>

                                        <fieldset>

                                            <div class="form-group row">

                                                <div class="col-sm-12">

                                                    <label class="block">Documents</label>

                                                    <select class="docs" multiple="multiple" name="document_info">

                                                        <option value="10th Marksheet">10th Marksheet</option>

                                                        <option value="12th Marksheet">12th Marksheet</option>

                                                        <option value="Degree Certificate">Degree Certificate</option>

                                                        <option value="Aadhar Card">Aadhar Card</option>

                                                        <option value="Salary Slip">Salary Slip</option>
                                                        <option value="Offer Letter">Offer Letter</option>
                                                        <option value="Experience Letter">Experience Letter</option>
                                                        <option value="Bank Statement">Bank Statement</option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="card">

	                                            <div class="card-header">

	                                                <h5>Upload Documents</h5>

	                                            </div>

	                                            <div class="card-block">

	                                                <input type="file" name="documents[]" id="filer_input" multiple="multiple">

	                                            </div>

	                                        </div>

                                        </fieldset>

                                        <h3> Bank Information </h3>

                                        <fieldset>

                                            <div class="form-group row">

                                            	<div class="col-sm-12">

                                                    <label class="block">Bank Name</label>

                                                    <input name="bank_name" type="text" class="form-control" placeholder="Enter Bank Name">

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                            	<div class="col-sm-12">

                                                    <label class="block">Branch</label>

                                                    <input name="branch_name" type="text" class=" form-control" placeholder="Enter Bank Branch">

                                                </div>

                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-6">

                                                    <label class="block">Account No</label>

                                                    <input name="account_no" type="text" class=" form-control" placeholder="Enter Account No">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">IFSC Code</label>

                                                    <input name="ifsc_code" type="text" class=" form-control" placeholder="Enter IFSC Code">

                                                </div>

                                            </div>

                                            <div style="float:right;margin-top:150px;">
                                                <button type="submit" class="btn btn-primary" style="border-radius: 5px;">Submit</button>
                                            </div>

                                        </fieldset>

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