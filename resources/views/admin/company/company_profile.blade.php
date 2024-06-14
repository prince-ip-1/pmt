@extends('layouts.default')
@section('content')
  @php $row= $data['company']; @endphp 
                                                
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
               @if(Session('user_type') == 'admin')
                  <div class="card-header">
                     <button id="edit-btn"{{--  data-id="@foreach($data['company'] as $row){{$row->id}}@endforeach" --}} type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                     <i class="icofont icofont-edit"></i>
                     </button>
               

                  </div>
                   @endif
                  <div class="card-block">
                     <div class="view-info">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="general-info">
                              <div class="row">
                                 <div class="col-lg-4">
                                 <p>Primary Logo</p>
                                                <img alt="image" class="logo-size img-radius" src="{{ getImagePath($row->primary_logo,'Companyprofile') }}">
                                           </div>
                                            <div  class="col-lg-4">
                                            <p>Logo</p>
                                                <img alt="image" class="logo-size img-radius" src="{{ getImagePath($row->logo,'Companyprofile')}}">
                                           </div>
                                            <div  class="col-lg-4">
                                            <p>Favicon Logo</p>
                                                <img alt="image" class="logo-size img-radius" src="{{ getImagePath($row->favicon_logo,'Companyprofile') }}">
                                           </div>
                                              
                                                
                              </div><br>
                                 <div class="row">
                                    <div class="col-lg-12 col-xl-6">
                                    
                                       <div class="table-responsive">
                                          
                                          <table class="table m-0">
                                             <tbody>
                                                  <tr>
                                                   <th scope="row">Since Year</th>
                                                   
                                                   <td>{{$row->since_year}}</td>
                                                  
                                                </tr>
                                                <tr>
                                                   <th scope="row">Company Name</th>
                                                   <td>{{$row->company_name}}</td>
                                                </tr>
                                                <tr>
                                                   <th scope="row">Company Email</th>
                                                   <td>{{$row->company_email}}</td>
                                                </tr>
                                                <tr>
                                                   <th scope="row">HR Email</th>
                                                   <td>{{$row->hr_email}}</td>
                                                </tr>
                                                 <tr>
                                                   <th scope="row">Address</th>
                                                   <td style="text-align: justify;word-wrap: break-word !important;white-space: inherit !important;">{{$row->address}}</td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                         
                                       </div>
                                    </div>
                                    <!-- end of table col-lg-6 -->
                                    <div class="col-lg-12 col-xl-6">
                                       <div class="table-responsive">
                                          <table class="table">
                                             <tbody>
                                              <tr>
                                                   <th scope="row">Mobile Number</th>
                                                   <td>{{$row->mobile_no}}</td>
                                                </tr>
                                                 <tr>
                                                   <th scope="row">Website</th>
                                                   <td><a href="{{$row->website_url}}" target="_blank">{{$row->website_url}}</a>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th scope="row">Social</th>
                                                   
                                                   <td><a href="{{$row->skype_url}}" target="_blank"><i class="ti-skype f-34 text-c-lightblue social-icon"></i></a>&nbsp;&nbsp;  
                                                   <a href="{{$row->linkedin_url}}" target="_blank"><i class="ti-linkedin f-34 text-c-blue social-icon"></i></a>&nbsp;&nbsp;
                                                   <a href="{{$row->instagram_url}}" target="_blank"><i class="ti-instagram f-34 text-c-green social-icon"></i></a>
                                                   </td>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                    
                                              
                                              
                                           
                                    <!-- end of table col-lg-6 -->
                                 </div>
                                 <!-- end of row -->
                              </div>
                              <!-- end of general info -->
                           </div>
                           <!-- end of col-lg-12 -->
                        </div>
                        <!-- end of row -->
                     </div>
                     <!-- end of view-info -->
                     <div class="edit-info">
                        <form id="main" method="post" action="/" novalidate="" >
                           <div class="col-lg-12">
                              
                                    <input type="hidden" id="table_name" value="company">

                                    <div class="form-group row">
                                    <div class="col-lg-6">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Company Name</label>
                                                      <input type="hidden" id="id" value="{{$row->id}}">
                                                      <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name"  value="{{$row->company_name}}">
                                                       <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Company Email</label>
                                                      <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Enter Company Email" value="{{$row->company_email}}">
                                                       <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">HR Email</label>
                                                      <input type="email" name="hr_email" id="hr_email" class="form-control" placeholder="Enter HR Email" value="{{$row->hr_email}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Address</label>
                                                      
                                                      <textarea type="text" name="address" id="address" class="form-control" placeholder="Enter Address"  >{{$row->address}}</textarea>
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Mobile Number</label>
                                                      <input type="tel" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile Number" value="{{$row->mobile_no}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                             <tr>
                                             <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Professional Tax</label>
                                                      <input type="tel" name="p_tax" id="p_tax" class="form-control" placeholder="Enter Professional Tax" value="{{$row->p_tax}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Website</label>
                                                      <input type="url" name="website_url" id="website_url" class="form-control" placeholder="website" value="{{$row->website_url}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             
                                          </tbody>
                                       </table>
                                    </div>
                                    <!-- end of table col-lg-6 -->
                                    <div class="col-lg-6">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Skype</label>
                                                      <input type="url" name="skype_url" id="skype_url" class="form-control" placeholder="Skype ID" value="{{$row->skype_url}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">LinkedIn</label>
                                                      <input type="url" name="linkedin_url" id="linkedin_url" class="form-control" placeholder="LinkedIn Profile" value="{{$row->linkedin_url}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Instagram</label>
                                                      <input type="url" name="instagram_url" id="instagram_url" class="form-control" placeholder="Instagram Profile" value="{{$row->instagram_url}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                   <div class=" form-group">
                                                      <label class="col-form-label">Since Year</label>
                                                      <input type="number" name="since_year" id="since_year" class="form-control" placeholder="Enter Year" value="{{$row->since_year}}">
                                                      <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Primary Logo</label>
                                                      <input name="primary_logo" id="primary_logo" type="file" class="form-control">
                                                       <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Logo</label>
                                                      <input name="logo" id="logo" type="file" class="form-control">
                                                       <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>
                                                    <div class=" form-group">
                                                      <label class="col-form-label">Favicon</label>
                                                      <input name="favicon_logo" id="favicon_logo" type="file" class="form-control">
                                                       <span class="messages"></span>
                                                   </div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                    <!-- end of table col-lg-6 -->
                                 </div>
                                 <!-- end of row -->
                                 <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light  m-b-0">Submit</button>
                                    
                                    <button type="button" id="edit-cancel" class="btn btn-default waves-effect">Close</button>
                                 </div>
                              </div>
                              <!-- end of edit info -->
                           </div>
                           <!-- end of col-lg-12 -->

                        </div>
                        <!-- end of row -->
                     </form>
                      <!-- end of form -->
                     </div>
                     <!-- end of edit-info -->
                  </div>
                  <!-- end of card-block -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@stop