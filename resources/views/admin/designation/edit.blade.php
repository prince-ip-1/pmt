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
</style>

@extends('layouts.default')
@section('content')
 <input type="hidden" id="table_name" value="designation">
    <input type="hidden" id="action" value="{{URL::to('post_designation')}}">
<div class="main-body">
     <div class="page-wrapper">
      <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                        <div class="card-header">
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <div class="card-block">
                                <section>
                           <input type="hidden" name="id" id="id" value="{{$data['designation']->id}}">
                                 <form id="main" method="post" action="/" novalidate="">

                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Department Name</label>
                                       <div class="col-sm-9">
                                          <select class="form-control form-control-primary" name="department_id" id="department_id2" required>
                                              <option value="">Please Select</option>
                                              @foreach($department as $row)
                                              <option {{ ($row->id == $data['designation']->dept_id )?"selected":"" }} value="{{$row->id}}">{{$row->department_name}}</option>
                                              @endforeach
                                          </select>
                                          <span class="messages"></span>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Designation Name</label>
                                       <div class="col-sm-9">
                                          <input type="text" class="form-control form-control-primary" name="designation_name" value="{{$data['designation']->designation_name}}" id="" placeholder="Enter Designation Name">
                                          <span class="messages"></span>
                                       </div>
                                    </div>
                                     <?php $employee_id = json_decode($data['designation']->employee_id); ?>
                                    <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" >Employees</label>
                                            <div class="col-sm-9">
                                            <select name="employee_id[]" class="employee_id select2" id="employee_id" multiple="multiple">
                                                <option value="">Select</option>
                                                    @foreach($data['employees'] as $user)
                                                    <option <?= isset($employee_id) && (in_array($user->id,$employee_id) == TRUE)?"selected":""?> value="{{$user->id}}">{{$user->full_name}}</option>
                                                    @endforeach      
                                                </select>
                                                </div>
                                            </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Status</label>
                                       <div class="col-sm-9">
                                          <div class="form-radio">
                                             <div class="radio radiofill radio-primary radio-inline">
                                                <label>
                                                <input type="radio" name="status" {{ ($data['designation']->status == 1)?"checked":"" }}  value="1" data-bv-field="status">
                                                <i class="helper"></i>Active
                                                </label>
                                             </div>
                                             <div class="radio radiofill radio-primary radio-inline">
                                                <label>
                                                <input type="radio" name="status" {{ ($data['designation']->status == 0)?"checked":"" }}  value="0" data-bv-field="status">
                                                <i class="helper"></i>Deactive
                                                </label>
                                             </div>
                                          </div>
                                          <span class="messages"></span>
                                       </div>
                                    </div>
                                    @if(!empty($data['module_name']))
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Module Name</label>
                                        
                                       <div class="col-sm-1">
                                                <span>Add</span>
                                       </div>
                                       <div class="col-sm-1">
                                                <span>Edit</span>
                                       </div>
                                       <div class="col-sm-1">
                                                <span>Delete</span>
                                       </div>
                                       <div class="col-sm-1">
                                                <span>View</span>
                                       </div>
                                      <div class="col-sm-2">
                                                
                                                <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                   @php
                                                   $checked  = '';
                                                   if(isset($subtype) && $subtype == 1){
                                                   $checked = 'checked';
                                                   }
                                                @endphp 
                                                <input type="checkbox" {{ $checked }} class="checkall" value="1">

                                                <span class="cr" style="margin-left: 0.5em;">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span>All

                                                </span>
                                                </label>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    @foreach($data['module_name'] as $k=>$row)
                                    @php
                                     $checked1 = $checked2 = $checked3 = $checked4 = $checked5 = '';  
                                     foreach($data['permissions'] as $k1=>$row1){
                                      if($k == $k1){
                                          if(isset($row1->add) && $row1->add == 1){
                                             $checked1 = 'checked';
                                           } 
                                           if(isset($row1->edit) && $row1->edit == 1){
                                             $checked2 = 'checked';
                                           } 
                                           if(isset($row1->delete) && $row1->delete == 1){
                                             $checked3 = 'checked';
                                           } 
                                           if(isset($row1->view) && $row1->view == 1){
                                             $checked4 = 'checked';
                                           } 
                                          if(!empty($checked1) && !empty($checked2) && !empty($checked3) && !empty($checked4)){
                                           $checked5 = "checked";
                                          }
                                     }
                                     }
                                    @endphp
                                    
                                    <?php //p($row,0); p($row1); ?>
                                    
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">{{$row}}</label>
                                      
                                       <div class="col-sm-1">
                                               <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                <input type="checkbox" {{ $checked1  }}   name="module_name[{{$k}}][add]" value="1" class="selectall singlecheck" data-id="{{$k}}">
                                                <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-1">
                                                <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                <input type="checkbox" {{ $checked2  }}  name="module_name[{{$k}}][edit]" value="1" class="selectall singlecheck" data-id="{{$k}}">
                                                <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-1">
                                                <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                <input type="checkbox" {{ $checked3  }} name="module_name[{{$k}}][delete]" value="1" class="selectall singlecheck" data-id="{{$k}}">
                                                <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-1">
                                               <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                <input type="checkbox" {{ $checked4  }} name="module_name[{{$k}}][view]" value="1" class="selectall singlecheck" data-id="{{$k}}">
                                                <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                </span>
                                                </label>
                                          </div>
                                       </div>
                                         <div class="col-sm-2">
                                                
                                                <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                <input type="checkbox" {{$checked5}} class="singlecheckall" data-id="{{$k}}" value="1">

                                                <span class="cr" style="margin-left: 0.5em;float: right;">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>

                                                </label>
                                          </div>
                                       </div>
                                    </div>
                                   
                                     @endforeach
                                    @endif
                                    <div class="modal-footer">
                                       <button type="submit" class="btn btn-primary btn-round  m-b-0">Submit</button>
                                       <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
                                    </div>
                                 </form>
                              </section>
                           </div>
                        </div>
                  </div>
            </div>
         </div>
            
      </div>
</div>

@stop