@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="salary">
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
                                    <form method="post" action="{{URL::to('admin/editsalaryslip/'.$data['salary']->id)}}">
                                       {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Date</label>
                                                    <input name="date" type="date" class="form-control date" placeholder="Enter Month Days" value="{{$data['salary']->date}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Employee Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{$data['salary']->full_name}}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Total Salary</label>
                                                    <input name="total_salary" type="text" class="form-control tsalary" placeholder="Enter Total Salary" value="{{$data['salary']->total_salary}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Basic Salary</label>
                                                    <input name="basic_salary" type="text" class="form-control salary" placeholder="Enter Basic Salary" value="{{$data['salary']->basic_salary}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Conveyance</label>
                                                    <input name="conv" type="text" class="form-control" placeholder="Enter Conveyance Amount" value="{{$data['salary']->conveyance}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">HRA</label>
                                                    <input name="hra" type="number" class="form-control" placeholder="Enter HRA" value="{{$data['salary']->HRA}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Special Allowance</label>
                                                    <input name="sp_allowance" type="number" class="form-control" placeholder="Enter Special Allowance" value="{{$data['salary']->special_allowance}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">TADA</label>
                                                    <input name="tada" type="number" class="form-control" placeholder="Enter TADA" value="{{$data['salary']->TADA}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Month Days</label>
                                                    <input name="month_days" type="number" class=" form-control wd" placeholder="Enter Month Days" value="{{$data['salary']->month_days}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Present Days</label>
                                                    <input name="present_days" type="text" class="form-control pd" placeholder="Enter Present Days" value="{{$data['salary']->present_days}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Payable Days</label>
                                                    <input name="payable_days" type="text" class="form-control taken_leave" value="{{$data['salary']->payable_days}}" placeholder="Enter Payable Days">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Previous Leave</label>
                                                    <input name="pl" type="text" class="form-control pre_leave" placeholder="Enter Prevoius Leave" value="{{$data['salary']->pl}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">No of Leave Taken During Month</label>
                                                    <input name="cl" type="text" class="form-control taken_leave" value="{{$data['salary']->cl}}" placeholder="Enter Taken Leave">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Current Leave Balance</label>
                                                    <input name="leave_balance" type="text" class="form-control" placeholder="Enter Current Leave" value="{{$data['salary']->leave_balance}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Security Deduction</label>
                                                    <input name="security_deduction" type="number" class="form-control deduction" placeholder="Enter Security Deduction" value="{{$data['salary']->security_deduction}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Leave Deduction</label>
                                                    <input name="leave_deduction" type="number" class=" form-control" placeholder="Enter Leave Deduction" value="{{$data['salary']->leave_deduction}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Professional Tax</label>
                                                    <input name="p_tax" type="number" class="form-control" placeholder="Enter Professional Tax" value="{{$data['salary']->professional_tax}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Medical Allowance</label>
                                                    <input name="med_allowance" type="number" class=" form-control" placeholder="Enter Medical Allowance" value="{{$data['salary']->medical_allowance}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Other Allowance</label>
                                                    <input name="other_allowance" type="number" class=" form-control" placeholder="Enter Other Allowance" value="{{$data['salary']->other_allowance}}">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">PF</label>
                                                    <input name="pf" type="number" class=" form-control" placeholder="Enter PF" value="{{$data['salary']->pf}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">TDS</label>
                                                    <input name="tds" type="number" class="form-control" placeholder="Enter TDS" value="{{$data['salary']->tds}}" id="tds">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Total Deduction</label>
                                                    <input name="total_deduction" id="deduction" type="text" class=" form-control" placeholder="Total Deduction"  data-val="{{$data['salary']->total_deduction}}" value="{{$data['salary']->total_deduction}}">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="block">Total Amount</label>
                                                    <input type="text" name="total_amount" class="form-control" id="total" data-val="{{$data['salary']->total_amount}}" value="{{$data['salary']->total_amount}}">
                                                </div>
                                            </div>
                                        
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                        <button type="button"   class="btn btn-default">Reset</button>
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