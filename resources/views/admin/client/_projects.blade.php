<style type="text/css">
   .timeline-dot:after, .timeline-dot:before{
      left: 9.3%;
   }
   .timeline-dot .social-timelines-left:after {
    right: -60px;
}
.timeline-dot .card {
    margin-left: 40px;
}
.colorNo{
   padding:8px;
}
</style>
   
        @if(count($data['projects']) == 0)
        <div class="col-sm-12">
            <div class="card">
                 <div class="card-header text-center">
                     <h5 class="card-header-text ">Project Not Available</h5>
                  </div>
            </div>
        </div>
        @else
        <div class="row">
        <div class="col-md-12 timeline-dot">
      <div class="social-timelines p-relative">
         <div class="row timeline-right p-t-35">
      @foreach($data['projects'] as $row)
            <div class="col-2 col-sm-2 col-xl-1">
               <div class="social-timelines-left">
                  <!-- blue,green,orenge,red -->
                  <?php 
                   $color="";
                  if($row->color == 0){
                     $color = "bg-danger";
                  }
                  elseif($row->color == 1){
                     $color = "bg-primary";
                  }
                  elseif($row->color == 2){
                     $color = "bg-success";
                  }
                  elseif($row->color == 3){
                     $color = "bg-warning";
                  }

                  ?>
                   <div class="cd-timeline-icon {{$color}}" style="margin-left: 23px;">
                      <!-- <i class="icofont icofont-ui-file"></i> -->
                      <div class="colorNo">{{$row->id}}</div>
                  </div>
               </div>
            </div>
            <div class="col-10 col-sm-10 col-xl-11 p-l-5 ">
               <div class="card">
                  <div class="card-block post-timelines">
                     <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                     <div class="dropdown-menu dropdown-menu-right b-none services-list">
                        <a class="dropdown-item" href="#">Remove tag</a>
                        <a class="dropdown-item" href="#">Report Photo</a>
                        <a class="dropdown-item" href="#">Hide From Timeline</a>
                        <a class="dropdown-item" href="#">Blog User</a>
                     </div>
                     <!--<div class="chat-header f-w-600">{{$row->project_name}}</div>-->
                     <a href="{{URL::to('admin/view_project_details/'.$row->id)}}">{{$row->project_name}}</a>
                     <div class="social-time text-muted"><span style="padding-right:20px;">{{dateformat($row->start_date)}}</span>   <span style="padding-right:20px;">{{dateformat($row->end_date)}}</span>   <span style="padding-right:20px;">{{get_timeago($row->created_at)}}</span></div>
                  </div>
                  <div class="card-block">
                     <div class="timeline-details">
                        <div class="chat-header">Description:</div>
                        <p class="text-muted">{{$row->project_description}}</p>
                     </div>
                  </div>
                  <?php 
                     $a = explode(',',$row->employee_id);
                     $x =  count($a);
                   ?>
                  <div class="card-block b-b-theme b-t-theme social-msg">
                     <a href="#"> <i class="icofont icofont-user text-muted"></i><span class="b-r-muted">Team Members ({{$x}})</span> </a>
                     <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Backlog Tasks ({{$row->backlog_task}})</span></a>
                     <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Inprogress Tasks ({{$row->inprogress_task}})</span></a>
                     <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Completed Tasks ({{$row->completed_task}})</span></a>
                  </div>
               </div>
            </div>
   @endforeach
    </div>
      </div>
    </div>
    </div>
   @endif
        
