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
    .but {
    font-size: 10px;
    padding: 3px 45px;
    margin: 24px -29px 0px;
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
                                    <form class="wizard-form emp-edit-form" id="example-advanced-form">
                                        <h3> Personal Information </h3>
                                        <fieldset>
                                            <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">First Name</label>
                                                    <input name="fname" type="text" id="fname" class="form-control" placeholder="Enter First Name" value="{{$employee->first_name}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Last Name</label>
                                                    <input name="lname" type="text" id="lname" class=" form-control" placeholder="Enter Last Name" value="{{$employee->last_name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Primary Email</label>
                                                    <input name="email" type="email" id="email" class=" form-control" placeholder="Enter Primary Email" value="{{$employee->email}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Office Email</label>
                                                    <input name="office_email" type="email" id="email" class=" form-control" placeholder="Enter Office Email" value="{{$employee->office_email}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Date of Birth</label>
                                                    <input name="dob" type="date" id="dob" class=" form-control" value="{{$employee->dob}}">
                                                </div>
                                                 <div class="col-sm-6">

                                                    <label class="block">Office Email Password</label>

                                                    <input name="office_email_password" type="text" class="form-control" value="{{base64_decode($employee->office_email_password)}}" placeholder="Enter Office Email Password">

                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Contact No</label>
                                                    <input name="contact" type="number" id="contact" class=" form-control" placeholder="Enter Contact Number" value="{{$employee->contact_no}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Gender</label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Male" @if($employee->gender == 'Male') checked @endif">
                                                                <i class="helper"></i>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Female" @if($employee->gender == 'Female') checked @endif>
                                                                <i class="helper"></i>Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <!--<div class="col-sm-6">
                                                    <label class="block">Image</label>
                                                    <input name="image" type="file" class="form-control">
                                                </div>-->
                                                <div class="col-sm-6">
                                                    <label class="block">Password</label>
                                                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Address</label>
                                                    <textarea class="form-control" name="address"  placeholder="Address"> {{$employee->address}}</textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3> Official Information </h3>
                                        <fieldset style="overflow-y: scroll;">
                                            <!--<div class="form-group row">-->
                                               
                                            <!--</div>-->
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Employee Type</label>
                                                    <select class="form-control required empType" name="emp_type">
                                                        <option>Select Employee Type</option>
                                                        <option value="user" {{$employee->user_type == 'user' ? 'selected' : ''}}>Employee</option>
                                                        <option value="trainee" {{$employee->user_type == 'trainee' ? 'selected' : ''}}>Trainee</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{$employee->status == 1 ? 'selected' : ""}}>Active</option>
                                                        <option value="0" {{$employee->status == 0 ? 'selected' : ""}}>Deactive</option>
                                                       </select>
                                                </div>
                                            </div>

                                            <div class="form-group row nodisplay" id="traineeDur">

                                                <div class="col-sm-6">

                                                    <label class="block">Training Start Date</label>

                                                    <input type="date" class="form-control" name="trainingStart" value="{{$employee->training_start}}">

                                                </div>

                                                <div class="col-sm-6">

                                                    <label class="block">Training End Date</label>

                                                    <input type="date" class="form-control" name="trainingEnd" value="{{$employee->training_end}}">

                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-6">
                                                    <label class="block">Department</label>
                                                    <select class="form-control" id="dept" name="department">
                                                        <option>Select Department</option>
                                                        @foreach($data['dept'] as $val)
                                                        <option value="{{$val->id}}" @if($employee->department_id == $val->id) selected @endif>{{$val->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Designation</label>
                                                    <select class="form-control" id="designation" name="designation">
                                                        <option value="">Select Designation</option>
                                                        @foreach($data['desig'] as $val)
                                                        <option value="{{$val->id}}" @if($employee->designation_id == $val->id) selected @endif>{{$val->designation_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Work Experience</label>
                                                    <input name="experience" type="text" class=" form-control" placeholder="Work Experience" value="{{$employee->experience}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Date of Joining</label>
                                                    <input name="join_date" type="date" class="form-control" value="{{$employee->join_date}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Previous CTC</label>
                                                    <input name="preCTC" type="number" class=" form-control" placeholder="Enter Previous CTC" value="{{$employee->previousCTC}}">
                                                </div>
                                                <div class="col-sm-5">
                                                    <label class="block">Current CTC</label>
                                                    <input name="currCTC" type="number" class=" form-control" placeholder="Enter Current CTC" value="{{$employee->currentCTC}}">
                                                </div>
                                                <div class="but col-sm-1">
                                                  <button  type="button" class="btn btn-sm btn-primary waves-effect get_salary" data-id="{{$employee->id}}" >Add</button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Select one:</label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" data-type="1" value="1" {{$employee->term == 1 ? 'checked' : ""}}>
                                                                <i class="helper"></i>Bond
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" class="term" name="term" data-type="2" value="2" {{$employee->term == 2 ? 'checked' : ""}}>
                                                                <i class="helper"></i>Security Deduction
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <label class="block">Professional Tax</label>
                                                    <input name="pTax" type="text" class=" form-control" placeholder="Enter Professional Tax" value="{{$employee->professional_tax}}">
                                                </div>
                                                <div class="col-sm-6 nodisplay" id="term1">
                                                    <label class="block">Bond Duration</label>
                                                    <select name="bond_duration" class="form-control">
                                                        <option value="1" {{$employee->bond_duration == 1 ? 'selected' : ""}}>1</option>
                                                        <option value="1.5" {{$employee->bond_duration == 1.5 ? 'selected' : ""}}>1.5</option>
                                                        <option value="2" {{$employee->bond_duration == 2 ? 'selected' : ""}}>2</option>
                                                        <option value="2.5" {{$employee->bond_duration == 2.5 ? 'selected' : ""}}>2.5</option>
                                                        <option value="3" {{$employee->bond_duration == 3 ? 'selected' : ""}}>3</option>
                                                        <option value="3.5" {{$employee->bond_duration == 3.5 ? 'selected' : ""}}>3.5</option>
                                                        <option value="4" {{$employee->bond_duration == 4 ? 'selected' : ""}}>4</option>
                                                        <option value="5" {{$employee->bond_duration == 5 ? 'selected' : ""}}>5</option>
                                                    </select><br>
                                                    <label>Bond Duration Date</label>
                                                    <div style="display:flex;">
                                                        <input type="date" class="form-control" name="bondStart" value="{{$employee->bond_start}}"> - <input type="date" class="form-control" name="bondEnd" value="{{$employee->bond_end}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 nodisplay" id="term2">
                                                    <label class="block">Deduction Amount</label>
                                                    <input name="deduct_amt" type="text" class="form-control" placeholder="Enter Deduction Amount" value="{{$employee->deduction_amt}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">TDS</label>
                                                    <input name="tds" type="number" class="form-control" placeholder="Enter TDS Amount" value="{{$employee->tds}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">Last Date</label>
                                                    <input name="last_date" type="date" class="form-control" value="{{$employee->last_date}}">
                                                </div>
                                                 
                                            </div>
                                        </fieldset>
                                        <h3> Documents </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="block">Documents</label>
                                                    <select class="docs" multiple="multiple" name="document_info[]">
                                                        @foreach($document as $val)
                                                        <option value="{{$val['name']}}" @if($val['selected'] == 1) selected @endif>{{$val['name']}}</option>
                                                        @endforeach
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
                                        <h3> Bank Info </h3>
                                        <fieldset>
                                            <input type="hidden" name="bank_id" value="{{$employee->bank_id}}">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="block">Bank Name</label>
                                                    <input name="bank_name" type="text" class="form-control" placeholder="Enter Bank Name" value="{{$employee->bank_name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="block">Branch</label>
                                                    <input name="branch_name" type="text" class="form-control" placeholder="Enter Bank Branch" value="{{$employee->branch_name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="block">Account No</label>
                                                    <input name="account_no" type="text" class=" form-control" placeholder="Enter Account No" value="{{$employee->account_no}}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="block">IFSC Code</label>
                                                    <input name="ifsc_code" type="text" class=" form-control" placeholder="Enter IFSC Code" value="{{$employee->ifsc_code}}">
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
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Salary Detail</h4>
             <div></div><button type="button" class="btn btn-sm btn-primary waves-effect waves-light " id="addsalary">Add New

                        </button> 
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                    <!-- <span aria-hidden="true">&times;</span> -->
                    </div>
                    <div class="modal-body">
                            <div id="" class="salary-form modal-body" style="display: none;">
                    <form method="post" action="/" id="add_salary">
                     <input type="hidden" id="employee_salary_id" value="{{$employee->id}}">
                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <label class="block">Year</label>
                                                    <select class="form-control required" id="year" name="year" Required>
                                                        
                                                        <option value="">Select Year</option>
                                                        
                                                        @foreach ($data['years'] as $y)
                                                            <option value="{{$y}}">{{ $y }}</option>
                                                        @endforeach  
                                                    </select>
                                                    <span class="messages"  ><p style="display: none" id="year_msg" class="text-danger error">Please select year</p></span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="block">Salary</label>
                                                    <input name="salary_amount" id="salary_amount" type="number" class=" form-control" placeholder="Enter Salary" min="1" Required>
                                                    <span class="messages"  ><p style="display: none" id="salary_msg" class="text-danger error">Enter Amount</p></span>
                                                   
                                                </div>
                                               <div class="but col-sm-4">
                                                  <button type="button" class="btn btn-sm btn-primary waves-effect" id="emp_salary">Submit</button>
                                                  <button type="button" class="btn  btn-sm btn-primary waves-effect waves-light reset-close"  id="closesalary">Cancel
                        </button>
                                                </div>
                                            </div>
                        </form>
                        <hr>
                        </div>
                            <table class="table table-styling table-xs">

                            <div class="form-group row">
                            <thead>
                          <tr class="table-primary">
                            <th>Sr No.</th>
                           <th>Year</th>
                           <th>Salary</th>
                          </tr>

                        </thead>
                        <tbody id="salary_details">
                         <tr>
                            <td>
                            </td>
                         </tr>
                        </tbody>
                       </div>
                      </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light ">Submit</button> -->
                    </div>
        </div>
    </div>
</div>
@stop