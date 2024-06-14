<link href="{{URL::to('dist/assets/css/croppie.css')}}" type="text/css" rel="stylesheet">
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
.error{
  color:red;
}
.error_message{
    color:red;
}
.select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
  label.cabinet{
   display: block;
   cursor: pointer;
}

label.cabinet input.file{
   position: relative;
   height: 19%;
   width: auto;
   opacity: 0;
   -moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-13px;
}

#upload-demo1{
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
.image_size{
    height:100px;
    width:100px;
}
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" name="table_name" id="table_name" value="clients">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="client_id" id="client_id" value="{{$data['client']->id}}">
<input type="hidden" name="old_image" id="old_image" value="{{$data['client']->image}}">
<input type="hidden" name="new_image" id="new_image" value="">
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
        
            <div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                     <form class="" id="client_form" method="post" action="/" novalidate="" enctype="multipart/form-data" >
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <b>Basic Information</b>
                            </div>
                        </div>
                        <div class="card-block">
                                         <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">First Name<span class="error">*</span></label>
                                                    <input name="firstname" type="text" class=" form-control " value="{{$data['client']->firstname}}" placeholder="Enter First Name">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Last Name<span class="error">*</span></label>
                                                    <input name="lastname" type="text" class=" form-control" value="{{$data['client']->lastname}}" placeholder="Enter Last Name">
                                                    <span class="messages"></span>
                                                </div>
                                            
                                                <div class="col-sm-6 form-group ">
                                                    <label class="cabinet center-block">
                                                        Image
                										<figure>
                											<img src="{{getImagePath($data['client']->image,'clients')}}" name="image" class="gambar img-responsive image_size" id="item-img-output" />
                										  <!--<figcaption><i class="fa fa-camera"></i></figcaption>-->
                								    </figure>
                								    
                						            <input type="file" class="item-img file center-block fileChooser" data-id="{{$data['client']->id}}" name="image" id="fileChooser" value="{{URL::to('/uploads/clients/'.$data['client']->image)}}" style="overflow: inherit;opacity: 1;" onchange="return ValidateFileUpload()">
                									<div class="error_message"></div>
                									</label>
                                                   
                                                      <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Gender<span class="error">*</span></label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" {{($data['client']->gender == 'Male')?"checked":"";}} name="gender" value="Male">
                                                                <i class="helper"></i>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                           <label>
                                                                <input type="radio" {{($data['client']->gender == 'Female')?"checked":"";}}  name="gender" value="Female">
                                                                <i class="helper"></i>Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <span class="messages"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                            
                                            
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Company Name<span class="error">*</span></label>
                                                    <input name="company_name" type="text" class=" form-control " placeholder="Enter Company Name" value="{{$data['client']->company_name}}" >
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                <label class="block">Company Website<span class="error">*</span></label>
                                                    <input name="company_website" type="text" class=" form-control " value="{{$data['client']->company_website}}" placeholder="Enter Company Website">
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Company Address<span class="error">*</span></label>
                                                    <textarea class="form-control " name="company_address"  placeholder="Enter Address">{{$data['client']->company_address}}</textarea>
                                                      <span class="messages"></span>
                                                </div>
                                               
                                                 <div class="col-sm-6 form-group">
                                                     <label class="block">Country<span class="error">*</span></label>
                                               <select name="country" id="address-country" class="form-control">
                                                    <option value="">Select Country</option>
                                                    <!--@foreach($data['client'] as $val)
                                                    <option {{(strtoupper($data['client']->country)) == (substr($data['client']->ISO_code,0,2))?"selected":""}} value="{{$data['client']->id}}"></option>
                                                    @endforeach-->
                                                         @foreach($data['country'] as $val)
                                                    
                                                <option  {{$data['client']->country == (strtolower(substr($data['client']->short_name,0,2)))?"selected":""}} data-country-code="{{ strtolower(substr($val->short_name,0,2))}}" value="{{$val->id}}">{{$val->country_name}}</option>
                                                   @endforeach
                                                    </select>
                                                    <span class="messages"></span>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-left">
                                                        <b>Contact Information</b>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Mobile No<span class="error">*</span></label><br>
                                                    <input type="hidden" name="country_code" value="{{$data['client']->country_code }}"><input name="contact_no" type="tel"  id="txtPhone" class=" form-control txtbox " placeholder="Enter Mobile No" value="{{$data['client']->country_code }} {{$data['client']->contact_no}}" style="width:200%;">
                                                    <!--<input name="contact_no" type="tel"   id="txtPhone" class=" form-control txtbox " placeholder="Enter Mobile No" style="width:200%;">-->
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Email Id<span class="error">*</span></label>
                                                    <input  type="email" name="email" id="email" class=" form-control " value="{{$data['client']->email}}" placeholder="Enter Email Id" >
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                                
                                         
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Skype</label>
                                                    <input type="text" class="form-control color-class" name="skype" value="{{$data['client']->skype}}" placeholder="Enter Skype Id">
                                                      <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Linkedin</label>
                                                    <input type="text" class="form-control color-class" name="linkedin" value="{{$data['client']->linkedin}}" placeholder="Enter Linkedin Id">
                                                      <span class="messages"></span>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                               <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-left">
                                                        <b>Other Information</b>
                                                    </div>
                                                </div>
                                                <div class="card-block">
                                            <div class="row">
                                                 
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Portal<span class="error">*</span></label>
                                                    <select class="form-control portal" name="portal">
                                                        <option value="">Select Portal</option>
                                                         @foreach(getPlatformList() as $key=>$val)
                                                         <option {{$data['client']->portal == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                      <span class="messages"></span>
                                                </div>
                                              
                                                <div class="col-sm-6 form-group applied_from d-none">
                                                    <label class="block">Applied From Account<span class="error">*</span></label>
                                                    <select class="form-control" name="applied_from_account">
                                                        <option value="">Select Account</option>
                                                         @foreach(getAccountList() as $key=>$val)
                                                        <option {{$data['client']->applied_from_account == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                      <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Date<span class="error">*</span></label>
                                                    <input type="date" class="form-control" name="date" value="{{$data['client']->date}}">
                                                      <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                               <div class="col-sm-2 form-group">
                                                    <label class="block">Cost<span class="error">*</span></label>
                                                    <select class="form-control" name="cost_symbol">
                                                        @foreach($data['country'] as $key=>$val)
                                                        <option value="{{$val->id}}" {{$data['client']->cost_symbol == $val->id ? 'selected':''}}>{{$val->currency_symbol}}</option>
                                                         @endforeach
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label class="block">Project Cost<span class="error">*</span></label>
                                                    <input type="text" class="form-control " name="project_cost" value="{{$data['client']->project_cost}}" placeholder="Enter Project Cost" >
                                                    
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Bid<span class="error">*</span></label>
                                                    <select class="form-control" name="bid_by">
                                                        <option value="">Select Bid</option>
                                                         @foreach(getBid() as $key=>$val)
                                                        <option {{$data['client']->bid_by == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                        </select>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                             <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Scope<span class="error">*</span></label>
                                                    <textarea type="text" class="form-control " name="scope" value="" placeholder="Enter Scope">{{$data['client']->scope}}</textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Overview<span class="error">*</span></label>
                                                     <textarea class="form-control " name="overview"  placeholder="Enter Overview">{{$data['client']->overview}}</textarea>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Applied By<span class="error">*</span></label>
                                                     <select class="form-control" name="invited_by">
                                                        <option value="">Select Invitation</option>
                                                        <option value="{{1}}" {{$data['client']->invited_by == 1 ? 'selected':''}}>Company</option>
                                                        <option value="{{0}}" {{$data['client']->invited_by == 0 ? 'selected':''}}>Client</option>
                                                        <option value="{{2}}" {{$data['client']->invited_by == 2 ? 'selected':''}}>Other</option>
                                                       
                                                    </select>
                                                   
                                                    <span class="messages"></span>
                                                </div>
                                               <!-- <div class="col-sm-6 form-group">
                                                    <label class="block">Response Date From Client*</label>
                                                    <input type="date" class="form-control" id="response_date" name="response_date_by_client" value="{{$data['client']->response_date_by_client}}" placeholder="">
                                                    <span class="messages"></span>
                                                </div>-->
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Additional Notes</label>
                                                     <textarea class="form-control" name="additional_note"  placeholder="Enter Additional Note">{{$data['client']->additional_note}}</textarea>
                                                   
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <!--<div class="row">-->
                                                
                                                
                                               <!-- <div class="col-sm-6 form-group">
                                                    <label class="block">Reply Date From You*</label>
                                                    <input type="date" class="form-control" id="reply_date" name="reply_date_from_you" value="{{$data['client']->reply_date_from_you}}" placeholder="">
                                                    <span class="messages"></span>
                                                </div>-->
                                            
                                            
                                           
                                                <!--</div>-->
                                                <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Platform<span class="error">*</span></label>
                                                     <select class="form-control" name="plateform" id="plateform">
                                                     <option value="">Select Platform</option>
                                                     @foreach(getPlatformList() as $key=>$val)
                                                        <option {{$data['client']->plateform == $key?"selected":""}} value="{{$key}}">{{$val}}</option>
                                                        @endforeach

                                                    </select>
                                                   
                                                    <span class="messages"></span>
                                                </div>
                                               
                                                 @php
                                                $tech = GetTechologiesList();
                                                @endphp
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Technologies<span class="error">*</span></label>
                                                     <select class="form-control select2 " name="technologies[]" multiple="multiple">
                                                    <option value="id">Select Technology</option>
                                                        @foreach($tech as $key=>$val)
                                                        <option value="{{$key}}" @if(strpos($data['client']->technologies,$key) !== false) selected @endif>{{$val}}</option>
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
                                                        <option value="">Select Status</option>
                                                        
                                                        @foreach($status as $key=>$val)
                                                        <option value="{{$key}}" {{$data['client']->status == $key?"selected":""}}>{{$val}}</option>

                                                        @endforeach
                                                       
                                                    </select>
                                                   
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary submit_client">Update</button>
                                            
                                    </form>
                          
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@stop
<div class="modal fade" id="clientImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<div class="modal-header">
	 <h4 class="modal-title" id="myModalLabel" style="text-align:center">Image</h4>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	 
	</div>
	<div class="modal-body modal-body1">
        <div id="upload-demo1" class="center-block"></div>
    </div>
	 <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="clientImageBtn" class="btn btn-primary save-modal">Crop</button>
     </div>
    </div>
  </div>
</div>