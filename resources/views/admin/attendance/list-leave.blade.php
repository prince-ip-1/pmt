@extends('layouts.default')
@section('content')
<div class="section-body ">
            <div class="container-fluid">
                <div class="row clearfix">
                     <ul class="nav nav-tabs page-header-tab">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#list"><i class="fa fa-list-ul"></i>Leave List</a></li>
                            </ul>
                    </div>
                </div>
            </div>
             <div class="section-body">
            
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="list" role="tabpanel">
                        <div class="row clearfix div1 display">
                        	<table class="table table-hover table-vcenter mb-0 table_custom spacing8 text-nowrap">
                        		<thead>
                        			<tr>
                        				<th><h6 style='color:black;'>No</h6></th>
                        				<th><h6 style='color:black;'>Employee Name</h6></th>
                        				<th><h6 style='color:black;'>Title</h6></th>
                        				<th><h6 style='color:black;'>FromDate</h6></th>
                        				<th><h6 style='color:black;'>ToDate</h6></th>
                        				<td><h6 style='color:black;'>Created Date</h6></td>
                        				<th><h6 style='color:black;'>Reason</h6></th>
                                        <th><h6 style='color:black;'>Status</h6></th>
                                        <th><h6 style='color:black;'>Action</h6></th>
                        			</tr>
                        		</thead>
                        		<?php $i=1;?>
                        		<tbody>
                        			@foreach($data as $p)
                        			<tr>
                        				
                        			<td style ='font-size: 15px'>{{$i++}}</td>	
									<td style ='font-size: 15px'>{{$p->first_name}}</td>	

                        			<td style ='font-size: 15px'>{{$p->title}}</td>
	                        		<td style ='font-size: 15px'>{{$p->start_date}}</td>
	                        		<td style ='font-size: 15px'>{{$p->end_date}}</td>
	                        		<td style ='font-size: 15px'>{{$p->current_date}}</td>
	                        		<td style ='font-size: 15px'>{{$p->reason}}</td>
                                    <td style ='font-size: 15px'>
                                        @if($p->status == 1)
                                            <span class="tag tag-blue">Approved</span>
                                        @elseif($p->status == 2)
                                            <span class="tag tag-red">Disapproved</span>
                                        @else
                                            <span class="tag tag-yellow">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                    <select class="select form-control show-tick" data-id="{{$p->id}}" id="status" name="status">
                                    <option value="">Select</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Disapproved</option>
                                    <option value="3">Pending</option>
                                    
                                </select>
                                    </td>
                                    
	                        	</tr>
	                        	@endforeach
                        		</tbody>
                        	</table>
                        </div>
                    </div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
    $('.select').on('change', function (event) {
        event.preventDefault();
         var id = $(this).data("id");
           var status = $(this).val();
       // alert(id);
        $.ajax({
            type: 'POST',
            url : "{{URL::to('updateleave')}}",
            data: {id:id,status:status, _token:'{{ csrf_token() }}'},
            success: function (data) {
                  alert(data.status);
                 window.location.reload(true);
            },
        });
    });
});
</script>