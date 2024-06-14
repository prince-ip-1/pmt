 <div class="row">
                      
                        <div class="col-xl-12">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!-- contact data table card start -->
                                 <div class="card">
                                    <div class="card-header">
                                       <h5 class="card-header-text">Contacts</h5>
                                    </div>
                                    <div class="card-block contact-details">
                                       <div class="data_table_main table-responsive dt-responsive">
                                          <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                             <thead>
                                                <tr>
                                                   <th>Sr. No</th>
                                                   <th>Leave Reason</th>
                                                   <th>Start Date</th>
                                                   <th>End Date</th>
                                                   <th>Leave Days</th>
                                                   <th>Status</th>
                                                   <th>Action</th>
                                                   
                                                </tr>
                                             </thead>
                                             <?php $i=1; ?>
                                             @foreach($data['leave'] as $user)
                                             <tbody>
                                                <tr>
                                                   <td>{{$i++}}</td>
                                                   <td>{{ substr($user->reason,0,20)}}</td>
                                                   <td>{{dateFormat($user->start_date)}}</td>
                                                   <td>{{dateFormat($user->end_date)}}</td>
                                                   <td> @if($user->leavetype == '11')
                                                   <span>{{$user->leave_days_others}}</span>
                                                @else 
                                                <span>
                                                    {{$user->leavetype}}</span> 
                                                @endif</td>
                                                   
                                                 <td id="change_status{{$user->id}}" class="status_{{$user->id}}">
                                                  @php 
                                                   $status = StatusDisplayLabel($user->status);
                                                   @endphp 
                                                   
                                                   @php
                                                   print_r($status)
                                                   @endphp
                                                   
                                                </td>
                                                 <td>
                                                   <div class="btn-group btn-group-sm " style="float: none;">
                                                   <button type="button" data-id="{{ $user->id}}" class=" btn btn-warning waves-effect waves-light  display_data btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-eye"></span></button>
                                                </div>
                                               
                                                </td>
                                                </tr>
                                             </tbody>
                                             @endforeach
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- contact data table card end -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-3">
      <div class="md-content">
         <h3>Leave Details</h3>
         <div class="scroll-model system-form"> 
            @include('admin.leave.leave_details')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>