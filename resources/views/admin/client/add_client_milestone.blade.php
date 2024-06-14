@extends('layouts.default')
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="row">
            <div class="col-sm-12">
                <!-- Basic Form Inputs card start -->
                <div class="card">
                    <!-- <div class="card-header">
                    </div> -->
                    <div class="card-block">
                        <section>
                            <form id="main" method="post" action="/">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label class="block">Project Name</label>
                                        <select class="form-control" name="project">
                                            <option value="">Select Project Name</option>
                                        </select>
                                        <span class="messages"></span>
                                    </div>
                                    <div class="col-sm-6 form-group ">
                                        <label class="block">Client</label>
                                            <select class="form-control" name="firstname">
                                                <option value="">Select Client</option>
                                            </select>
                                            <span class="messages"></span>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label class="block">Email Id</label>
                                        <input  type="email" name="email" id="email" class=" form-control" placeholder="Enter Email Id">
                                        <span class="messages"></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="block">Technology</label>
                                        <select class="form-control" name="technology">
                                            <option value="">Select Technology</option>
                                        </select>
                                        <span class="messages"></span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                    <label class="block">Country</label>
                                        <select class="form-control" name="country">
                                            <option value="">Select Country</option>
                                        </select>
                                    <span class="messages"></span>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="block">Date</label>
                                        <input  type="date" name="date" id="date" class=" form-control" >
                                        <span class="messages"></span>
                                    </div>
                                </div> 
                                <label>Milestone</label>
                                <td>&nbsp<button id='add-new-row' class='btn btn-primary' type='button' value='Add' />Add</button>
                                </td><hr> 
                                <div class="row">
                                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="test-table" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Project Description</th>
                          <th>Date</th>
                          <th>End Date</th>
                          <th>Status</th>
                          <th>Notify</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="test-body">
                        <tr id="row0">
                          <td>
                            <textarea  value='' name="data[0][title]" type='text' size="150" class='form-control input-md' /></textarea>
                          </td>
                          <td>
                            <input type="date" value='' name="data[0][sdate]" type='text'  class='form-control input-md' />
                          </td>
                           <td>
                            <input type="date" value='' name="data[0][edate]" type='text' class='form-control input-md' />
                          </td>
                          <td>
                            <select class="form-control show-tick" name="data[0][sta]" style="width: 150px;">
                            <option value="">Select</option>
                            </select>
                          </td>
                           <td>
                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled"  class='notify-row btn btn-primary'name="data[0][notify]">
                          </td>
                          <td>
                            <button id="delete"  class='delete-row btn btn-primary btndeleterow' type='button' value='Delete' />Delete</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
             <div class="col-sm-12">
                <button type="submit" id="submit" onclick="return validate()" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
            </div>

            </form>
        </section>
</div>
</div>
</div>
                        
    </div>
</div>
@stop