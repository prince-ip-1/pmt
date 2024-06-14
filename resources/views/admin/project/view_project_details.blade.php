<style type="text/css">
  .img-radius{
   width:40px;
   }		
   .font{
   	font-size: smaller;
   }
   .logo{
   	padding:6px 7px !important;
   }
   .btn-default{
   	background-color: white;
   }
   .bar {
  display: -webkit-box;
  width:353px;
  overflow: hidden;
  text-overflow: ellipsis;
}
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
table td{
        word-wrap:break-word;
        white-space:inherit;
     
}
</style>
@extends('layouts.default')
@section('content')
 
<div class="main-body">
   <div class="page-wrapper">
      @include('includes.breadcrumb')
      <div class="page-body">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-block">
                     <div class="row">
                        <div class="col-md-6">
                        	<b>Project Name : </b>
                        	  @if($data['project_details']->project_name == "")
                        	    <span>-</span>
                        	  @else
                        	    <span>{{$data['project_details']->project_name}}</span><br>
                        	  @endif
                        	<span><b>Client Name : </b>
                        	  @if($data['project_details']->client_name == "")
                        	    <span>-</span>
                        	 @else
                        	    <span>{{$data['project_details']->client_name}}</span>
                        	 @endif
                        	</span><br>
                        	<span><b>Project Manager : </b>
                             @if($data['project_details']->creator_name == "")
                        	    <span>-</span>
                        	 @else
                        	    <span>{{$data['project_details']->creator_name}}</span>
                        	 @endif
                        	</span><br>
                        	<span><b>Reporter Name : </b>
                        	@if($data['project_details']->reporter_name == "")
                        	    <span>-</span>
                        	@else
                        	    <span>{{$data['project_details']->reporter_name}}</span>
                        	@endif
                        	</span>
                        </div>
                        <div class="col-md-2">
                        	<b>Start Date</b><br>
                        	@if($data['project_details']->start_date == "")
                        	    <span>-</span>
                        	@else
                        	    <span>{{dateformat($data['project_details']->start_date)}}</span>
                        	@endif
                        </div>
                        <div class="col-md-2">
                        	<b>Due Date</b><br>
                        	@if($data['project_details']->end_date == "")
                        	    <span>-</span>
                        	@else
                        	    <span>{{dateformat($data['project_details']->end_date)}}</span>
                        	@endif
                        </div>
                        <div class="col-md-2">
                        	<b>Project Status</b><br>
                        	@if($data['project_details']->project_status == "")
                        	    <span>-</span>
                        	@else
                        	@if($data['project_details']->project_status == 0)
                        	<label class="label label-success">Active</label>
                            @elseif($data['project_details']->project_status == 1)
                               <label class="label label-success">Complete</label>
                            @elseif($data['project_details']->project_status == 2)
                               <label class="label label-warning">Deactive</label>
                            @elseif($data['project_details']->project_status == 3)
                               <label class="label label-danger">Hold</label>
                            @elseif($data['project_details']->project_status == 4)
                               <label class="label label-success">InHouse</label>
                            @elseif($data['project_details']->project_status == 5)
                               <label class="label label-success">InProgress</label>
                            @elseif($data['project_details']->project_status == 6)
                               <label class="label label-warning">Sleep</label>
                            @elseif($data['project_details']->project_status == 7)
                               <label class="label label-warning">Cancel</label>
                            @elseif($data['project_details']->project_status == 8)
                               <label class="label label-warning">Other</label>
                            @endif
                            @endif
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                        	<label><b>Team Members</b></label>
                        	<div class="row">
                        		<div class="col-md-6">
		                           @foreach($data['project_details']->team_members as $key=>$val)
		                           <img src="{{getImagePath($val['image'],'users')}}"  class="" style="border-radius:5px;width:30px;height:30px;" title="{{$val['full_name']}}">
		                           @endforeach
                       			</div>
                   			</div>
                        </div>
                        <div class="col-sm-2"><label class="font"><b>Completed Task</b></label>
                        	<br><a href="" data-id="{{$data['project_list']->id}}" id="completed">{{$data['completed_task']}}</a>
                        </div>
                        <div class="col-sm-2"><label class="font"><b>InProgress Task</b></label>
                        	<br><a href="{{URL::to('admin/tasks_list/'.$data['project_list']->id)}}">{{$data['inprogress_task']}}</a>
                        </div>
                        <div class="col-sm-2"><label class="font"><b>Pending Task</b></label>
                        	<br><a href="{{URL::to('admin/tasks_list/'.$data['project_list']->id)}}">{{$data['pending_task']}}</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-block">
                     <div class="row">
                        <div class="col-md-8">
                        <h6 class="m-b-5 f-w-600" style="display: inline-block;">Project Info	</h6>
	                        <button type="button" class="f-right btn btn-primary waves-effect waves-light logo project_desc" data-type="1" value="1" id="project_desc">
	                         <i class="fa fa-edit"></i>Modify
	                        </button>
	                        
                           <button type="button" class="f-right btn btn-default waves-effect waves-light logo d-none project_desc_close"><i class="fa fa-close"></i>Close</button>
                     
                           <hr>
                           <p class="comment_desc" style="text-align:justify" id="comment_desc"><?= $data['project_details']->project_description ?></p>
                           <div class="media-body">
                           	
                                <form method="post" class="project_description_form d-none" >
                                    <input type="hidden" id="table_name" value="attachments">
                                    <input type="hidden" id="attachment_id" value="">
                                	<input type="hidden" id="project_id" value="{{$data['project_details']->id}}">
                                    
                                    <div class="">
                                     <textarea  class=" form-control summernote" id="summernote" name="project_description">{{$data['project_details']->project_description}}</textarea>
                                    </div>
                                  	<br>
                                       <button type="submit" class="btn btn-primary waves-effect btn-sm " id="submit_description">Update</button>
                                   
                                </form>
                              </div>
                        </div>

                        <div class="col-md-4">
                            <h6 class="m-b-5 f-w-600" style="display: inline-block;">Files </h6>                			
                                <button type="button" class="f-right btn btn-primary waves-effect waves-light logo project_add_file" >
	                            <i class="fa fa-paperclip"> </i>Add File
	                        	</button>
                       	
                            <hr>
                          
                              <div class="project_file_attach "> </div>
                            @if($data['project_details']->attachment == "")
                           <p class="project_no_file" >No files to display</p>
                           @else
                           
                           @foreach($data['project_details']->attachments as $key=>$val)
                     
                           		<p class="attachment_{{$val['id']}}"><i class="fa fa-paperclip" style="margin-right:1px;"></i>{{$val['attachment']}}
                           	    <a href="{{getImagePath($val['attachment'],'attachment')}}" target="_blank" > <button type="button"  class="f-right btn btn-warning waves-effect waves-light   btn-group-sm btn-sm " style="margin-left: 5px;"><span class="icofont icofont-eye"></span></button></a>
                           	   <button class="f-right delete_data btn btn-danger waves-effect waves-light   btn-group-sm btn-sm" data-id="{{$val['id']}}"><span class="icofont icofont-trash"></span></button>
                           		</p>
                           @endforeach
                           @endif
                            <input type="hidden" id="project_id" name="project_id">
                            <div class="media-body">
                            <div class="row">
                            <form class="attachment_form" method="post" enctype="multipart/form-data">
                            	
                           	<button type="button" class="f-right btn btn-default waves-effect waves-light logo d-none project_file_close"><i class="fa fa-close" style="margin-right:1px;"></i></button>
                           	<div class="col-md-6 d-none project_file">
                           	<input type="file" class="" name="attachment">
                            <br><br>
                           	<button type="submit" id="submit_attachment" class="btn btn-primary waves-effect btn-sm ">Save</button>
                            </div>
                            </form>
                           	</div>
                        </div>
                        <br><br>
                        </div>
                        @php 
                        if($data['project_details']->project_id == ""){
                            $class = 'd-none';
                        }else{
                            $class = '';
                        }
                        @endphp
                       
                        <div class="col-md-12 {{$class}}">
                           <div class="row">
                               <div class="col-md-6">
                                 <label><b>Project Milestone</b></label>
                              </div>
                              <hr>
                              <div class="col-md-12">
                                 <div class="card-block table-border-style">
                                    <div class="table-responsive">
                                       <table class="table table-framed">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Start Date</th>
                                                <th>Due Date</th>
                                                <th>Notify</th>
                                                <th>Status</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                             $i= 1;
                                             ?>
                                             @foreach($data['milestone'] as $value)
                                             <tr>
                                                <td scope="row">{{$i++}}</td>
                                                <td style="text-align: justify;">
                                                @if($value->title == "")
                                                    <span>-</span>
                                                @else
                                                    <span class="more">{{$value->title}}</span>
                                                @endif
                                                </td>
                                                <td>
                                                @if($value->start_date == "")
                                                    <span>-</span>
                                                @else
                                                    <span>{{dateformat($value->start_date)}}</span>
                                                @endif
                                                </td>
                                                <td>
                                                @if($value->end_date == "")
                                                    <span>-</span>
                                                @else
                                                    <span>{{dateformat($value->end_date)}}</span>
                                                @endif
                                                <td>
                                                @if($value->notify == "")
                                                    <span>-</span>
                                                @else
                                                    @if($value->notify == 1)
                                                        <span>On</span>
                                                    @else
                                                    <span>Off</span>
                                                    @endif
                                                @endif
                                                </td>
                                                <td>
                                                @if($value->status == "")
                                                    <span>-</span>
                                                @else
                                                    @if($value->status == 0)
                                                        <label class="label label-success">Active</label>
                                                    @elseif($value->status == 2)
                                                        <label class="label label-warning">Deactive</label>
                                                    @elseif($value->status == 1)
                                                        <label class="label label-info">Compelete</label>
                                                    @elseif($value->status == 3)
                                                        <label class="label label-warning">Hold</label>
                                                    @elseif($value->status == 4)
                                                        <label class="label label-warning">InHouse</label>
                                                    @elseif($value->status == 5)
                                                        <label class="label label-success">InProgress</label>
                                                    @elseif($value->status == 6)
                                                        <label class="label label-danger">Sleep</label>
                                                    @elseif($value->status == 7)
                                                        <label class="label label-other">Other</label>
                                                    @endif
                                                @endif
                                                </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          <br><br>
                        </div>
                       
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label><b>Past Activities</b></label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card-block table-border-style">
                              <div class="table-responsive">
                                 <table class="table table-framed">
                                    <thead>
                                       <tr>
                                          <th>Date</th>
                                          <th>No of Employees</th>
                                          <th>Description</th>
                                          <!--<th>Activity Status</th>-->
                                          <th>Duration</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                            <td>
                                            @if($data['project_details']->created_at == "")
                                              <span>-</span>
                                            @else
                                                <span>{{dateformat($data['project_details']->created_at)}}</span>
                                            @endif
                                            </td>
                                          <td>
                                            @if($data['project_details']->employee_id == "")
                                                <span>-</span>
                                             @else
                                          	<?php 
                                           	$a = explode(',',$data['project_details']->employee_id);
                                           	$x =  count($a);
                                           ?>
                                       		<span>{{$x}}</span>
                                       		@endif
                                       		</td>
                                          <td>
                                            @if($data['project_details']->project_description == "")
                                                <span>-</span>
                                            @else
                                              <div class="bar">
                                                  <span class="social-user-name b-none p-t-0 text-muted"><a class="get_project_description btn btn-primary btn-sm" data-id="{{$data['project_details']->id}}" data-type="2" style="color:white;">View</a></span>
                                                
                                              </div>
                                            @endif
                                          </td>
                                           <td>
                                            @if($data['project_details']->start_date == "" || $data['project_details']->end_date == "")
                                                <span>-</span>
                                            @else
                                              <span>{{getDuration($data['project_details']->start_date,$data['project_details']->end_date)}}</span>
                                            @endif
                                            </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
 <div class="modal fade " id="project_description-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Project Description</h4>
             
                    </div>
                    <div class="modal-body">
                            <input type="hidden" id="project_description_type" value="">
                         <div class="card-block project_description_data">
                           
                             </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>