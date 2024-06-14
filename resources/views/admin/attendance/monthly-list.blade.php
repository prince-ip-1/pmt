<link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/toolbar/jquery.toolbar.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/toolbar/custom-toolbar.css')}}">
 
<style>
th {
    cursor: pointer;
}
.table.table-xs td, .table.table-xs th {
    padding: 0.4rem 1rem;
}
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tool-item {
  width: auto !important;
  height: auto !important;
}

</style>
@php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
                
                @endphp
<div class="card-block table-border-style">
   <!--<div class="table-responsive">-->
   <div class="">
      <table class="table table-styling table-xs">
        
            <tr class="table-primary">
               <th>Date</th>
               <th>Check In</th>
               <th>Check Out</th>
               <th>Break Time</th>
               <th>Duration</th>
               <th>Status</th>
               <th>Address</th>
                @if(isset($permission[6]->edit) && $permission[6]->edit == 1 || isset($userdata->department_id) && $userdata->department_id == 1)
                 <th>Action</th>
                  @endif
              
            </tr>

          @foreach($data['date_list'] as $row)
           
            <tr>
               @php
               $timestamp = strtotime($row->date);
               $day = date('D', $timestamp);
               @endphp
               @if($day == 'Sat' || $day == 'Sun')
               <td class="text-c-yellow">{{$row->date}}</td>
               @else
               <td>{{$row->date}}</td>
               @endif
               <td>{{timeformat($row->checkin)}}</td>
               <td>{{$row->checkout}}</td>
                @if(isset($permission[6]->edit) && $permission[6]->edit == 1 || isset($userdata->department_id) && $userdata->department_id == 1)
                    <td>
                <span class="mytooltip tooltip-effect-1">
                    <span class="tooltip-item" style="background: none;">{{$row->breaktime}}</span>
                    <span class="tooltip-content clearfix" style="background: #01a9ac;">
                    <span class="tooltip-text" style="padding-left: 15px;">
                        @if(isset($row->break) && !empty($row->break))
                        <table style="width: 100%;">
                            <tr>
                               <th>Break In</th>       
                               <th>Break Out</th>   
                               <th>Duration</th>   
                            </tr>
                            <tbody>
                                
                                @foreach($row->break as $row2)
                                <tr>
                                  <td>{{$row2->time_in}}</td>  
                                  <td>{{$row2->time_out}}</td>  
                                  <td>{{$row2->duration}}</td>  
                                </tr>
                                @endforeach
                               
                            </tbody>
                             
                        </table>
                         @endif
                    </span>
                    </span>
                    </span>
               </td>
                @else
                <td>{{$row->breaktime}}</td>
                @endif
               
               
               <td>{{$row->duration}}</td>
               
               <td>
                  {{ AttendanceLabel($row->duration)}}
               </td>
               <td>
                   @if(isset($row->address) && $row->address != "")
                   <div class="tool-box">
                    <div data-toolbar="user-options" class="btn-toolbar btn-success btn-toolbar-success top-toolbar check-address" data-id="{{$row->id}}"  data-address="{{$row->address}}" id="primary-toolbar"><i class="fa fa-map-marker "></i></div>
                    <div class="clear"></div>
                   </div>
                   @endif
                </td>
                <!--</td>-->
                 @if(isset($permission[6]->edit) && $permission[6]->edit == 1 || isset($userdata->department_id) && $userdata->department_id == 1)
              <td>
                <button type="button" data-checkin="{{$row->checkin}}" data-id="{{$row->id}}" data-checkout="{{$row->checkout}}" data-date="{{$row->date}}" class="btn btn-sm btn-primary m-b-10 m-r-10 checkin-manually waves-effect "><span class="icofont icofont-ui-edit"></span></button>
               </td>
                @endif
              
            </tr>
            @endforeach
         
      </table>
   </div>
</div>

<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Attendance Information : <span id="display-date"></span></h4>
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                     
                    <div class="modal-body">
                       <div id="" class="salary-form modal-body" >
                            <form method="post" action="/" id="form_checkin">
                                <input type="hidden" name="at_id" id="at_id" value="">
                               <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="block">Check In</label>
                                        <input name="checkin" id="checkin" type="time" class=" form-control" placeholder="Enter Check IN Time" min="1" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="block">Check Out</label>
                                        <input name="checkout" id="checkout" type="time" class=" form-control" placeholder="Enter Check Out Time" min="1" required>                   
                                                            
                                    </div>
                                                      
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary waves-effect waves-light " id="add_checkin">Submit</button>
                        <button type="button" class="btn  btn-default waves-effect attendace-close-btn " data-dismiss="modal">Close</button>
                       
                    </div>
        </div>
    </div>
</div>

