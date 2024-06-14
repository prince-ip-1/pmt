   <style>
       .prod-view
       {
           margin-bottom: 30px;
       }
   </style>
   <div class="row simple-cards users-card clearfix div1 display">
            @foreach($data['client'] as $user)
            
            <div class="col-xl-3 col-md-6 col-sm-6 col-xs-12 ">
                  @php
                     if(!empty(($user->firstname) && !empty( $user->lastname) && !empty( $user->email)))
                     {
                     $class = "logo";
                     }
                     else{
                     $class="logo-empty";
                     }
                     @endphp
               <div class="card prod-view {{$class}}">
                  <div class="prod-item text-center">
                     <div class="prod-img">
                        <div class="option-hover">
                        @if(getDepartment() == 1)   
                <a href="{{URL::to('admin/edit_client/'.$user->id)}}" class=" btn btn-primary waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;"><i class="icofont icofont-ui-edit" style="margin-right:1px;" title="Edit"></i></a>
                          
                           </a>
               @elseif(isset($permission[8]->edit) && $permission[8]->edit == 1)
                <a href="{{URL::to('employee/edit_client/'.$user->id)}}" class=" btn btn-primary waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;"><i class="icofont icofont-ui-edit" style="margin-right:1px;" title="Edit"></i></a>
                          
                           </a>
               @endif
                          
                          @if(getDepartment() == 1)   
               <a href="{{URL::to('admin/client_details/'.$user->id)}}" class=" btn btn-warning waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;" title="View"><i class="icofont icofont-eye" style="margin-right:1px;"></i>
                         
                           </a>
               @elseif(isset($permission[8]->view) && $permission[8]->view == 1)
               <a href="{{URL::to('employee/client_details/'.$user->id)}}" class=" btn btn-warning waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;" title="View"><i class="icofont icofont-eye" style="margin-right:1px;"></i>
                         
                           </a>
               @endif
                           
                           <button type="button" class=" btn btn-danger waves-effect waves-light btn-group-sm btn-logo change_status " style="float: none;margin: 5px;" data-id="{{$user->status}}" title="Status"><i class="icofont icofont-heart"></i>
                          
                           </button>
                        </div>
                        <a href="#!" class="hvr-shrink" style="padding-top: 20px;">
                            
                        <img src="{{getImagePath($user->image,'clients')}}" class="img-fluid o-hidden" style="width:110px;height: 110px;margin-top: 15px;" alt="">
                        </a>
                          <a class="" style="left:0!important; position:absolute;padding:5px;"><i class="flag flag-icon-background flag-icon-{{$user->sort_name}}"></i></a>
                        <div class="p-new"><a style="top:0px" href="">{{$user->country_name}} </a></div>
                     </div>
                   
                     <div class="prod-info {{$class}} ">
                          @if(getDepartment() == 1)   
                <a href="{{URL::to('admin/client_details/'.$user->id)}}" class="txt-muted">
                           <h4>{{ $user->full_name}}</h4>
                        </a>
               @elseif(isset($permission[8]->view) && $permission[8]->view == 1)
               <a href="{{URL::to('employee/client_details/'.$user->id)}}" class="txt-muted">
                           <h4>{{ $user->full_name}}</h4>
                        </a>
               @endif
                       
                        <div class="m-b-10">
                           {{ $user->email }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
           
            @endforeach
            
            </div>
            
            
           
