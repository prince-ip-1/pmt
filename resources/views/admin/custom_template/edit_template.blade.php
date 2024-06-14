
@extends('layouts.default')
@section('content')
<input type="hidden" id="table_name" value="custom_template">

<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <div class="page-body">
         <div class="row">
            <div class="col-sm-12">
               <!-- Basic Form Inputs card start -->
               <form class="template_form" id="template_form" method="post" action="" novalidate="" enctype="multipart/form-data">
               <div class="card">
                 
                <div class="card-block">
                    <div class="row">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="template_id" value="{{$data['template_details']->id}}">
                                <div class="col-sm-6 form-group ">
                                    <label class="block">Template Title<span class="error">*</span></label>
                                    <input name="template_title" id="template_title" type="text" class=" form-control" value="{{$data['template_details']->template_title}}">
                                    <span class="error_message text-danger"></span>
                                 </div>
                    </div>
                     <div class="row">
                                
                                 <div class="col-sm-6 form-group ">
                                    <label class="block">Subject Email Template<span class="error">*</span></label>
                                    <input name="email_subject" id="email_subject" type="text" class=" form-control" value="{{$data['template_details']->email_subject}}">
                                    <span class="error_message text-danger"></span>
                                 </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group ">
                                    <label class="block">Template Description<span class="error">*</span></label>
                                     <textarea name="template_description" id="template_summernote"  value="{{$data['template_details']->template_description}}">{{$data['template_details']->template_description}}</textarea> 
                                    <span class="error_message1 text-danger"></span>
                        </div>
                    </div>         
                </div>
            </div>
            
                <button type="submit" class="btn btn-primary submit_template" onclick="checkTemplateValidation()">Submit</button>
                <button type="reset"   class="btn btn-default d-none">Reset</button>
              
                </form>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop