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


<div class="card-block table-border-style">
   <div class="">
      <table class="table table-styling table-xs">
            <tr class="table-primary">
               <td>Date</td>
               <th>Total Time</th>
               <th>View</th>
            </tr>
         	@foreach($data['date_list'] as $row)
            <tr>
                @php
               $timestamp = strtotime($row->start_date);
               $day = date('D', $timestamp);
               @endphp
               @if($day == 'Sat' || $day == 'Sun')
               <td class="text-c-yellow">{{$row->start_date}}</td>
               @else
               <td>{{$row->start_date}}</td>
               @endif
               <td>{{$row->totaltime}}</td>
               <td>
               <div class="btn-group btn-group-sm " style="float: none;">
                    <a href="javascript:void(0)" data-id="{{$row->user_id}}" data-start_date="{{$row->start_date}}" class="btn btn-warning waves-effect waves-light   btn-group-sm view_task_report "  style="float: none;">
                     <i class="icofont icofont-eye" style="margin-right:1px;"></i>
                    </a>
               </div>
           		</td>
            </tr>
            @endforeach
      </table>
   </div>
</div>



