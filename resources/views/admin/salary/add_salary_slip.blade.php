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
                                    <form id="main" method="post" action="/" novalidate="" >
                                       <!-- {{csrf_field()}} -->
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Date</label>
                                                    <input name="date" type="date" class="form-control date" placeholder="Enter Month Days">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Employee Name</label>
                                                    <select name="emp_id" class="form-control show-tick emp_id">
                                                       <option value="">Select Employee</option>      
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Month Days</label>
                                                    <input name="month_days" type="number" class=" form-control month_days" placeholder="Enter Month Days">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">LWP</label>
                                                    <input name="lwp" type="number" class=" form-control" placeholder="Enter Leave without Paid">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Previous Leave</label>
                                                    <input name="pl" type="number" class="form-control pre_leave" placeholder="Enter Prevoius Leave">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Current Leave</label>
                                                    <input name="cl" type="number" class="form-control curr_leave" placeholder="Enter Current Leave">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Present Days</label>
                                                    <input name="present_days" type="number" class="form-control pd" placeholder="Enter Present Days">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Working Days</label>
                                                    <input name="wd" type="number" class=" form-control wd" placeholder="Enter Working Days">
                                                     <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Basic Salary</label>
                                                    <input name="basic_salary" type="number" class="form-control salary" placeholder="Enter Basic Salary">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Professional Tax</label>
                                                    <input name="pt" type="number" class="form-control" placeholder="Enter Professional Tax" value="{{$data['p_tax']}}">
                                                     <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Security Deduction</label>
                                                    <input name="security_deduction" type="number" class="form-control deduction" placeholder="Enter Security Deduction">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Medical Allowance</label>
                                                    <input name="ma" type="number" class=" form-control" placeholder="Enter Medical Allowance" value="0">
                                                     <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class=" row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Other Allowance</label>
                                                    <input name="oa" type="number" class=" form-control" placeholder="Enter Other Allowance">
                                                     <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Leave Travel Allowance</label>
                                                    <input name="lta" type="number" class=" form-control" placeholder="Enter Leave Travel Allowance">
                                                     <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class=" row">
                                            <div class="col-sm-6 form-group ">
                                                    <label class="block">PF</label>
                                                    <input name="pf" type="number" class=" form-control" placeholder="Enter PF">
                                                     <span class="messages"></span>
                                                </div>
                                            </div>
                                       
                                        <button type="submit" class="btn btn-primary">Submit</button>
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