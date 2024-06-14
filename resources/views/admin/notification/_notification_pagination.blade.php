
 @foreach($data['notification_list'] as $k=>$column)
 <div class="job-cards">
    <div class="media">
       
        <a class="media-left media-middle" href="#">
            <img class="media-object m-r-5 m-l-5" src="{{getImagePath($column->image,'users')}}" alt="{{$column->sender_name}}" style="width:40px; border-radius: 5px;">
        </a>
        <div class="media-body">
            <div class="company-name">
                <p style="font-size: 13px;">{{$column->title}}</p>
                <i class="text-muted f-14" style="font-size: 13px;">{{$column->message}}</i></div>
            
        </div>
        <div>
            <div class="label-main">
                <label class="">{{dateformat($column->created_at)}}</label>
            </div>
        </div>
        <div class="btn-group btn-group-sm" style="float: none;">
          <button type="button" data-id="{{$column->id}}" class=" btn btn-warning waves-effect waves-light  display_notification btn-group-sm "  style="float: none;margin: 5px;"><span class="icofont icofont-eye"></span></button>
        </div>
        

        
    </div>
</div>
 @endforeach
 
 <br>
<div class="row f-right">  
    <div class="col-lg-12">
        {!! $data['notification_list']->links() !!}
    </div>
</div>

<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-3">
      <div class="md-content">
         <h3>Notification Type</h3>
         <div>
            @include('admin.notification.notification_details')           
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>