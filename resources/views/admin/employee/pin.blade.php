<style>
  
.userInput{
   display: flex;
   justify-content: center;
}
form input{
  display:inline-block;
  width:50px;
  height:50px;
  text-align:center;
  margin: 10px;
  font-family: arimo;
   font-size: 2.2rem;

}
form input:focus {
    box-shadow: none;
    border: 2px solid black
}
 </style>
                                    <div id="lock-screen" class="modal fade 3" role="dialog">
                                        <div class="modal-dialog">

                                            <div class="login-card card-block login-card-modal">
                                                <form method="post" id="office_lock" class="md-float-material">
                                                  
                                                    <div class="card m-t-15">
                                                        <div class="auth-box card-block">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <h3 class="text-center"><i class="icofont icofont-lock text-primary f-80"></i></h3>
                                                            </div>
                                                        </div>
                                                        
                                                          <h3 class="text-center">Enter your pin</h3>
                                                        <div class="input-group" style="padding-left: 74px;">
                                                         <div class="verification-code">
                                                              <div class="verification-code--inputs">
                                                                <input type="password" maxlength="1" id="first" />
                                                                <input type="password" maxlength="1" />
                                                                <input type="password" maxlength="1" />
                                                                <input type="password" maxlength="1" id="fourth" />
                                                               
                                                              </div>
                                                              <input type="hidden" name="pin" id="verificationCode" />
                                                            </div>

                                                           </div>
                                                          <div class="message"></div>
                                                        <!-- <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center office_lock_btn"><i class="icofont icofont-lock"></i> Submit</button>
                                                            </div>
                                                        </div> -->
                                                        <hr>
                                                        
                                                    </div>
                                                    </div>
                                                </form>
                                                <!-- end of form -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- lock screen end-->