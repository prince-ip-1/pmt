
@extends('layouts.default')
@section('content')

<div class="main-body">
    <div class="page-wrapper">
    	<!-- Page-header start -->
        @include('includes.breadcrumb')
        <!-- Page-header end -->
        <div class="page-body">

        	<div class="row">
                <div class="col-sm-12">
                    <!-- Basic Form Inputs card start -->
                     <form class="feedback-form" id="feedback-form" method="post" action="/" novalidate="">
                    <div class="card">
                      <div class="card-block">
                                          
                                            <div class=" row">
                                                <div class="col-sm-6 form-group">
                                                    <label class="block">Your Feedback</label>
                                                    <textarea rows="5" class="form-control" name="comment" id="comment"  placeholder="Write your feedback" required></textarea>
                                                    <span  class="messages text-c-pink" id="comment_message"></span>
                                                </div>
                                            </div>
                                            
                                           
                                            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                                            <button type="submit" data-id="save" class="btn btn-primary submit_btn_feedback save"  data-value="0">Submit</button>
                                         
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@stop
