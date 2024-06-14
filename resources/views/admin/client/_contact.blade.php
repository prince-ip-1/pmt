<style>
    .error{
        color:red;
    }
</style>
<div class="row">
    <div class="col-sm-12">
       <div class="card">
            <form id="contact_info" method="post" name="contact_info">
          <div class="card-header">
             <h5 class="card-header-text">Contact Information</h5>
             <button id="edit-Contact" type="button" class="btn btn-primary waves-effect waves-light f-right">
             <i class="icofont icofont-edit"></i>
             </button>
              <button id="contact-save" type="submit" class="btn btn-primary waves-effect waves-light f-right" style="margin-right:5px;">Update
                         </button>
          </div>
          
          <div class="card-block">
             <div id="contact-info" class="row">
                <div class="col-lg-12 col-md-12">
                   <table class="table table-responsive m-b-0">
                      <tr>
                        <th class="social-label b-none p-t-0">Mobile Number</th>
                        @if($data['client_details']->contact_no == "")
                            <td class="social-user-name b-none p-t-0 text-muted">-</td>
                        @else
                            <td class="social-user-name b-none p-t-0 text-muted">{{$data['client_details']->contact_no}}</td>
                        @endif
                      </tr>
                      <tr>
                        <th class="social-label b-none">Email Address</th>
                        @if($data['client_details']->email == "")
                            <td class="social-user-name b-none text-muted">-</td>
                        @else
                            <td class="social-user-name b-none text-muted">{{$data['client_details']->email}}</td>
                        @endif
                      </tr>
                      <tr>
                        <th class="social-label b-none">Skype</th>
                        @if($data['client_details']->skype == "")
                            <td class="social-user-name b-none text-muted">-</td>
                        @else
                            <td class="social-user-name b-none text-muted">{{$data['client_details']->skype}}</td>
                        @endif
                      </tr>
                      <tr>
                        <th class="social-label b-none p-b-0">Linkedin</th>
                        @if($data['client_details']->linkedin == "") 
                            <td class="social-user-name b-none p-b-0 text-muted">-</td>
                        @else
                            <td class="social-user-name b-none p-b-0 text-muted">{{$data['client_details']->linkedin}}</td>
                        @endif
                      </tr>
                   </table>
                </div>
             </div>
             <div id="edit-contact-info" class="row">
                <div class="col-lg-12 col-md-12">
                  
                      <div class="col-sm-12"><br>
                         Mobile No<span class="error">*</span><input type="text" name="contact_no" class="form-control" placeholder="Mobile number" value="{{$data['client_details']->contact_no}}">
                         <span class="messages "></span>

                         <input type="hidden" name="type" id="client_type" value="2">
                      </div>
                      <div class="col-sm-12"><br>
                         Email<span class="error">*</span><input type="text" name="email"  class="form-control" placeholder="Email address" value="{{$data['client_details']->email}}">
                         <span class="messages "></span>
                      </div>
                      <div class="col-sm-12"><br>
                         Skype<input type="text" name="skype"  class="form-control" placeholder="Skype id" value="{{$data['client_details']->skype}}">
                      </div>
                      <div class="col-sm-12"><br>
                         Linkdin<input type="text" name="linkedin"  class="form-control" placeholder="Linkedin Id" value="{{$data['client_details']->linkedin}}">
                      </div>
                </div>
             </div>
          </div>
       </form>
       </div>
    </div>
 </div>