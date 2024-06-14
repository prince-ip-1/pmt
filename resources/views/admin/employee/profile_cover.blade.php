 <link href="{{URL::to('dist/assets/css/croppie.css')}}" type="text/css" rel="stylesheet">
 <style type="text/css">
    
    label.cabinet{
   display: block;
   cursor: pointer;
}

label.cabinet input.file{
   position: relative;
   height: 100%;
   width: auto;
   opacity: 0;
   -moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
   width: 250px;
   height: 250px;
  padding-bottom:25px;
}
figure figcaption {
    position: absolute;
    bottom: 0;
    color: #fff;
    width: 100%;
    padding-left: 9px;
    padding-bottom: 5px;
    text-shadow: 0 0 10px #000;
}
.cr-viewport.cr-vp-square {
    width: 140px;
    height: 140px;
    border-radius: 50%;
}
.card-block.user-info{
   bottom: 25px;
}
.btn:focus {
    outline: 0;
    box-shadow: 0 0 0 0px #f6f7fb;
}
#edit-btn{
    padding:8px 5px 8px 10px;
    }

 </style>
 <div class="row">

            <div class="col-lg-12">

               <div class="cover-profile">

                  <div class="profile-bg-img">
                      <div>
                  
                        <img class="profile-bg-img img-fluid" src="{{ URL::to('dist/assets/images/bg-profile2.jpg')}}" alt="bg-img" style="height: 160px;">
                      </div>  

                     <div class="card-block user-info">
                       
                        <div class="col-md-12">

                           <div class="media-left">
                                 <div class="profile-pic-wrapper">
                                   <div class="pic-holder">
                                <input type="hidden" name="old_image" id="old_image" value="{{$data['employee_details']->image}}">
                                <img  class="pic gambar img-responsive " id="item-img-output" src="{{getImagePath($data['employee_details']->image,'users')}}">
                               @if($data['title'] == 'Employee Details')
                                <input class="uploadProfileInput item-img file center-block" type="file" name="file_photo" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                                 <figure>
                                    <div class="header-notification">
                               
                                    </div>
                                 </figure>    

                                   
                             @endif
                           </div>
                        </div>
                           </div>
                            
                           <div class="media-body row">
                              <div class="col-lg-12">
                                 <div class="user-title">
                                    <h2>{{ $data['employee_details']->first_name . ' ' . $data['employee_details']->last_name}}</h2>
                                               
                                    <span class="text-white">{{$data['employee_details']->designation_name}}</span>

                                 </div>
                              </div>
                              <div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="dropdown-primary dropdown open">
                     <button class="btn btn-sm dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="position: absolute;
                                                       bottom: 0px;
                                                       width: 100%;
                                                       padding-left: 0px;
                                                       padding-bottom: 5px;
                                                       left: 180px;
                                                       background-color: #f6f7fb;"><i class="feather icon-camera" style="font-size: 20px;margin-right: 0px;"></i></button>
                      <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" style="cursor: pointer;">
                         <a id="buttonid"  class="dropdown-item waves-light waves-effect"><span style="">Upload Image</span> <input id="fileid" style="    overflow: inherit;
    opacity: 0;" type="file" class="item-img file center-block" name="file_photo" hidden/>
                        </a>
                        <a class="dropdown-item waves-light waves-effect view-image" data-toggle="modal" data-target="#view_image " >View Image</a>
                         @php
                         if(!empty($data['employee_details']->image)){
                            $class = "block";
                         }else{
                             $class = "d-none";
                         }
                         @endphp
                        <a class="dropdown-item waves-light waves-effect remove-image {{$class}}" id="remove_image">Remove Image</a>
                        
                                       
                                     </ul>
                    
                     </div>
                                    @php    
                                       $userdata = Session('user_data');
                                      if($userdata->department_id == 1){
                                          $text = 'View Profile';
                                          $url = URL::to('admin/employee_details/'.$data['employee_details']->id);
                                       }else{
                                           $text = 'My Profile';
                                          $url = URL::to('employee/myprofile');
                                       }
                                       $title = $data['title']; 
                                       @endphp
                                       @if($title != 'My Profile' && $title != 'Employee Details')
                     <div>
                                    <div class="pull-right cover-btn">

                                       <a href="{{ $url }}">
                                          <input type="hidden" id="emp_id" value="{{$data['employee_details']->id}}">
                                       <button type="button" class="btn btn-sm btn-primary m-b-10 m-r-10" style="line-height:33px;font-size:13px"><i class="icofont icofont-plus"></i>{{ $text }} </button>
                                       </a>
                                      
                                    </div>
                                 </div>
                                 @endif
                  </div>

               </div>

            </div>

         </div>


<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                     <div class="modal-header">
                       
                       <h4 class="modal-title" id="myModalLabel">
                        Edit Photo</h4>
                     </div>
                     <center>
                     <div class="modal-body">
                        <div id="upload-demo" class="center-block"></div>
                  </div>
                  </center>
                      <div class="modal-footer">
        <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
      </div>
    </div>
  </div>
</div>
<!-- <div class="modal fade" id="Modal-lightbox" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width:200px;">
        <div class="modal-content" >
         <div class="modal-header" style="padding:10px;">
             <h6 class="title" id="defaultModalLabel" style="font-size: 17px;"><b>Profile Image</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:left;font-size: 17px;" >
<span aria-hidden="true">&times;</span>
</button>
</div>
            <div class="modal-body" style="padding: 24px;">
               
                <img src="{{URL::to('uploads/users/'.$data['employee_details']->image)}}" alt="" class="img img-fluid" style="height: 150px; width:150px;">
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="Modal-lightbox" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document" style="width:300px;">
    <div class="modal-content">
        <div class="modal-header" style="padding:10px;">
            <h4 class="modal-title">Profile Image </h4>
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:left;font-size: 17px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                     
                    <div class="modal-body" style="padding: 24px;">
                       <img src="" alt="" class="img img-fluid view_image" style="height: 250px; width:250px;">
                    </div>
        </div>
    </div>
</div>
