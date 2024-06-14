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
.btn-sm {
    padding: 0px 14px!important;
}
.error{
  color:white;
}
.error_message{
    color:red;
}
.email_verify{
    color:red;
}
.hint{
    color:gray;
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
<input type="hidden" id="table_name" value="clients">
<input type="hidden" id="client_id" value="">
<input type="hidden" name="old_image" id="old_image" value="">

<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">
        
            <div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                    <form class="client_form" id="client_form" method="post" action="/" novalidate="" enctype="multipart/form-data" >
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-left">
                                <b>Basic Information</b>
                            </div>
                        </div>
                        <div class="card-block">
                                         <div class="row">
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">First Name<span class="error" style="color:red;">*</span></label>
                                                    <input name="firstname" type="text" class=" form-control " value="" placeholder="Enter First Name">
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group ">
                                                    <label class="block">Last Name<span class="error" style="color:red;">*</span></label>
                                                    <input name="lastname" type="text" class=" form-control" value="" placeholder="Enter Last Name">
                                                    <span class="messages"></span>
                                                </div>
                                            
                                                <div class="col-sm-6 form-group ">
                                                    <!--<div class="text-right"><i class="fa fa-close"></i></div>-->
                                                    
                                                    <label class="cabinet center-block">
                                                        Image
                										<figure>
                											<img src="" class="gambar img-responsive image_size" id="item-img-output" />
                										  <!--<figcaption><i class="fa fa-camera"></i></figcaption>-->
                								    </figure>
                								    
                						            <input type="file" class="item-img file center-block" name="image" id="fileChooser" style="overflow: inherit;opacity: 1;" onchange="return ValidateFileUpload()">
                									<div class="error_message"></div>
                									</label>
                                                   
                                                      <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Gender<span class="error">*</span></label>
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Male" checked>
                                                                <i class="helper"></i>Male
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="gender" value="Female">
                                                                <i class="helper"></i>Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Company Name<span class="error">*</span></label>
                                                    <input name="company_name" type="text" class=" form-control " placeholder="Enter Company Name" >
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Company Website<span class="error">*</span></label>
                                                    <input name="company_website" type="text" class=" form-control " placeholder="Enter Company Website" >
                                                    <span class="hint">Hint : https://www.example.com</span>
                                                    <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Company Address<span class="error">*</span></label>
                                                    <textarea class="form-control " name="company_address"  placeholder="Enter Address" ></textarea>
                                                      <span class="messages"></span>
                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Country<span class="error">*</span></label>
                                                   
                                                    <select name="country" id="address-country" class="form-control">
                                                        <option value="">Select</option>
                                                         
                                                    @foreach($data['country'] as $val)
                                                    
                                                <option @php if(strtolower(substr($val->short_name,0,2)) == 'in') { echo "selected"; } @endphp data-country-code="{{ strtolower(substr($val->short_name,0,2))}}" value="{{$val->id}}">{{$val->country_name}}</option>
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
                                              
                                                <div class="col-sm-6 form-group" >
                                                    <label class="block">Mobile No<span class="error">*</span></label><br>
                                                    <input name="contact_no" type="number"   id="contact_no" class=" form-control txtbox  " placeholder="Enter Mobile No" >
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Email Id<span class="error">*</span></label>
                                                    <input  type="email" name="email" id="email" class=" form-control " placeholder="Enter Email Id" >
                                                    <span class="messages"></span>
                                                    <!--<div class="email_verify"></div>-->
                                                </div>
                                            </div>
                                                
                                         
                                            <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Skype</label>
                                                    <input type="text" class="form-control " name="skype" value="" placeholder="Enter Skype Id" >
                                                      <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Linkedin</label>
                                                    <input type="text" class="form-control " name="linkedin" value="" placeholder="Enter Linkedin Id" >
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
                                                         @foreach(getPlatformList() as $key=>$row)
                                                        <option value="{{$key}}">{{$row}}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                      <span class="messages"></span>
                                                </div>
                                              <div class="col-sm-6 form-group applied_from d-none">
                                                    <label class="block">Applied From Account<span class="error">*</span></label>
                                                    <select class="form-control" name="applied_from_account">
                                                        <option value="">Select Account</option>
                                                        @foreach(getAccountList() as $key=>$val)
                                                        <option value="{{$key}}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                      <span class="messages"></span>
                                                </div>
                                                  <!-- <div class="col-sm-6 form-group">

                                                    <label class="block">Project Link</label>
                                                    <input type="text" class="form-control" name="project_link" value="" placeholder="Enter Project Link">
                                                      <span class="messages"></span>
                                                </div> -->
                                               
                                            </div>
                                            <div class="row">
                                                
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Date<span class="error">*</span></label>
                                                    <input type="date" class="form-control" name="date" id="applied_date" value="date">
                                                      <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-sm-2 form-group">
                                                    <label class="block">Currency<span class="error">*</span></label>
                                                    <select class="form-control" name="cost_symbol" id="cost_symbol">
                                                        <option value="">Select Currency</option>
                                                        @foreach($data['currency'] as $val)
                                                        <option  value="{{$val->id}}">{{$val->symbol}} ({{$val->name}})</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label class="block">Project Cost<span class="error">*</span></label>
                                                    <input type="number" class="form-control " name="project_cost" value="" placeholder="Enter Project Cost" >
                                                    
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Project Bid/Deal<span class="error">*</span></label>
                                                    <select class="form-control project_bid" id="bid_by" name="bid_by">
                                                        <option value="">Select Bid/Deal</option>
                                                        @foreach($data['project_bid'] as $key=>$row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                        <option value="-1" style="color: #01a9ac;">+ Add New Item</option>
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                             <div class="row">
                                                
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Scope<span class="error">*</span></label>
                                                    <textarea  class="form-control " name="scope" value="" placeholder="Enter Scope" ></textarea>
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Overview<span class="error">*</span></label>
                                                     <textarea class="form-control " name="overview"  placeholder="Enter Overview" ></textarea>
                                                    <span class="messages"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                               <!--  <div class="col-sm-6 form-group">
                                                    <label class="block">Applied By<span class="error">*</span></label>
                                                     <select class="form-control" name="invited_by">
                                                        <option value="">Select Invitation</option>
                                                        <option value="1">Company</option>
                                                        <option value="0">Client</option>
                                                        <option value="2">Other</option>
                                                    </select>
                                                   
                                                    <span class="messages"></span>
                                                </div> -->
                                               <!-- <div class="col-sm-6 form-group">
                                                    <label class="block">Response Date From Client<span class="error">*</span></label>
                                                    <input type="date" class="form-control" id="response_date" name="response_date_by_client" value="" placeholder="">
                                                    <span class="messages"></span>
                                                </div>-->
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Additional Notes</label>
                                                     <textarea class="form-control" name="additional_note"  placeholder="Enter Additional Note"></textarea>
                                                   
                                                    <span class="messages"></span>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Technologies<span class="error">*</span></label>
                                                   <select name="technologies[]" class="select2 form-control show-tick technology is-invalid " multiple="multiple">
                                                        <!--<option value="id">Select</option>-->
                                                         @foreach(GetTechologiesList() as $key=>$t)
                                                        <option value="{{$key}}">{{$t}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="messages"></span>
                                                </div>

                                            </div>
                                            <!--<div class="row">-->
                                                
                                                
                                               <!-- <div class="col-sm-6 form-group">
                                                    <label class="block">Reply Date From You<span class="error">*</span></label>
                                                    <input type="date" class="form-control" id="reply_date" name="reply_date_from_you" value="" placeholder="">
                                                    <span class="messages"></span>
                                                </div>-->
                                            
                                            
                                            
                                                <!--</div>-->
                                                <div class="row">
                                                
                                                <!-- <div class="col-sm-6 form-group">
                                                    <label class="block">Platform<span class="error">*</span></label>
                                                     <select class="form-control" name="plateform">
                                                        <option value="">Select Platform</option>
                                                         @foreach(getPlatformList() as $key=>$row)
                                                        <option value="{{$key}}">{{$row}}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                    <span class="messages"></span>
                                                </div> -->
                                                
                                            </div>

                                            <div class="row">
                                                
                                                 <div class="col-sm-6 form-group">
                                                    <label class="block">Last Conversion<span class="error">*</span></label>
                                                    <td>&nbsp<button id='add-row' class='btn btn-primary btn-sm' type='button' value='Add' style="margin-top: -10px;"/>Add</button>
                                                    </td><br>
                                                    <table id="test-table" class="table table-condensed">
                                                        <tbody id="test-body">
                                                            <tr id="row0">
                                                            <td>
                                                                <textarea class="form-control" name="last_conversion[]"  placeholder="Enter Last Conversion" style="width:385px;" ></textarea>
                                                            </td>
                                                            <!--<td class="deleteconv">-->
                                                            <!--    <span  class="delete-row0" value="Delete" style="margin-top:7px;"/><i class="fa fa-close"></i></span>-->
                                                            <!--</td>-->
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <span class="messages"></span>
                                                </div>
                                            
                                            
                                            <div class="col-sm-6 form-group">
                                                    <label class="block">Comments From Clients<span class="error">*</span></label>
                                                    <td>&nbsp<button id='add-row1' class='btn btn-primary btn-sm' type='button' value='Add' style="margin-top: -10px;" / >Add</button>
                                                    </td><br>
                                                     <table id="test-table" class="table table-condensed">
                                                   <tbody id="test1-body">
                                                    <tr id="row0">
                                                      <td>
                                                        <textarea class="form-control " name="comments_from_clients[]"  placeholder="Enter Comments" style="width:385px;" ></textarea>
                                                      </td>
                                                      <!-- <td class="deletecomm">-->
                                                      <!--  <span id="delete" class="delete-row  deleterow delete1"  value='Delete' style="margin-top:7px;"/><i class="fa fa-close"></i></span>-->
                                                      <!--</td>-->
                                                       </tr>
                                                    </tbody>
                                                    </table>
                                                    
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
                                                        @foreach($status as $k=>$a)
                                                        <option value="{{$k}}">{{$a}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                                                                    
                                            
                                            <button type="submit" class="btn btn-primary submit_client" >Submit</button>
                                            
                                    </form>
                         
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

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
@stop
