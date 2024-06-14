   @extends('layouts.default')
   @section('content')
   <style>
   .cover-btn {
       bottom: -2px;
       right: 7px;
       position: absolute;
   }
   .blur-bg{
        filter: blur(10px);
  }
   </style>
   <input type="hidden" id="table_name" value="reply">
   <input type="hidden" value="" name="id" id="id">
   <div class="main-body">
      <div class="page-wrapper">
         <!-- Page-header start -->
         @include('includes.breadcrumb')
         <!-- Page-header end -->
         <!-- Page-body start -->   
         <!--profile cover start-->
                  @include('admin.employee.profile_cover')
                  <!--profile cover end-->
         <div class="row"  id="salary_info">
            <div class="col-lg-12">

               <div class="row">
                  
                  <div class="col-md-12">
                      <div class="card">
                         <div class="card-header">
                            <h5 class="card-header-text">Salary Info</h5>
                         </div>
                         <div class="card-block">
                             <div class="page-body invoice-list-page">
                                 <div class="row">
                                     <div class="col-xl-12 col-lg-12  filter-bar">
                                      <!-- Navigation start -->
                                      <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                                         <ul class="nav navbar-nav">
                                            <li class="nav-item active">
                                               <a class="nav-link" href="#!">Filter: <span class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="nav-item dropdown">
                                               <select class="form-control form-control-default year" data-id="{{$data['employee_details']->id}}">
                                                  <option value="">Select Year</option>
                                                  @foreach($data['year'] as $k => $y)
                                                  @if($k == 0)
                                                  <option value="{{$y}}" selected>{{$y}}</option>
                                                  @else
                                                  <option value="{{$y}}">{{$y}}</option>
                                                  @endif
                                                  @endforeach
                                               </select>
                                            </li>
                                           
                                         </ul>
                                         <div class="nav-item nav-grid">
                                         </div>
                                         <!-- end of by priority dropdown -->
                                      </nav>
                                      <!-- Navigation end  -->
                                      <div class="row" id="showSalSlip">
                                         @forelse($data['salary'] as $val)
                                        <!-- Invoice list card start -->
                                        <div class="col-sm-6">
                                            @php
                                                $borderColor = "success";
                                                $amt = $val->total_amount + $val->professional_tax;
                                                if($amt == $data['employee_details']->currentCTC && $val->cl > 0)
                                                $borderColor = "info";
                                                elseif($amt != $data['employee_details']->currentCTC && $val->cl > 0)
                                                $borderColor = "warning";
                                                
                                            @endphp
                                           <div class="card card-border-{{$borderColor}}">
                                              <div class="card-header">
                                                 <h5>{{date('F',strtotime($val->date))}}</h5>
                                                 <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                 <div class="dropdown-secondary dropdown f-right">
                                                    <button class="btn btn-primary btn-mini waves-effect waves-light" type="button"  aria-haspopup="true" aria-expanded="false">Paid</button>
                                                    <!-- end of dropdown menu -->
                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                 </div>
                                              </div>
                                              <div class="card-block">
                                                 <div class="row">
                                                    <div class="col-sm-6">
                                                       <ul class="list list-unstyled">
                                                          <li><b>No. #:</b> &nbsp;00{{$val->id}}</li>
                                                          <li><b>Created on:</b> <span class="text-semibold">{{dateformat($val->date)}}</span></li>
                                                       </ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       <ul class="list list-unstyled text-right">
                                                          <li><b>Amount:</b> <span class="text-semibold">{{$val->total_amount}}</span></li>
                                                          <li><b>Professional Tax:</b> <span class="text-semibold">{{$val->professional_tax}}</span></li>
                                                       </ul>
                                                    </div>
                                                 </div>
                                              </div>
                                              <div class="card-footer">
                                                 <div class="task-list-table">
                                                    <p class="task-due"><strong>Leave Taken: </strong><strong class="label label-primary">{{$val->cl}}</strong></p>
                                                 </div>
                                                 <div class="task-board m-0">
                                                    
                                                     @if(getDepartment() == 1)
                                                    <a href="{{ URL::to('admin/salary/'.$val->id)}}" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i> View</a>
                                                    
                                                    @else
                                                     <a href="{{ URL::to('employee/salary/'.$val->id)}}" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i> View</a>
                                                    
                                                    @endif
                                                    <!-- end of dropdown-secondary -->
                                                    <div class="dropdown-secondary dropdown">
                                                       <a href="{{URL::to('downloadSalarySlip/'.$val->id)}}" class="btn btn-info btn-mini waves-light b-none txt-muted" type="button" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-download-alt"></i>Download</a>
                                                       
                                                       <!-- end of dropdown menu -->
                                                    </div>
                                                    <!-- end of seconadary -->
                                                 </div>
                                                 <!-- end of pull-right class -->
                                              </div>
                                              <!-- end of card-footer -->
                                           </div>
                                        </div>
                                        @empty
                                        <div class="col-sm-12" style="text-align:center;">
                                           No Data Available
                                        </p>
                                        @endforelse
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
         <!-- Page-body end -->
      </div>
   </div>
   <!-- Main-body end -->
   @include('admin.employee.pin')
   @stop