 @php 
 if($data['tab'] == 0){
    $tab_class="card-border-backlog";
 }else if($data['tab'] == 1){
    $tab_class="card-border-to-do";
}else if($data['tab'] == 2){
   $tab_class="card-border-inprogress";
}else if($data['tab'] == 3){
      $tab_class="card-border-completed";
}else if($data['tab'] == 4){
   $tab_class="card-border-warning";
}else if($data['tab'] == 5){
      $tab_class="card-border-deploy";
}


 @endphp
 @foreach($data['tasks'] as $k=>$row)
 
 @php
 if($row->priority == 'l'){
    $priority_class = 'low-priority';
    $priority = 'Low Priority';
}else if($row->priority == 'h'){
    $priority_class = 'high-priority';
    $priority = 'High Priority';
}else{
    $priority_class = 'medium-priority';
    $priority = 'Medium Priority';
}
 @endphp
            <li class="text-row ui-sortable-handle change_task_status {{$tab_class}} "
               data-task-id="{{$row->id}}" data-tab-id="{{$row->status}}">
               <div class="task-title-div row" >
                  <div class="col-md-10" style="padding-right: 0px;">
                     <a href="#" data-task-id="{{$row->id}}"  class="card-title view-task">
                     <span class="task-title"><strong>{{$row->task_title}}</strong></span>
                     </a>
                  </div>
                  
                  <div class="col-md-2" style="padding-right: 0px;">
                  <a href="#" data-task_id="{{$row->id}}" data-task-tab="{{$data['tab']}}"   class="card-title add-task">
                  <span><i class="icofont icofont-pencil-alt-2"></i></span></a>
                  </div>
                 
               </div>
              
               <div class="mt-1"><span class="bar"><?= $row->task_description ?></span>
               </div>
               <!-- <p class="task-due text-right mt-1">
                  <strong class="label label-warning">2 Days</strong>
               </p> -->
               <div class="kanban-footer d-flex justify-content-between mt-1">
                       <div class="d-flex">
                        @php $i = 0;
                        $remain_user = count($row['employee_list'])-(int)3;
                        @endphp   
                        @foreach($row['employee_list'] as $r)
                  
                         <div class=" text-right ml-1">
                            <a href="javascript:void(0)">
                                <img alt="User" class="" src="{{$r['image']}}" title="{{$r['full_name']}}" style="border-radius:5px;width:20px;height:20px;">
                            </a>
                         </div>
                        @php  if(++$i > 2) break; @endphp   
                        @endforeach
                        @if($remain_user > 0)
                        <span data-toggle="tooltip" data-placement="top" title="+{{$remain_user}} Members">+{{$remain_user}}</span>
                        @endif
                        </div>
                  <div class=" d-flex">
                     <button type="button" class="btn btn-default btn-task  card-bug waves-effect waves-light m-r-5" data-toggle="tooltip" data-placement="top" title="{{$row->task_project_id}}">
                     #{{$row->task_project_id}}
                     </button>
                     @php
                     if($row->task_type == 1){
                        $task_type = 'Feature';
                     }else{
                        $task_type = 'Bug';
                     }
                     @endphp
                     <button type="button" class="btn btn-default btn-task card-feature  waves-effect waves-light  m-r-5" data-toggle="tooltip" data-placement="top" title="{{ $task_type }}">
                     <i class="icofont icofont-list"></i>
                     </button>
                     <!--<span class="priority {{$priority_class}}" data-toggle="tooltip" data-placement="top" title="{{$priority}}"></span>-->
                     <button type="button" class="btn btn-default btn-task waves-effect waves-light {{$priority_class}} " data-toggle="tooltip" data-placement="top" title="{{$priority}}">
                        <span style="color:#fff;">{{ucfirst($row->priority)}}</span>
                     </button>
                    </div>
               </div>
            </li>
            @endforeach
             