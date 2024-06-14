<style>

    table td{
        word-wrap:break-word;
        white-space:inherit;
     padding:.5em; 
}
</style>
<input type="hidden" id="table_name" value="client_conversion">
<input type="hidden" action="{{URL::to('client_conversion')}}" >

 <div class="job-cards">
    <div class="media">
     
        <div class="media-body">
           
            <table id="table_data"  class="table table-bordered " style="table-layout: fixed; width: 100%">
                <thead>
                    <tr>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tb">
                         @foreach($data as $k=>$column)
                        <tr id="comments_{{$column->id}}">
                            <td  class="forcedWidth" style="text-align: justify;">
                                {{$column->comments}}
                                 </td>
                            <td  class="forced" >{{$column->created_at}}</td>
                           
                            <td class="forced">
                               <div class="btn-group btn-group-sm " style="float: none;">
                              <button type="button" data-id="{{$column->id}}" data-client_id="{{$column->client_id}}" data-comment="{{$column->comments}}" class=" btn btn-primary waves-effect waves-light  edit_cilent_comment_data btn-group-sm " data-add="Update" style="float: none;margin: -5px;"><span class="icofont icofont-edit"></span></button>&nbsp;&nbsp;&nbsp;
                              <button type="button" data-id="{{$column->id}}" class=" delete_data btn btn-danger waves-effect waves-light   btn-group-sm " style="float: none;margin: -5px;"><span class="icofont icofont-trash"></span></button>
                           </div>
                            </td>
                        </tr>
                         @endforeach
                </tbody>
                
            </table>
        </div>
        <div>
        </div>
        <div class="btn-group btn-group-sm" style="float: none;">
         </div>
    </div>
</div>

 