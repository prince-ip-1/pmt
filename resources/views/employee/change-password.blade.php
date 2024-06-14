<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<!-- <input type="hidden" id="table_name" value="employee"> -->
<form id="changepassword" method="post" action="/">

 <!-- {{csrf_field()}} -->
<div class="animation-model">
   <div class="md-modal md-effect-1" id="modal-c">
      <div class="md-content">
         <h3>Change Password</h3>
               
    <div class="form-group row">
      <label class="col-sm-4 col-form-label">Old Password</label>
      <div class="col-sm-6">
         <input type="password" class="form-control form-control-primary" name="oldpassword" id="oldpassword" >
         
         <span  class="messages" style="position: absolute;"><p  id="old_password_message" class=" text-danger error"></p></span>
      </div>
  </div>
   <div class="form-group row" style="padding-bottom: 1px;">
       <label class="col-sm-4 col-form-label">New Password</label>
      <div class="col-sm-6">
         <input id="pass_log_id" class="form-control form-control-primary input-icons" type="password" name="pass" value="" >
         
         <span style="    position: absolute;
    z-index: 9999;
    margin-top: -29px;
    left: 260px;"><i toggle="#password-field" class="fa fa-eye toggle-password"></i></span>
         <span class="messages"><p style="display: none" id="password_msg" class="text-danger error">Confirm password and password does not match</p> </span>

      </div>
   </div>
    <div class="form-group row">
       <label class="col-sm-4 col-form-label">Confirm Password</label>
      <div class="col-sm-6">
         <!-- <input id="cpass_log_id" class="form-control form-control-primary input-icons" type="password" name="confirmpassword" value="" ><i toggle="#cpassword-field" class="fa fa-eye toggle-cpassword"></i>
         <span class="messages"></span> -->

         <input id="confirmpassword" class="form-control form-control-primary input-icons" type="password" name="confirmpassword" >

        <span class="messages"><p style="display: none" id="cpassword_msg" class="text-danger error">Confirm password and password does not match</p></span>
      </div>
   </div>
   <div class="modal-footer">
      <button type="submit" id="submitButton" class="btn btn-primary btn-round  m-b-0">Submit</button>
      <button type="button" class="btn btn-primary waves-effect md-close btn-round">Close</button>
   </div>
      </div>
   </div>
   <div class="md-overlay"></div>
</div>
<!-- </form> -->
