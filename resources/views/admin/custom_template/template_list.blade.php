
@extends('layouts.default')
@section('content')
 @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
              
                @endphp
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        
        <div class="row">
 <div class="col-lg-12 filter-bar">
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
             
              <div class="nav-item" style="left: 85%;position: relative;">
                   @if(getDepartment() == 1)
                   <a href=" {{URL::to('admin/add_template')}}" class="btn btn-primary   waves-effect waves-light waves-effect md-trigger"
                  >Add Template
                </a>
                @elseif(isset($permission[19]->add) && $permission[19]->add == 1)
                <a href=" {{URL::to('employee/add_template')}}" class="btn btn-primary   waves-effect waves-light waves-effect md-trigger"
                  >Add Template
                </a>
                @endif
                
               </div>
          </nav>
          </div>
          </div>
       <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
               
                  <table id="ProjectTable" class="table table-striped table-bordered nowrap" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Template Title</th>
                                     <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1; 
                                ?>
                                @foreach($data['template_list'] as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->template_title}}</td>
                                    
                                    <td>
                                    @if($row->status == 1)
                                        <label class="label label-success">Active</label>
                                    @else
                                     <label class="label label-danger">Deactive</label>
                                    @endif
                                    </td>
                                    <td>
                                        <div class="btn-group-sm tabledit-span_1 " style="float: none;">
                                           
                                         @if(getDepartment() == 1)   
                                              <a href="{{URL::to('admin/edit_project/'.$row->id)}}" class="btn btn-primary waves-effect waves-light"> <span class="icofont icofont-ui-edit"></span></a>
                                              <a href="{{URL::to('admin/view_project_details/'.$row->id)}}" class="btn btn-warning waves-effect waves-light mr-1 "> <span class="icofont icofont-eye"></span></a>
                                         
                                        @elseif(isset($permission[19]->view) && $permission[19]->view == 1)
                                             <a href="{{URL::to('employee/edit_template/'.$row->id)}}" class="btn btn-primary waves-effect waves-light"> <span class="icofont icofont-ui-edit"></span></a>
                                             <a href="{{URL::to('employee/view_template/'.$row->id)}}" class="btn btn-warning waves-effect waves-light  mr-1"> <span class="icofont icofont-eye"></span></a>
                                          
                                        @endif
                                         </div>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    </div>
</div>
@stop