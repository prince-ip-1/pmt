<style>
    .btn-sm_comment{
        padding:1px 11px;
        width:0px;
    }
    .btn i{
        margin-left:-5px;
        font-size:14px;
    }
</style>
 <input type="hidden" id="table_name" value="comments">
        @if(count($tasks_comment_list) == 0)
                <div>
                    <span class="no_comment_message">Comments Not Available</span>
                </div>
        @else
        @foreach($tasks_comment_list as $row)
         <div class="media task_comment_{{$row->id}}">
          <a class="" href="#">
          <img class="media-object img-radius m-r-20 comment-img" src="{{getImagePath($row->image,'users')}}" alt="{{$row->name}}">
          </a>
          <div class="media-body b-b-muted social-client-description">
             <div class="chat-header comment_name">{{$row->name}}&nbsp;&nbsp;
             <span class="text-muted f-right">
                
                  {{ date('d-m-Y',strtotime($row->updated_at)) }}
                  <?php $session = session('user_data');
                        $d = find_date_difference($row->updated_at,'d');
                        $h = find_date_difference($row->updated_at,'h');?>
                  @if($row->user_id == $session->id && $d == 0 && $h < 24)
             <button href="#" class="btn  btn-primary waves-effect waves-light edit_comment btn-sm_comment" id="edit_comment"  data-id="{{$row->id}}" data-task_id="{{$row->task_id}}" data-add="Update" data-comment="<?= $row->comments?>"><i class="fa fa-pencil" ></i></button>&nbsp;&nbsp;
             <button href="#" class="delete_data btn btn-danger waves-effect waves-light btn-group-sm btn-sm_comment  " data-id="{{$row->id}}"><i class="fa fa-trash"></i></button>
            @endif
            </span>
             </div>
             <div class="text-muted comment_{{$row->id}}"><?= $row->comments; ?></div>
          </div>
        </div>
        @endforeach
            <!--<div>-->
            <!--        <span class="no_comment_message_delete">Comments Not Available</span>-->
            <!--</div>-->
        @endif
