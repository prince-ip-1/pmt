@extends('layouts.default')
@section('content')
@include('admin.task.task_css')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
<?php $p_id = session('project_id');
        $session = session('user_data');
         ?>
         <input type="hidden" id="total_task" value="">
<div class="row simple-cards">
 <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                       <select class="form-control" id="project_id" name="project_id">
                          @if(count($data['project_list']) == 0)
                           <option value="">No Project</option>
                          @else
                          @foreach($data['project_list'] as $row)
                          <option <?php echo (isset($p_id) && $p_id == $row->id)?"selected":""?> value="{{$row->id}}">{{$row->project_name}}</option>
                          @endforeach
                          @endif
                      </select>
                    </div>
                   
                    <div class="col-md-3">
                       <select class="form-control" id="task_employee_id" name="employee_list">
                          @if(count($data['employee_list']) == 0)
                           <option value="">No Employee</option>
                          @else
                           <option value="">Please Select Developer</option>
                          @foreach($data['employee_list'] as $row)
                          <option  value="{{$row['id']}}">{{$row['full_name']}}</option>
                          @endforeach
                          @endif
                      </select>
                    </div>
                    <div class="col-md-3">
                       <select class="form-control" id="task_qa_id" name="qa_list">
                          @if(count($data['qa_list']) == 0)
                           <option value="">No Employee</option>
                          @else
                           <option value="">Please Select QA</option>
                          @foreach($data['qa_list'] as $row)
                          <option  value="{{$row['id']}}">{{$row['full_name']}}</option>
                          @endforeach
                          @endif
                      </select>
                    </div>
                     <div class="col-md-3">
                       <button id="clear_employee" class="btn btn-sm btn-primary">Clear</button>
                    </div>
                
                 
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-task">
    
    @foreach(getTaskStatus() as $k=>$row)
    @php 
        $text = str_replace(" ", "-", strtolower($row));
    @endphp
    <div class="item-task mr-1">
      <div class="status-card">
         <div class="card-header">
            <span class="card-header-text">{{$row}}<span class="float-right {{$text}}-count">({{$data['to_do_task']}})</span></span>
         </div>
        <div class="preloader3 loader-block {{$text}}-loader">
            <div class="circ1 loader-{{$text}}"></div>
            <div class="circ2 loader-{{$text}}"></div>
            <div class="circ3 loader-{{$text}}"></div>
            <div class="circ4 loader-{{$text}}"></div>
        </div>
               @if(count($data['project_list']) > 0) 
                <div style="padding:10px 10px 15px;">
                       <a href="#" class="add-task" data-task_id=""  data-task-tab="{{$k}}"><i class="icofont icofont-plus"></i> Add New Card</a>
                    </div>
               
                @endif
         <ul class="sortable ui-sortable {{$text}}-div ul-scroll" 
            id="sort1"
            data-status-id="{{$k}}" >
         </ul>

      </div>
   </div>
   @endforeach
   
</div>
</div>
</div>
</div>

@include('admin.task.task_details')
 
@include('admin.task.edit_task')

@stop