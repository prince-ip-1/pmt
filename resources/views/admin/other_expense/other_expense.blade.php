@extends('layouts.default')
@section('content')
<style type="text/css">
   .waves-light{
   float: right;
   }
   #alt-pg-dt .form-control{
       width:80%;
   }
</style>
<div class="main-body">
   <input type="hidden" id="table_name" value="other_expense">
   <div class="page-wrapper">
      @include('includes.breadcrumb')
    
      <!-- Page-header start -->
      <!-- Page-header end -->
      <!-- Page-body start -->
      <div class="page-body">
         <div class="row">
          <div class="col-lg-12 filter-bar p-b-20">
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
              <ul class="nav navbar-nav sal">
                  <li class="nav-item">
                    @if(isset($_GET['type']) && $_GET['type'] == "monthly")
                      <input class="form-control" type="month" id="min" name="min" value="<?=date('Y-m')?>">
                    @else
                      <input class="form-control" type="month" id="min" name="min">
                    @endif
                  </li>
                  <li class="nav-item">
                    &nbsp;<button  id="filterBtn" class="btn btn-primary" style="padding:8px 19px" title="">Filter</button>
                  </li>
              </ul>
              <div class="nav-item">
                  <h5 class="f-18"><b>Total Expenses: <span id="net-total">0</span></b></h5>
              </div>
              <div class="nav-item">
                <button class="btn btn-cs btn-primary waves-light m-l-10 downloadExpCsv"><i class="fa fa-download"></i></button>
                @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
              
                @endphp
                @if(isset($permission[14]->add) && $permission[14]->add == 1 ||  getDepartment() == '1')
                  <a href=" {{URL::to('employee/other_expense')}}" class="btn btn-cs btn-primary waves-effect waves-effect md-trigger">Add Other Expense</a>
                @endif
                
              </div>
          </nav>
          </div>
        </div>
        
         <div class="card">
          
              
            <div class="card-block">
                <div class="dt-responsive table-responsive">
               
                  <table id="dt-range" class="table table-striped table-bordered nowrap" >
                     <thead>
                        <tr>
                           <th>Sr No</th>
                           @if((isset($permission[14]->edit) && $permission[14]->delete == 1) || getDepartment() == '1') 
                           <th>Category</th>
                           <th>Paid By</th>
                           <th>Expense Description</th>
                           <th>Date</th>
                           <th>Payment Type</th>
                           <th>Amount</th> 
                           <th>Created By</th>
                           <th>Action</th>
                           @endif
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data['other_expense'] as $k=>$row)
                         <tr id="deprt_{{$row->id}}" >
                           <th scope="row">{{$k+1}}</th>
                            <td>
                                 {{$row->category_name}} </td>
                            <td>
                               @if($row->paid_by == 99999)
                                <span>Bluepixel</span>
                             @else
                                <span>    
                             {{$row->first_name}} {{$row->last_name}}
                              </span> 
                               @endif
                           </td>
                           
                           <td class="text-length" style="width:200px!important;max-width:200px!important;overflow: hidden;text-overflow: ellipsis!important;">
                              <span>
                                 {{$row->description}}
                              </span>
                           </td>
                           <td>
                              <span>
                              {{dateformat($row->date)}}
                              </span> 
                           </td>
                            <td>
                                @if($row->payment_type == "0")
                                     <span>Card</span>
                                @elseif($row->payment_type == "1")
                                    <span>Cash</span>
                                 @elseif($row->payment_type == "2")
                                    <span>Online</span>
                                @endif
                           </td>
                          <td>
                              {{$row->total_amount}}
                          </td>
                          <td>
                              <span>
                              {{$row->f_name . ' ' .$row->l_name}}
                              </span> 
                           </td>
                          @if(isset($permission[14]->edit) && $permission[14]->delete == 1 || getDepartment() == '1') 
                            <td style="white-space: nowrap; width: 1%;">
                              <div class="btn-group btn-group-sm tabledit-span_{{$row->id}} " style="float: none;">
                                @if(isset($permission[14]->edit) && $permission[14]->edit == 1 ||  getDepartment() == '1')
                                <a href="{{URL::to('admin/edit_other_expense/'.$row->id)}}"  class=" btn btn-primary waves-effect waves-light btn-group-sm " style="float: none;margin: 5px;"><i class="icofont icofont-ui-edit" style="margin-right:1px;"></i></a>
                                @endif
                                @if(isset($permission[14]->delete) && $permission[14]->delete == 1 ||  getDepartment() == '1')
                                    <button type="button" data-id="{{$row->id}}" class="delete_data btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;"><span class="icofont icofont-ui-delete"></span></button>
                                    @if(!empty($row->invoice))
                                    <button type="button" data-id="{{ $row->id}}" class=" btn btn-warning waves-effect waves-light " style="float: none;margin: 5px;">
                                        <a style="color: #fff;margin-right: -5px;" href = "{{getImagePath($row->invoice,'invoice')}}" download><i class="icofont icofont-inbox"></i></a>
                                    </button>
                                    @endif
                                @endif
                              </div>
                           </td>
                           @endif
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- Edit With Button card end -->
      </div>
      <!-- Page-body end -->
   </div>
</div>
<div class="animation-model">
   <div class="md-modal md-effect-1" id="expDownloadMdl">
      <div class="md-content">
        <h3>Download Expenses</h3>
        <div class="row">
          <div class="col-md-12">
            Please select dates to download
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-form-label">
              <label>Start Date</label>
              <input type="date" name="from" class="form-control from">
            </div>
            <div class="col-sm-6 col-form-label">
              <label>End Date</label>
              <input type="date" name="to" class="form-control to">
            </div>
        </div>
        <div class="modal-footer" style="border-top-width:inherit;justify-content: center;">
            <button type="button" class="btn btn-primary waves-effect btn-round md-close md-close-1 btn-close" style="margin: 0">Close</button>&nbsp;
            <button type="button" class="btn btn-primary waves-effect btn-round downloadExpCsvBtn" style="margin: 0">Download</button>
        </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div> 
@stop