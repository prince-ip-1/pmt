<style type="text/css">
   .nodisplay {
   display: none;
   }
   .display {
   display: all;
   }
   .select2-search__field {
   width: 325.968px !important;
   border:none !important;
   }
</style>
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="send_notification">
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <div class="page-body">
         <div class="row">
            <div class="col-sm-12">
               <!-- Basic Form Inputs card start -->
               <div class="card">
                  <div class="card-header">
                     <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                     </div>
                  </div>
                  <div class="card-block">
                     <div id="wizard1">
                        <section>
                           <form class="send-notification-form" method="post" action="/" id="main">
                            
                                 <div class="col-sm-8 form-group">
                                    <label class="block">Send To :</label>
                                    <div class="form-radio">
                                       <div class="radio radio-inline">
                                          <label>
                                          <input type="radio" class="term" name="send_to" data-type="1" value="1"  >
                                          <i class="helper"></i>All
                                          </label>

                                       </div>
                                       <div class=" radio radio-inline">
                                          <label>
                                          <input type="radio" class="term" name="send_to" data-type="2" value="2"  >
                                          <i class="helper"></i>Individual
                                          </label>
                                         
                                       </div>
                                        <span class="messages"></span>
                                    </div>
                                 </div>
                                 <div class="col-sm-6 nodisplay form-group" id="term2">
                                    <select name="employee[]" class="employee"  multiple="multiple">
                                       <option value="id">Select</option>
                                       @foreach(employeelist() as $user)
                                       <option value="{{$user->id}}">{{$user->full_name}}</option>
                                       @endforeach      
                                    </select>
                                    <span class="messages"></span>
                                 </div>
                           

                              <div class="form-group col-sm-6">
                              <label class="col-form-label">Title</label>
                              <div class="">
                                 <input type="text" class="form-control form-control-primary" name="title" id="title" placeholder="Enter Title">
                                 <span class="messages"></span>
                              </div>
                           </div>         
                              
                              <div class="form-group col-sm-6">
                                 <label class="col-form-label">Message</label>
                                 <textarea class="form-control form-control-primary" name="message" placeholder="Enter Message" rows="4"></textarea>
                                 <span class="messages"></span>
                              </div>
                              <div class="col-sm-12" ><br> 
                                 
                                 <button type="submit"  class="btn btn-primary">Submit</button>
                              </div>
                     </form>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@stop