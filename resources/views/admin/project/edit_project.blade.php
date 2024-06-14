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
                  
                  <?php $details = isset($data['project_details'])?$data['project_details']:"";?>
                  <input type="hidden" name="project_id" value="{{$details->id}}" id="project_id">
                  <input type="hidden" name="old_project_logo" value="{{$details->project_logo}}" id="old_project_logo">
                  <div class="card-block">
                     <!--<div id="wizard1">-->
                     <!--   <section>-->
                            <div class="row">
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Clients<span class="error">*</span></label>
                                    <select name="client_id" id="client_id" class="client_id form-control show-tick">
                                       <option value="">Select Client</option>
                                       @foreach($data['client_list'] as $row)
                                            <option value="{{$row->id}}" <?php echo (isset($details->client_id) && ($details->client_id == $row->id))?"selected":""?> >{{$row->full_name}}</option>
                                                    
                                         @endforeach 
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Logo</label>
                                    <input class="form-control" type="file" name="project_logo" id="project_logo">
                                    <a target="_blank" href="{{URL::to('/uploads/project_logo/'.$details->project_logo)}}">{{$details->project_logo}}</a>
                                    <span class="messages"></span>
                                 </div>
                              </div>
                              <div class="row">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-sm-6 form-group ">
                                    <label class="block">Project Name<span class="error">*</span></label>
                                    <input name="project_name" type="text" class=" form-control" value="{{ isset($details->project_name)?$details->project_name:''}}">
                                    <span class="error"></span>
                                 </div>
                                 <div class="col-sm-6 form-group ">
                                    <label class="block">Project Description<span class="error">*</span></label>
                                    <textarea class="form-control" name="project_description"  value="{{ isset($details->project_description)?$details->project_description:''}}">{{ isset($details->project_description)?$details->project_description:''}}</textarea>
                                    <span class="messages"></span>
                                 </div>
                              </div>
                             
                              <div class="row">
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Start Date<span class="error">*</span></label>
                                    <input name="start_date" type="date" value="{{ isset($details->start_date)?$details->start_date:''}}" class=" form-control">
                                    <span class="messages"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">End Date<span class="error">*</span></label>
                                    <input name="end_date" type="date" value="{{ isset($details->end_date)?$details->end_date:''}}" class=" form-control">
                                    <span class="messages"></span>
                                 </div>
                              </div>
                              <div class="row">
                                   <div class="col-sm-6 form-group">
                                    <label class="block">Color</label>
                                    <select name="color" id="color" class="form-control show-tick">
                                        <option value="">Select</option>
                                      @foreach(getColorOfProject() as $key=>$row)
                                         <option <?php echo (isset($details->color) && ($details->color == $key))?"selected":""?> value="{{$key}}">{{$row}}</option>
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
                                   <?php  $technology = isset($details->technology_id) && $details->technology_id != ''?json_decode($details->technology_id):[]; 
                                          if(!is_array($technology)) {
                                              $technology = [];
                                          }
                                   ?>
                                    
                                    <select name="technology_id[]" class="technology_id select2" id="technology_id" multiple="multiple">
                                               
                                        @foreach(GetTechologiesList() as $k=>$row)
                                        <option <?php echo (isset($details->technology_id) && in_array($k, $technology) ) ? 'selected="selected"' : "" ?> value="{{$k}}">{{$row}}</option>
                                        @endforeach      
                                    </select>
                                    <span class="error_message"></span>
                                 </div>
                                 <div class="col-sm-6 form-group">
                                    <label class="block">Project Manager<span class="error">*</span></label>
                                    <select name="project_manager_id" id="project_manager_id" class="form-control show-tick" >
                                       <option value="">Select</option>
                                        @foreach($data['employee_list'] as $row)
                                            <option <?php echo (isset($details->project_manager_id) && ($details->project_manager_id == $row->id))?"selected":""?> value="{{$row->id}}">{{$row->full_name}}</option>
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
                                            <option <?php echo (isset($details->project_report_id) && ($details->project_report_id == $row->id))?"selected":""?> value="{{$row->id}}">{{$row->full_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                  <div class="col-sm-6 form-group "  id="other_skill" >
                                      <?php $employee_id = json_decode($details->employee_id); ?>
                                    <label class="block">Team Member<span class="error">*</span></label>
                                    <select name="employee_id[]" class="skill select2 " id="team_member" multiple="multiple" required>
                                   
                                        @foreach($data['employee_list'] as $row)
                                        <option <?php echo (isset($details->employee_id) && in_array($row->id, $employee_id) ) ? 'selected="selected"' : "" ?> value="{{$row->id}}">{{$row->full_name}}</option>
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
                                               <option <?php echo (isset($details->project_status) && ($details->project_status == $k))?"selected":""?> value="{{$k}}">{{$row}}</option>
                                               @endforeach
                                            </select>
                                            <span class="messages"></span>
                                         </div>
                                         <div class="col-sm-6 form-group">
                                            <label class="block">Project Priority<span class="error">*</span></label>
                                            <select name="project_priority" id="project_priority" class="form-control show-tick " >
                                                <option value="">Select</option>
                                                <option <?php echo (isset($details->project_priority) && ($details->project_priority == 1))?"selected":""?> value="1">High</option>
                                                <option <?php echo (isset($details->project_priority) && ($details->project_priority == 2))?"selected":""?> value="2">Medium</option>
                                                <option <?php echo (isset($details->project_priority) && ($details->project_priority == 3))?"selected":""?> value="3">Low</option>
                                              
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
                                         <option <?php echo (isset($details->project_type) && ($details->project_type == $key))?"selected":""?> value="{{$key}}">{{$row}}</option>
                                       @endforeach
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                                 @php
                                $display1 = $display2 = $display3 = "";
                               
                                if($details->project_type == 0){
                                    $display1 .= 'display';
                                }else{
                                    $display1 .= 'nodisplay';
                                }
                                if($details->project_type == 1){
                                    $display2 .= 'display';
                                }else{
                                    $display2 .= 'nodisplay';
                                }
                                if($details->project_type == 2){
                                    $display3 .= 'display';
                                }else{
                                    $display3 .= 'nodisplay';
                                }
                                 @endphp
                                  <div class="col-sm-6 form-group {{$display1}}" id="project_type1">
                                    <label class="block">Project Hour</label>
                                    <input type="text" name="hour_rate" class="form-control" value="{{ isset($details->hour_rate)?$details->hour_rate:''}}">
                                 </div>
                                
                                 <div class="col-sm-6 form-group {{$display2}}" id="project_type2">
                                    <label class="block">Project Amount</label>
                                    <input type="text" name="project_amount" class="form-control" value="{{ isset($details->project_amount)?$details->project_amount:''}}">
                                 </div>
                               
                              </div>
                              
                             <label class="project_type3 {{$display3}}" id="project_type3">Milestone</label>
                                <hr class="project_type3 {{$display3}}" id="project_type3"> 
                                <div class="row ">
                                <div class="col-md-12 project_type3 {{$display3}}" id="project_type3">
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
                          <?php 
                          if($details->project_type == 2){
                          foreach($data['milestone'] as $key=>$row){  ?>
                        <tr id="row{{$key}}" class="row_{{$row->id}}" class="text-center"> 
                          <td>
                              <input type="hidden" name="milestone[{{$key}}][m_id]" value="{{$row->id}}">
                            <textarea name="milestone[{{$key}}][title]" type='text' size="150" value="{{$row->title}}" class='form-control input-md' />{{$row->title}}</textarea>
                          </td>
                          <td>
                            <input type="date"  name="milestone[{{$key}}][sdate]" type='text' value="{{$row->start_date}}"  class='form-control input-md' />
                          </td>
                           <td>
                            <input type="date" name="milestone[{{$key}}][edate]" type='text' value="{{$row->end_date}}" class='form-control input-md' />
                          </td>
                          <td>
                            <select class="form-control show-tick" name="milestone[{{$key}}][status]">
                            <option value="">Select</option>
                            <?php foreach(ProjectStatus() as $k=>$row1){ ?>
                            <option <?php echo (isset($row->status) && ($row->status == $k))?"selected":""?> value="{{$k}}">{{$row1}}</option>
                            <?php } ?>
                            </select>
                          </td>
                           <td>
                            <input type="checkbox" <?php echo (isset($row->notify) && ($row->notify == 1))?"checked":""?> data-toggle="toggle" data-on="Enabled" data-off="Disabled" class='notify-row btn btn-primary'name="milestone[{{$key}}][notify]" value="1">
                          </td>
                          <td>
                              
                              @if($key == 0)
                              <button id='add-new-row' class='btn btn-sm btn-primary' type='button' value='Add' data-id="{{$key}}" /><span class="icofont icofont-plus"></span></button>
                                @else
                                <button class='remove-milestone btn btn-sm btn-danger' type='button' data-id="{{$row->id}}" /><span class="icofont icofont-ui-delete"></span></button>
                                @endif
                          </td>
                        </tr>
                        <?php } } else{ ?>
                        <tr id="row0" class="" class="text-center"> 
                          <td>
                             <textarea name="milestone[0][title]" type='text' size="150" value="" class='form-control input-md' /></textarea>
                          </td>
                          <td>
                            <input type="date"  name="milestone[0][sdate]" type='text' value=""  class='form-control input-md' />
                          </td>
                           <td>
                            <input type="date" name="milestone[0][edate]" type='text' value="" class='form-control input-md' />
                          </td>
                          <td>
                            <select class="form-control show-tick" name="milestone[0][status]">
                            <option value="">Select</option>
                            <?php foreach(ProjectStatus() as $k=>$row1){ ?>
                            <option value="{{$k}}">{{$row1}}</option>
                            <?php } ?>
                            </select>
                          </td>
                           <td>
                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class='notify-row btn btn-primary'name="milestone[0][notify]" value="1">
                          </td>
                          <td>
                              
                             
                              <button id='add-new-row' class='btn btn-sm btn-primary' type='button' value='Add'  /><span class="icofont icofont-plus"></span></button>
                               
                          </td>
                        </tr>
                        <?php } ?>
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