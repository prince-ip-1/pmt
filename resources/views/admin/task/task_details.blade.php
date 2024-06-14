<?php //if(isset( $task_details) && !empty( $task_details)){ ?> 
         <div class="modal fade  " id="view-task-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content view-modal-content" style="
    ">
          <!--width: 1200px;margin-left: -24%;-->
         <div class="modal-header">
            <h4 class="modal-title" style="text-align:justify"></h4>
             <button type="button" class="btn  btn-default waves-effect md-close" data-dismiss="modal">Close</button>
         </div>
         <div class="modal-body">
            
               <div class="row">
                  <div class="col-md-8" style="text-align: justify;">
                    
                     <h6 class="m-b-5 f-w-600 mt-1">Description :</h6>
                     <span id="description_div"></span>
                  </div>
                  <div class="col-md-4">
                     <table class="table table-responsive">
                        <tr>
                              <th>Start Date</th>
                              <td id="start_date_div"></td>
                           </tr>
                           <tr>
                              <th>End Date</th>
                              <td id="end_date_div"></td>
                           </tr>
                           <tr>
                              <th>Report To</th>
                              <td id="report_to_div"></td>
                           </tr>
                           <tr>
                              <th>Assign To QA</th>
                              <td id="assign_to_qa_div"></td>
                           </tr>
                            <tr>
                              <th>Priority</th>
                              <td id="priority_div"></td>
                            </tr>
                            <tr>
                              <th>Status</th>
                              <td>
                               <div data-status="" id="status_div" ></div>
                              </td>
                            </tr>
                        
                            <tr>
                                <th>Assign To Dev</th>
                                <td>
                                     <div  id="assign_to_div" class="kanban-footer d-flex mt-1">
                                 
                                    </div>
                                </td>
                                
                            </tr>
                            
                         </table>
                     <div class="row">
                        <div class="col-sm-6 text-center">
                            <input type="hidden" name="task_start_time" id="task_start_time">
                           <input type="hidden" name="task_pre" id="task_pre">
                          
                           <button class="btn btn-sm btn-primary start_task_tracking" data-type="0" type="button">Start Tracking</button>
                           <p class="" id="task_start_time_div"></p>
                        </div>
                        <div class="col-sm-6 text-center">
                          
                           <button class="btn btn-sm btn-success mark_as_done_task" id="mark_as_done" data-status="3" data-type="mark_as_done" type="button">Mark As Done</button>
                        </div>
                        </div>
                        
                     </div>
                  </div>
              
               <hr>
               <div class="row">
                  <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                            <h6 class="m-b-5 f-w-600 card-block">Comments <span class="comment_list_count" data-total-comment=""></span>
                            </div>
                            <div class="col-md-5">
                                   <input type="hidden" value="" id="t_id">
                                   <select class="form-control emp_list" name="emp_id" id="emp_list2">
                                       
                                   </select>
                            </div>
                                    <div class="col-md-3">
                              <button type="button" class="f-right f-13 btn btn-warning btn-task-comment waves-effect waves-light add_comment " data-id="" data-add="Post">
                               Add Comment
                               </button>
                               </div>
                            </h6>
                        </div>
                     <div class="card-block user-box comment-box">
                         <div class="media add_comment_div d-none ">
                              <a class="media-left" href="#">
                              <img class="media-object img-radius m-r-20 comment-img" src="{{ getUserImage() }}" alt="">
                              </a>
                              <div class="media-body">
                                 <form class="task_comments_form" method="post" >
                                     <input type="hidden" id="task_id" value="">
                                     <input type="hidden" id="comment_id" value="">
                                     <input type="hidden" id="table_name" value="comments">
                                    <div class="">
                                      
                                      <textarea id="add_comment" class="add_comment" name="comments"></textarea>
                                      <div class="error_msg error"></div>
                                       <button type="button" id="submit_task" class="btn  btn-primary waves-effect btn-sm close_comment" disabled="disabled">Post</button>
                                       <button type="button" class="btn  btn-default waves-effect btn-sm close_comment">Close</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                          <div class="comment_list_div mt-1 " data-total-tracking="">
                              
                          </div>
                          </div>
                       
                    
                  </div>
                   <div class="col-md-6">
                       <div class="row">
                           <div class="col-md-6">
                                <h6 class="m-b-5 f-w-600 card-block">Tracker Time Entries <span class="task_tracking_count"></span> 
                    
                           </div>
                           <div class="col-md-6">
                               <input type="hidden" value="" id="t_id">
                               <select class="form-control emp_list" name="emp_id" id="emp_list">
                                   
                               </select>
                           </div>
                       </div>
                
                       <!--  <button type="button" class=" text-muted f-right f-13 btn btn-default btn-task waves-effect waves-light ">
                        Add
                        </button> -->
                     </h6>

                     <div class="card-block user-box task_tracking_div tracking-box">
                     </div>      
                        
                  </div>
                   <hr>
                  
               </div>
            
         </div>
         <?php //} ?>
     </div>
   </div>
</div>