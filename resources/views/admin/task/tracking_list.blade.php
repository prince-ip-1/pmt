<?php  if($total > 0){ ?>
<table class="table" id="task_tracking_tbl">
                        <thead>
                           <th>No.</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Employee</th>
                           <th class="text-right">Duration</th>
                        </thead>
                        <tbody>
                           <tr colspan="5" class="task_tracking_div_new"></tr>
                           
                           @foreach($list as $k=>$row)
                         <tr>
                              <td>{{$k+1}}</td>
                              <td>{{ dateFormat($row->start_date) . ' ' . $row->start_time }}</td>
                              <td class="end_time_{{$row->id}}"><?php if(!empty($row->end_date)){ echo dateFormat($row->end_date) . ' ' . $row->end_time; } ?></td>
                              <td class="user-box"><img class="media-object img-radius m-r-20 tracking-img" src="{{getImagePath($row->image,'users')}}" alt="{{$row->full_name}}"></td>
                              <?php $duration = breakDuration($row->start_time,$row->end_time); ?>
                              <td class="text-right duration_{{$row->id}}">{{$duration['b']}}</td>
                           </tr>
                          @endforeach
                          
                           
                       </tbody>
                   </table>
 <?php }else{ ?>
                           
                            <div>
                                <span class="no_tracking_message">Tracking Data Not Available</span>
                            </div>
                           
                           <?php } ?> 