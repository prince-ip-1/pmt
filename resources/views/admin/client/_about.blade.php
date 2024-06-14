<style>
  
    .error{
        color:red;
    }
</style>
<div class="tab-pane active" id="about">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card">
                               <form id="basic_info" method="post" name="basic_info">
                              <div class="card-header">
                                 <h5 class="card-header-text">Basic Information</h5>
                                 <button id="edit-btn" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                 <i class="icofont icofont-edit"></i>
                                 </button>
                                <button id="edit-save" type="submit" class="btn btn-primary waves-effect waves-light f-right" style="margin-right:5px;" onclick="updateValidation()">Update
                                             </button>
                                
                              </div>
                             
                        @php 
                        if($data['client_details']->status == 0){
                            $class = 'label-success';
                        }else if($data['client_details']->status == 1){
                            $class = 'label-danger';
                        }else{
                            $class = 'label-inverse';
                        }
                        @endphp
                              <div class="card-block">
                                 <div id="view-info" class="row">
                                    <div class="col-lg-6 col-md-12">
                                       <form>
                                          <table class="table table-responsive m-b-0">
                                             <tr>
                                                <th class="social-label b-none p-t-0">Full Name
                                                </th>
                                                @if($data['client_details']->full_name == "")
                                                    <td class="social-user-name b-none p-t-0 text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none p-t-0 text-muted">{{$data['client_details']->full_name}}</td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none p-t-0">Status</th>
                                                @if($data['client_details']->status == "")
                                                    <td class="social-user-name b-none p-t-0 text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none p-t-0 text-muted"> <label class="label {{$class}}">{{getValue($data['client_details']->status,'ClientStatus')}}</label></td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none">Gender</th>
                                                @if($data['client_details']->gender == "")
                                                    <td class="social-user-name b-none text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none text-muted">{{$data['client_details']->gender}}</td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none">Country</th>
                                                @if($data['client_details']->country_name == "")
                                                    <td class="social-user-name b-none text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none text-muted">{{$data['client_details']->country_name}}</td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none">Company Name</th>
                                                @if($data['client_details']->company_name == "")
                                                    <td class="social-user-name b-none text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none text-muted">{{$data['client_details']->company_name}}</td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none">Company Address</th>
                                                @if($data['client_details']->company_address == "")
                                                    <td class="social-user-name b-none text-muted">-</td>
                                                @else
                                                    <td class="social-user-name b-none text-muted">{{$data['client_details']->company_address}}</td>
                                                @endif
                                             </tr>
                                             <tr>
                                                <th class="social-label b-none p-b-0">Company Website</th>
                                                @if($data['client_details']->company_website == "")
                                                    <td class="social-user-name text-success b-none p-b-0 text-muted">-</td>
                                                @else
                                                    <td class="social-user-name text-success b-none p-b-0 text-muted"><a style="cursor: pointer;" target="_blank" href="{{$data['client_details']->company_website}}">Click here for visit</a></td>
                                                @endif
                                             </tr>
                                          </table>
                                       </form>
                                    </div>
                                 </div>
                                 <div id="edit-info" class="row">
                                     
                                    <div class="col-lg-12 col-md-12">
                                       
                                            <div class="text m-t-20">
                                             </div>
                                          <div class=" col-sm-12 ">
                                             First Name<span class="error">*</span><input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="{{$data['client_details']->firstname}}">
                                             <span class="messages "></span>
                                            
                                             <input type="hidden" name="type" id="client_type" value="1">
                                          </div>
                                          <div class="col-sm-12 "><br>
                                            Last Name<span class="error">*</span><input type="text" name="lastname" class="form-control" placeholder="Last Name" value="{{$data['client_details']->lastname}}">
                                            <span class="messages "></span>
                                          </div>
                                          <div class=" col-sm-12 "><br>
                                             <div class="form-radio">
                                                <div class="form-radio">
                                                   <label class="md-check p-0">Gender<span class="error">*</span></label>
                                                   <div class="radio radio-inline">
                                                      <label>
                                                      <input type="radio" {{($data['client_details']->gender == 'Male')?"checked":""}} value="Male" name="gender" checked="checked">
                                                      <i class="helper"></i>Male
                                                      </label>
                                                   </div>
                                                   <div class="radio radio-inline">
                                                      <label>
                                                      <input type="radio" {{($data['client_details']->gender == 'Female')?"checked":""}} value="Female"  name="gender">
                                                      <i class="helper"></i>Female
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                             <span class="messages "></span>
                                          </div>
                                          
                                           <div class="col-sm-12 "><br>
                                                    Country<span class="error">*</span>
                                                    <select class="form-control" name="country" id="country">
                                                        <option value="id">Select Country</option>
                                                        @foreach($country as $val)
                                                        <option value="{{$val->id}}" <?php echo ($data['client_details']->country == $val->id)?'selected':''?> >{{$val->country_name}}</option>
                                                        @endforeach
                                                        
                                                        
                                                    </select>
                                                    <span class="messages"></span>
                                            </div>
                                          <div class="col-sm-12"><br>
                                             Company Name<span class="error">*</span><input type="text" class="form-control" name="company_name" placeholder="Company Name" value="{{$data['client_details']->company_name}}">
                                             <span class="messages "></span>
                                          </div>
                                          <div class=" col-sm-12 "><br>
                                             Company Website<span class="error">*</span><input type="text" class="form-control" name="company_website" placeholder="Company Website" value="{{$data['client_details']->company_website}}">
                                             <span class="messages "></span>
                                          </div>
                                          <div class="col-sm-12 md-group-add-on"><br>
                                            Company Address<span class="error">*</span><textarea rows="5" cols="5" class="form-control" name="company_address" placeholder="Company Address">{{$data['client_details']->company_address}}</textarea>
                                            <span class="messages "></span>
                                          </div>
                                      
                                    </div>
                                 </div>
                              </div>
                               </form>
                           </div>
                        </div>
                     </div>
                  </div>