<style type="text/css">
   label.error,label span.error,.error_message,.error_message1,.error_message2,.task_error,.description_error{
      color: red !important;
   }
 
</style>
   <div class="modal fade"  id="add-task-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" style="width: 1040px;">
         <div class="modal-header">
            <h4 class="modal-title task_model_title">Task Details</h4>
         </div>
         
         <form class="" id="task_form" method="post" action="/" novalidate="" enctype="multipart/form-data">
                 
         <div class="modal-body">
            <div class="card-block">
                <input type="hidden" name="table_name" value="tasks" id="table_name">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <input type="hidden" name="task_id" id="task_id" value="">
                 <input type="hidden" name="is_delete" id="delete_task_id" value="1">
                 <input type="hidden" name="tab_id" id="tab_id" value="">
                 <input type="hidden" id="change_status" value="">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-4">
                              <label>Planned Duration<span class="error">*</span></label>
                              <select id="duration" name="duration" class="form-control ">
                                 <option value="">Select Duration</option>
                                 <option value="900">0h 15min&nbsp;&nbsp;</option>
                                 <option value="1800">0h 30min&nbsp;&nbsp;</option>
                                 <option value="2700">0h 45min&nbsp;&nbsp;</option>
                                 <option value="3600">1h 00min&nbsp;&nbsp;</option>
                                 <option value="4500">1h 15min&nbsp;&nbsp;</option>
                                 <option value="5400">1h 30min&nbsp;&nbsp;</option>
                                 <option value="6300">1h 45min&nbsp;&nbsp;</option>
                                 <option value="7200">2h 00min&nbsp;&nbsp;</option>
                                 <option value="8100">2h 15min&nbsp;&nbsp;</option>
                                 <option value="9000">2h 30min&nbsp;&nbsp;</option>
                                 <option value="9900">2h 45min&nbsp;&nbsp;</option>
                                 <option value="10800">3h 00min&nbsp;&nbsp;</option>
                                 <option value="12600">3h 30min&nbsp;&nbsp;</option>
                                 <option value="14400">4h 00min&nbsp;&nbsp;</option>
                                 <option value="16200">4h 30min&nbsp;&nbsp;</option>
                                 <option value="18000">5h 00min&nbsp;&nbsp;</option>
                                 <option value="19800">5h 30min&nbsp;&nbsp;</option>
                                 <option value="21600">6h 00min&nbsp;&nbsp;</option>
                                 <option value="23400">6h 30min&nbsp;&nbsp;</option>
                                 <option value="25200">7h 00min&nbsp;&nbsp;</option>
                                 <option value="27000">7h 30min&nbsp;&nbsp;</option>
                                 <option value="28800">8h 00min&nbsp;&nbsp;</option>
                                 <option value="32400">9h 00min&nbsp;&nbsp;</option>
                                 <option value="36000">10h 00min&nbsp;&nbsp;</option>
                                 <option value="43200">12h 00min&nbsp;&nbsp;</option>
                                 <option value="50400">14h 00min&nbsp;&nbsp;</option>
                                 <option value="57600">16h 00min&nbsp;&nbsp;</option>
                                 <option value="64800">18h 00min&nbsp;&nbsp;</option>
                                 <option value="72000">20h 00min&nbsp;&nbsp;</option>
                                 <option value="86400">24h 00min&nbsp;&nbsp;</option>
                                 <option value="other">other</option>
                              </select>
                               <span class="messages"></span>
                           </div>
                           <div class="col-md-4">
                              <label>Start Date<span class="error">*</span></label>
                              <input name="start_date" id="task_start_date" type="date" class=" form-control" placeholder="">
                              <span class="messages"></span>
                           </div>
                           <div class="col-md-4">
                              <label>End Date<span class="error">*</span></label>
                              <input name="end_date" id="task_end_date" type="date" class=" form-control" placeholder="">
                              <span class="messages"></span>
                           </div>
                        </div>
                        <div class="row mt-1">
                           <div class="col-sm-12 form-group ">
                              <label>Title<span class="error">*</span></label>
                              <input name="task_title" id="task_title" type="text" class=" form-control" placeholder="Task Title" >
                              <span class="messages"></span>
                              <div class="task_error"></div>
                           </div>
                           <div class="col-sm-12 form-group ">
                               <div class="QB-PanelName"><label>Description<span class="error">*</span></label>
                                 <textarea name="task_description" id="summernote" rows="5" cols="40"></textarea> 
                                  <span class="error_message"></span>
                                  <div class="description_error"></div>
                                  
                            </div>
                           </div>
                           </div>
                           <div class="row">
                               <div class="col-sm-6 form-group ">
                           <label>Status</label>
                           <select class="form-control" name="status" id="tab_status">
                              @foreach(getTaskStatus() as $key=>$row)
                              <option value="{{$key}}">{{$row}}</option>
                              @endforeach 
                           </select>
                           
                        </div>
                           <div class="col-sm-6 form-group ">
                                <label>Priority</label>
                           <div class="form-radio">
                              <div class="radio radiofill radio-danger radio-inline">
                                 <label>
                                 <input type="radio" name="priority" value="h" class="priority">
                                 <i class="helper"></i>High
                                 </label>
                              </div>
                              <div class="radio radiofill radio-warning radio-inline">
                                 <label>
                                 <input type="radio" name="priority"  value="m" class="priority">
                                 <i class="helper"></i>Medium
                                 </label>
                              </div>
                              <div class="radio radiofill radio-info radio-inline">
                                 <label>
                                 <input type="radio" name="priority"  value="l" class="priority">
                                 <i class="helper"></i>Low
                                 </label>
                              </div>
                               <span class="messages"></span>
                           </div>
                          
                       </div>
                        </div>
                     </div>
                       
                     <div class="col-md-4">
                        <div class="row" style="display: block;">
                           
                              <label>Assign To Dev<span class="error">*</span></label>
                              <select name="assign_to[]" class="emp_id select2" id="emp_id" multiple="multiple">
                                 <option value="">Select</option>
                                 @foreach(EmployeeList() as $row)
                                 
                                 <option value="{{$row->id}}">{{$row->full_name}}</option>
                                 @endforeach   
                              </select>
                            <span class="error_message1"></span>
                          </div>
                       
                        <div class="row mt-1">
                           <label>Report To<span class="error">*</span></label>
                           <select class="form-control" id="report_to" name="report_to">
                              <option value="">Select</option>
                              @foreach(EmployeeList() as $row)
                              <option value="{{$row->id}}">{{$row->full_name}}</option>
                              @endforeach 
                           </select>
                            <span class="messages"></span>
                        </div>
                        <div class="row mt-1">
                        <label>Assign To QA<span class="error">*</span></label>
                        <select name="assign_to_qa[]" class="assign_to_qa select2" id="assign_to_qa" multiple="multiple">
                           
                           @foreach(EmployeeList(3) as $row)
                           <option value="{{$row->id}}">{{$row->full_name}}</option>
                           @endforeach  
                           <option value="-1">None</option> 
                        </select>
                        <span class="messages"></span>
                        </div>
                        <div class="row mt-1">
                           <label>Task Type</label>
                           <select class="form-control" id="task_type" name="task_type">
                              <option value="1">Feature</option>
                              <option value="2">Bug</option>
                           </select>
                            <span class="messages"></span>
                        </div>
                        <div class="row mt-1">
                           <div class="form-group ">
                              <div class="border-checkbox-group border-checkbox-group-primary">
                                 <input class="border-checkbox" value="1" name="is_notify" type="checkbox" id="is_notify">
                                 <label class="border-checkbox-label" for="is_notify">Notify</label>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary waves-effect submit_btn" onclick="checkButton()">Save</button>
             @php
                        $usersession = Session('user_data');
                        $userdata = EmployeeDetailById($usersession->id);
                        $permission = $userdata->permissions;
                              
                    @endphp
                     @if(isset($permission[12]->delete) && $permission[12]->delete == 1 || getDepartment() == 1)
            <button type="button" class=" btn btn-danger waves-effect delete_task_btn" data-id="">Delete</button>
            @endif
            <button type="button" class="btn  btn-default waves-effect md-close " data-dismiss="modal">Close</button>
         </div>
         </form>
      </div>
   </div>
</div>