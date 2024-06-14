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
   .error{
  color:red;
}
.nodisplay {
        display: none;
    }
    .display {
        display: all;
    }
    .error_message{
    color:red !important;
}
.error_message1{
    color:red ;
}
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="project">
<input type="hidden" id="project_id" value="">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <div class="page-body">
         <div class="row">
            <div class="col-sm-12">
               <!-- Basic Form Inputs card start -->
               <form class="project_form" id="project_form" method="post" action="" novalidate="" enctype="multipart/form-data">
               <div class="card">
                  <div class="card-header">
                      <div class="card-header-left">
                                <b>Basic Information</b>
                            </div>
                  </div>
                  <div class="card-block">
                     <!--<div id="wizard1">-->
                     <!--   <section>-->
                            <div class="row">
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Clients<span class="error">*</span></label>
                                    <select name="client_id" id="client_id" class="client_id form-control show-tick">
                                       <option value="">Select Client</option>
                                       @foreach($data['client_list'] as $row)
                                            <option value="{{$row->id}}">{{$row->full_name}}</option>
                                                    
                                         @endforeach 
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Logo</label>
                                    <input class="form-control" type="file" name="project_logo" id="project_logo">
                                    <span class="messages"></span>
                                 </div>
                              </div>
                              <div class="row">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-sm-6 form-group ">
                                    <label class="block">Project Name<span class="error">*</span></label>
                                    <input name="project_name" type="text" class=" form-control" placeholder="">
                                    <span class="error"></span>
                                 </div>
                                 <div class="col-sm-6 form-group ">
                                    <label class="block">Project Description<span class="error">*</span></label>
                                    <textarea class="form-control" name="project_description"  placeholder=""></textarea>
                                    <span class="messages"></span>
                                 </div>
                              </div>
                             
                              <div class="row">
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Start Date<span class="error">*</span></label>
                                    <input name="start_date" type="date" class=" form-control">
                                    <span class="messages"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">End Date<span class="error">*</span></label>
                                    <input name="end_date" type="date" class=" form-control">
                                    <span class="messages"></span>
                                 </div>
                              </div>
                              <div class="row">
                                   <div class="col-sm-6 form-group">
                                    <label class="block">Color</label>
                                    <select name="color" id="color" class="form-control show-tick">
                                        <option value="">Select</option>
                                      @foreach(getColorOfProject() as $key=>$row)
                                         <option value="{{$key}}">{{$row}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              </div>
                              </div>
                               <div class="card">
                                  <div class="card-header">
                                      <div class="card-header-left">
                                                <b>Project Information</b>
                                            </div>
                                  </div>
                                  <div class="card-block">
                              <div class="row">
                                   <div class="col-sm-6 form-group">
                                    <label class="block">Technology<span class="error">*</span></label>
                                    <select name="technology_id[]" class="technology_id select2" id="technology_id" multiple="multiple">
                                               
                                                    @foreach(GetTechologiesList() as $k=>$row)
                                                    <option value="{{$k}}">{{$row}}</option>
                                                    @endforeach      
                                                </select>
                                    <span class="error_message"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Project Manager<span class="error">*</span></label>
                                    <select name="project_manager_id" id="project_manager_id" class="form-control show-tick" >
                                       <option value="">Select</option>
                                        @foreach($data['employee_list'] as $row)
                                            <option value="{{$row->id}}">{{$row->full_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6 form-group">
                                    <label class="block">Project Report<span class="error">*</span></label>
                                    <select name="project_report_id" id="project_report_id" class="form-control show-tick" >
                                        <option value="">Select</option>
                                       @foreach($data['employee_list'] as $row)
                                            <option value="{{$row->id}}">{{$row->full_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                  <div class="col-sm-6 form-group "  id="other_skill" >
                                    <label class="block">Team Member<span class="error">*</span></label>
                                    <select name="employee_id[]" class="skill select2 " id="team_member" multiple="multiple" required>
                                   
                                        @foreach($data['employee_list'] as $row)
                                        <option value="{{$row->id}}">{{$row->full_name}}</option>
                                        @endforeach      
                                    </select>
                                    <span class="error_message1"></span>
                                 </div>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="card">
                                  <div class="card-header">
                                      <div class="card-header-left">
                                                <b>Project Status</b>
                                            </div>
                                  </div>
                                  <div class="card-block">
                                      <div class="row">
                                         <div class="col-sm-6 form-group">
                                            <label class="block">Project Status<span class="error">*</span></label>
                                            <select name="project_status" id="project_status" class="form-control show-tick">
                                               <option value="">Select</option>
                                               @foreach(GetProjectStatusList() as $k=>$row)
                                               <option value="{{$k}}">{{$row}}</option>
                                               @endforeach
                                            </select>
                                            <span class="messages"></span>
                                         </div>
                                         <div class="col-sm-6 form-group">
                                            <label class="block">Project Priority<span class="error">*</span></label>
                                            <select name="project_priority" id="project_priority" class="form-control show-tick " >
                                                <option value="">Select</option>
                                                <option value="1">High</option>
                                                <option value="2">Medium</option>
                                                <option value="3">Low</option>
                                              
                                            </select>
                                            <span class="messages"></span>
                                         </div>
                                </div>
                                </div>
                                </div>
                                <div class="card">
                                  <div class="card-header">
                                      <div class="card-header-left">
                                                <b>Project Milestone</b>
                                            </div>
                                  </div>
                                  <div class="card-block">
                              <div class="row">
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Project Type<span class="error">*</span></label>
                                    <select name="project_type" id="project_type" class="form-control show-tick project_type" >
                                        <option value="">Select</option>
                                       @foreach(getProjectType() as $key=>$row)
                                         <option value="{{$key}}">{{$row}}</option>
                                       @endforeach
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                
                                  <div class="col-sm-6 form-group nodisplay" id="project_type1">
                                    <label class="block">Project Hour</label>
                                    <input type="text" name="hour_rate" class="form-control">
                                 </div>

                                 <div class="col-sm-6 form-group nodisplay" id="project_type2">
                                    <label class="block">Project Amount</label>
                                    <input type="text" name="project_amount" class="form-control">
                                 </div>
                                
                              </div>
                              
                             <label class="nodisplay project_type3" id="project_type3">Milestone</label>
                                <hr class="nodisplay project_type3" id="project_type3"> 
                                <div class="row ">
                                <div class="col-md-12 nodisplay project_type3" id="project_type3">
                  <div class="table-responsive">
                    <table id="test-table" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Milestone Description</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Status</th>
                          <th>Notify</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="test-body">
                        <tr id="row0" class="text-center"> 
                          <td>
                            <textarea  value='' name="milestone[0][title]" type='text' size="150" class='form-control input-md' /></textarea>
                          </td>
                          <td>
                            <input type="date" value='' name="milestone[0][sdate]" type='text'  class='form-control input-md' />
                          </td>
                           <td>
                            <input type="date" value='' name="milestone[0][edate]" type='text' class='form-control input-md' />
                          </td>
                          <td>
                            <select class="form-control show-tick" name="milestone[0][status]">
                            <option value="">Select</option>
                            <option value="0">Active</option>
                            <option value="1">Compelete</option>
                            <option value="2">Deactive</option>
                            <option value="3">Hold</option>
                            <option value="4">InProgress</option>
                            <option value="5">Paid</option>
                            <option value="6">Sleep</option>
                            </select>
                          </td>
                           <td>
                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class='notify-row btn btn-primary'name="milestone[0][notify]" value="1">
                          </td>
                          <td><button id='add-new-row' class='btn btn-sm btn-primary' type='button' value='Add' /><span class="icofont icofont-plus"></span></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
             <!--<div class="col-sm-12">-->
                <button type="submit" class="btn btn-primary submit_project" onclick="checkProjectValidation()">Submit</button>
                <button type="reset"   class="btn btn-default d-none">Reset</button>
              
            <!--</div>-->
                              
                           </form>
                        <!--</section>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop