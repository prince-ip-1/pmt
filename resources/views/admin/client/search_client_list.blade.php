            @foreach($data as $user)
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
                       
                           <a href="{{URL::to('admin/edit_client/'.$user->id)}}" class=" btn btn-primary waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;"><i class="icofont icofont-ui-edit" style="margin-right:1px;" title="Edit"></i></a>
                          
                           </a>
                        
                           <a href="{{URL::to('admin/client_details/'.$user->id)}}" class=" btn btn-warning waves-effect waves-light btn-group-sm btn-logo " style="float: none;margin: 5px;" title="View"><i class="icofont icofont-eye" style="margin-right:1px;"></i>
                         
                           </a>
                           <button type="button" class=" btn btn-danger waves-effect waves-light btn-group-sm btn-logo change_status " style="float: none;margin: 5px;" data-id="{{$user->status}}" title="Status"><i class="icofont icofont-heart"></i>
                          
                           </button>
                        </div>
                        <a href="#!" class="hvr-shrink" style="padding-top: 20px;">
                        <img src="{{getImagePath($user->image,'clients')}}" class="img-fluid o-hidden" style="width:110px;height: 110px;object-fit: cover;margin-top: 15px;" alt="prod1.jpg">
                        </a>
                          <a class="" style="left:0!important; position:absolute;padding:5px;"><i class="flag flag-icon-background flag-icon-{{$user->sort_name}}"></i></a>
                        <div class="p-new"><a style="top:0px" href="">{{$user->country_name}} </a></div>
                     </div>
                   
                     <div class="prod-info {{$class}} ">
                        <a href="{{URL::to('admin/client_details/'.$user->id)}}" class="txt-muted">
                           <h4>{{ $user->firstname }} {{ $user->lastname}}</h4>
                        </a>
                        <div class="m-b-10">
                           {{ $user->email }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
