@php 
   $description = [
      //'Project link' => $data['client_details']->project_link,
      'Portal' => $data['client_details']->portal,
      'Applied from account' => getValue($data['client_details']->applied_from_account,'Account'),
      'Date' => dateformat($data['client_details']->date),
      'Project cost' => $data['client_details']->project_cost,
      'BID by' => $data['client_details']->bid_by,
      'Scope' => $data['client_details']->scope,
      'Overivew' => $data['client_details']->overview,
      //'Invited by' => $data['client_details']->invited_by == 0?"Clients":"Company",
      'Additional note' => $data['client_details']->additional_note,
      //'Platform' => getValue($data['client_details']->plateform,'Platform'),
      'Technologies' => getValue($data['client_details']->technologies,'Techologies'),
      'Last conversion' => $data['client_details']->last_conversion,
      'Comments/Feedback from clients' => $data['client_details']->comments_from_clients,
   ];
   $i = 1;
@endphp 
<style>
.select2 {
 color: white;
  padding: 0px;
  font-size: 12px;
  border: none;
  cursor: pointer;
}

.select2-search__field {
    width: 70%!important;
}
.btn-sm {
    padding: 0px 14px!important;
}
.but{
       font-size: 10px;
    padding: 3px 45px;
    margin: 24px -29px 0px;
    }
label.error{
        color:red!important;
        
    }
</style>
<div class="row">
    <div class="col-sm-12">
       <div class="card">
            <form id="description_info" method="post">
          <div class="card-header">
             <h5 class="card-header-text">Description</h5>
             <button id="edit-description" type="button" class="btn btn-primary waves-effect waves-light f-right">
             <i class="icofont icofont-edit"></i>
             </button>
              <button id="description-save" type="submit" class="btn btn-primary waves-effect waves-light f-right" style="margin-right:5px;">Update
                         </button>
          </div>
          <div class="card-block">
             <div id="description-info" class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Portal</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->portal == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{getValue($data['client_details']->portal,'Platform')}}</span>
                                    @endif
                                  </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Date</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->date == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{dateformat($data['client_details']->date)}}</span>
                                    @endif
                                  </div>
                            </div>
                            <!--  <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Project Link</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->project_link == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{$data['client_details']->project_link}}</span>
                                    @endif
                                 </div>
                            </div> -->
                             <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Applied From Account</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->applied_from_account == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{getvalue($data['client_details']->applied_from_account,'Account')}}</span>
                                    @endif
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Project Cost</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->project_cost == ""  || $data['client_details']->currency_symbol == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{$data['client_details']->project_cost}} {{$data['client_details']->currency_symbol}}</span>
                                    @endif
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Bid By</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->bid_by == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{$data['client_details']->bid_by}}</span>
                                    @endif
                                  </div>
                            </div>
                            <!--  <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Invited By</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->invited_by == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                         @if($data['client_details']->invited_by == "0")
                                        <span class="social-user-name b-none p-t-0 text-muted">Clients</span>
                                        @elseif($data['client_details']->invited_by == "1")
                                        <span class="social-user-name b-none p-t-0 text-muted">Company</span>
                                        @elseif($data['client_details']->invited_by == "2")
                                        <span class="social-user-name b-none p-t-0 text-muted">Other</span>
                                        @endif
                                    @endif
                                 </div>
                            </div> -->
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Technologies</label>
                                 </div>
                                 <div class="col-md-6" >
                                    @if($data['client_details']->technologies == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{rtrim($data['client_details']->technologies,',')}}</span>
                                    @endif
                                 </div>
                            </div>
                             <!-- <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Platform</label>
                                 </div>
                                 <div class="col-md-6" >
                                    @if($data['client_details']->plateform == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted">{{getValue($data['client_details']->plateform,'Platform')}}</span>
                                    @endif
                                 </div>
                                
                            </div> -->
                        </div>
                        <div class="col-md-6">
                           
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Scope</label>
                                 </div>
                                 <div class="col-md-6" >
                                    @if($data['client_details']->id == "")
                                        <span class="social-user-name b-none p-t-0 text-muted" >-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted" ><a class=" get_description btn btn-primary btn-sm" data-id="{{$data['client_details']->id}}" data-type="3" style="color:white;">View</a></span>
                                    @endif
                                 </div>
                                 
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Overview</label>
                                 </div>
                                 <div class="col-md-6" >
                                    @if($data['client_details']->id == "")
                                        <span class="social-user-name b-none p-t-0 text-muted" >-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted" ><a class="get_description btn btn-primary btn-sm" data-id="{{$data['client_details']->id}}" data-type="4" style="color:white;">View</a></span>
                                    @endif
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Additional Notes</label>
                                 </div>
                                 <div class="col-md-6" >
                                    @if($data['client_details']->id == "")
                                        <span class="social-user-name b-none p-t-0 text-muted" >-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted" ><a class="get_notes btn btn-primary btn-sm" data-id="{{$data['client_details']->id}}" data-type="5" style="color:white;">View</a></span>
                                    @endif
                                 </div>
                            </div>
                            
                            <div class="row">
                                  <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Last Conversion</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->id == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted"><a class="get_client btn btn-primary btn-sm" data-id="{{$data['client_details']->id}}" data-type="1" style="color:white;">View</a></span>
                                    @endif
                                 </div>
                                 
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="social-label b-none p-t-0">Comments From Client</label>
                                 </div>
                                 <div class="col-md-6">
                                    @if($data['client_details']->id == "")
                                        <span class="social-user-name b-none p-t-0 text-muted">-</span>
                                    @else
                                        <span class="social-user-name b-none p-t-0 text-muted"><a class="get_client btn btn-primary btn-sm" data-id="{{$data['client_details']->id}}" data-type="2" style="color:white;">View</a></span>
                                    @endif
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <div id="edit-description-info" class="row">
                <div class="col-lg-12 col-md-12">
                       
                      <div class="row">
                              <div class="col-sm-6 form-group">
                                <label class="block ">Portal<span class="error">*</span></label>
                                <select class="form-control portal" name="portal">
                                    <option value="">Select Portal</option>
                                     @foreach(getPlatformList() as $key=>$val)
                                     <option {{$data['client_details']->portal == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                               
                                  <span class="messages"></span>
                            </div>
                          
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6 form-group applied_from d-none">
                                <label class="block ">Applied From Account<span class="error">*</span></label>
                                <select class="form-control" name="applied_from_account">
                                    <option value="">Select Account</option>
                                       @foreach(getAccountlist() as $key=>$val)
                                    <option {{$data['client_details']->applied_from_account == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                                  <span class="messages"></span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="block">Date<span class="error">*</span></label>
                                <input type="date" class="form-control" name="date" value="{{$data['client_details']->date}}">
                                  <span class="messages"></span>
                            </div>
                        </div>
                        <div class="row">
                            
                                <div class="col-sm-2 form-group">
                                <label class="block">Currency<span class="error">*</span></label>
                                <select class="form-control" name="cost_symbol">
                                     @foreach($data['currency'] as $key=>$val)
                                    <option value="{{$val->id}}" {{$data['client_details']->cost_symbol == $val->id ? 'selected':''}}>{{$val->symbol}} ({{$val->name}})</option>
                                     @endforeach
                                </select>
                                <span class="messages"></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label class="block">Project Cost<span class="error">*</span></label>
                                <input type="number" class="form-control" name="project_cost" value="{{$data['client_details']->project_cost}}" placeholder="Enter Project Cost">
                                </div>
                            <div class="col-sm-6 form-group">
                                <label class="block">Bid<span class="error">*</span></label>
                                <select class="form-control project_bid" id="bid_by" name="bid_by">
                                      @foreach($data['project_bid'] as $key=>$val)
                                    <option value="{{$val->id}}" {{$data['client_details']->bid_by == $val->id ? 'selected':''}}> {{$val->name}}</option>
                                     @endforeach
                                     <option value="-1" style="color: #01a9ac;">+ Add New Item</option>
                                </select>
                                <span class="messages"></span>
                            </div>
                            </div>
                         <div class="row">
                            
                            <div class="col-sm-6 form-group">
                                <label class="block">Scope<span class="error">*</span></label>
                                <textarea type="text" class="form-control" name="scope" value="" placeholder="Enter Scope" >{{$data['client_details']->scope}}</textarea>
                                <span class="messages"></span>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="block">Overview<span class="error">*</span></label>
                                 <textarea class="form-control" name="overview"  placeholder="Enter Overview">{{$data['client_details']->overview}}</textarea>
                                <span class="messages"></span>
                            </div>
                        </div>
                       
                        <div class="row">
                        <div class="col-sm-6 form-group">
                                <label class="block">Additional Notes</label>
                                 <textarea class="form-control" name="additional_note"  placeholder="Enter Additional Note">{{$data['client_details']->additional_note}}</textarea>
                               
                                <span class="messages"></span>
                        </div>
                        <div class="col-sm-6 form-group">
                                <label class="block">Technologies<span class="error">*</span></label>
                               <select name="technologies[]" class="select2 form-control show-tick " multiple="multiple" id="technologies">
                                    <option value="">Select</option>
                                     @foreach(GetTechologiesList() as $key=>$val)
                                    <option @if(strpos($data['client_details']->technologies, $val) !== FALSE) selected="true" @endif value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                                <span class="messages"></span>
                        </div>
                        </div>

                            @php
                            $status = GetClientsStatusList();
                            @endphp
                            <div class="row">
                            
                            <div class="col-sm-6 form-group">
                                <label class="block">Status<span class="error">*</span></label>
                                 <select class="form-control" name="status">
                                    <option value="id">Select Status</option>
                                    
                                    @foreach($status as $key=>$val)
                                    <option value="{{$key}}" {{$data['client_details']->status == $key?"selected":""}}>{{$val}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
             </div>
          </div>
            </form>
       </div>
    </div>
 </div>
<!--Conversion Model-->
    <div class="modal fade " id="conversion-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Conversion</h4>
             <div></div><button type="button" class="btn  btn-primary waves-effect waves-light" data-id="{{$data['client_details']->id}}" id="addconversion" data-add="Submit">Add New

                        </button> 
                    </div>
                    <div class="modal-body">
                            <div id="" class="client-form modal-body" style="display: none;">
                    <form method="post" action="/" id="client">
                     <input type="hidden" id="conversion_type" value="">
                    <input type="hidden"  name="comment_id" id="comment_id">
                   <input type="hidden" id="table_name" value="client_conversion">
                            <div class="form-group row">
                                               
                                                <div class="col-sm-8">
                                                    <label class="block ">Conversion</label>
                                                    <textarea name="comments" id="comments" type="text" class=" form-control comments" placeholder="Enter Comments" Required></textarea>
                                                   
                                                </div>
                                                   
                                               <div class="col-sm-4" style="padding-top: 4%;">
                                                   
                                                  <button type="button" class="btn  btn-primary waves-effect client" id="submit" value="" >Submit</button>
                                                  <button type="button" class="btn   btn-primary waves-effect waves-light reset-close"  id="close_client">Cancel</button>
                                                  
                                                </div>
                                            </div>
                        </form>
                        <hr>
                        </div>
                         <div class="card-block table_data">
                           
                             </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>
<!--Description Model-->
    <div class="modal fade " id="description-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Description</h4>
             
                    </div>
                    <div class="modal-body">
                            <input type="hidden" id="description_type" value="">
                         <div class="card-block desc_data">
                           
                             </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>

<!--Additional Notes Model-->
    <div class="modal fade " id="additional-notes-Modal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Description</h4>
             
                    </div>
                    <div class="modal-body">
                            <input type="hidden" id="additional_notes_type" value="">
                         <div class="card-block additional_notes_data">
                           
                             </div>
                     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-default waves-effect salary-close-btn " data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>

<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-1">
      <div class="md-content">
         <h3>Project Bid</h3>
         <div>
            @include('admin.client.add-project-bid')                
         </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>