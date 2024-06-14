<!DOCTYPE html>
<html lang="en">
<head>
    <title>PMT</title>
   
    <!-- Meta -->
    <base id="base_url" data-href="https://bluepixeltech.com/pmt/public/">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{AdminLogo(2)}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/bootstrap/css/bootstrap.min.css?v=1.2')}}">
    <!-- jquery file upload Frame work -->
    <link href="{{URL::to('dist/assets/pages/jquery.filer/css/jquery.filer.css')}}" type="text/css" rel="stylesheet">
    <link href="{{URL::to('dist/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}" type="text/css" rel="stylesheet">
    <!-- Time line css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/timeline/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/icon/icofont/css/icofont.css')}}">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{URL::to('dist\bower_components\select2\css\select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::to('dist\assets\icon\flag-icons\css\flag-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/icon/feather/css/feather.css')}}">
    <!--forms-wizard css-->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/jquery.steps/css/jquery.steps.css')}}">
    <!-- Calender css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/fullcalendar/css/fullcalendar.css')}}">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/style.css?v=1.2')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/jquery.mCustomScrollbar.css')}}">
    

    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/sweetalert/css/sweetalert.css')}}">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/component.css')}}">

    <!--start  User Profile -->

    <!-- Date-time picker css -->
    <!-- <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}"> -->
    <!-- Date-range picker css  -->
    <!-- <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/bootstrap-daterangepicker/css/daterangepicker.css')}}"> -->
    <!-- Date-Dropper css -->
    <!-- <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/datedropper/css/datedropper.min.css')}}"> -->
    <!-- Data Table Css -->
    <!-- <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- end User Profile  -->

    <!-- department -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    
     <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets\pages\j-pro\css\j-forms.css')}}">
     <!-- priyanka -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/custome.css')}}">
    <!-- Switch component css -->
    <!-- toolbar css -->
    <!--<link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/toolbar/jquery.toolbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/pages/toolbar/custom-toolbar.css')}}">-->
    
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\switchery\css\switchery.min.css')}}">
    <!-- priyanka -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery/js/jquery.min.js')}}"></script>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            
            @include('includes.navbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @php
                        $usersession = Session('user_data');
                        $userdata = EmployeeDetailById($usersession->id);
                        @endphp
                    @if($usersession->department_id == 1)
                        @include('includes.sidebar')
                    @elseif(!empty($userdata->permissions))
                       @include('includes.access_sidebar')
                    @elseif(empty($userdata->permissions))
                        @include('includes.empsidebar')
                    @endif
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
     @include('employee.change-password')
    <!-- Required Jquery -->
    
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
     <script type="text/javascript" src="{{URL::to('dist\assets\pages\flag-icons.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/modernizr/js/modernizr.js')}}"></script>
    
    <!-- Switch component js -->
     <script type="text/javascript" src="{{URL::to('dist\bower_components\switchery\js\switchery.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::to('dist\assets\pages\advance-elements\swithces.js')}}"></script>
   
   
    <!-- Chart js -->
    <!-- <script type="text/javascript" src="{{URL::to('dist/bower_components/chart.js/js/Chart.js')}}"></script> -->

    <!-- jquery file upload js -->
    <script src="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/js/jquery.filer.min.js"></script>
    <!-- <script src="{{URL::to('dist/assets/pages/filer/custom-filer.js')}}" type="text/javascript"></script> -->
    <script src="{{URL::to('dist/assets/pages/filer/jquery.fileuploads.init.js')}}" type="text/javascript"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-file-upload/4.0.11/jquery.uploadfile.min.js" integrity="sha512-uwNlWrX8+f31dKuSezJIHdwlROJWNkP6URRf+FSWkxSgrGRuiAreWzJLA2IpyRH9lN2H67IP5H4CxBcAshYGNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- amchart js -->
    <script src="{{URL::to('dist/assets/pages/widget/amchart/amcharts.js')}}"></script>
    <script src="{{URL::to('dist/assets/pages/widget/amchart/serial.js')}}"></script>
    <script src="{{URL::to('dist/assets/pages/widget/amchart/light.js')}}"></script>
    <script src="{{URL::to('dist/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/js/SmoothScroll.js')}}"></script>

    <!--Forms - Wizard js-->
    <script src="{{URL::to('dist/bower_components/jquery.cookie/js/jquery.cookie.js')}}"></script>
    <script src="{{URL::to('dist/bower_components/jquery.steps/js/jquery.steps.js?v='.filemtime(public_path('dist/bower_components/jquery.steps/js/jquery.steps.js')))}}"></script>
    <script src="{{URL::to('dist/bower_components/jquery-validation/js/jquery.validate.js')}}"></script>

    <!-- custom js -->
    <script src="{{URL::to('dist/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <!-- <script type="text/javascript" src="{{URL::to('dist/assets/pages/dashboard/custom-dashboard.js')}}"></script> -->

    <!-- ------------ Start Department ------------ -->

   
    <!--Start Department  -->

    <!-- Editable-table js -->
    <!--<script type="text/javascript" src="{{URL::to('dist/assets/pages/edit-table/jquery.tabledit.js')}}"></script>-->
    <!--<script type="text/javascript" src="{{URL::to('dist/assets/pages/edit-table/editable.js')}}"></script>-->
    <!-- sweet alert js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
    <!--<script type="text/javascript" src="{{URL::to('dist/assets/js/modal.js')}}"></script>-->
    <!-- sweet alert modal.js intialize js -->
    <!-- modalEffects js nifty modal window effects -->
    <script type="text/javascript" src="{{URL::to('dist/assets/js/modalEffects.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/js/classie.js')}}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>

    <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/form-validation/validate.js')}}"></script>
    <!--<script type="text/javascript" src="{{URL::to('dist/assets/pages/form-validation/form-validation.js')}}"></script>-->
    @include('layouts.form-validation')

    <!-- ------------ end Department ------------ -->

    <!-- ------------ start User Profile ------------ -->

    <!-- Bootstrap date-time-picker js -->
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/advance-elements/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/bootstrap-daterangepicker/js/daterangepicker.js')}}"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/datedropper/js/datedropper.min.js')}}"></script>
    <!-- data-table js -->
    <script src="{{URL::to('dist/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- ck editor -->
    <script src="{{URL::to('dist/assets/pages/ckeditor/ckeditor.js')}}"></script>
    <!-- echart js -->
    <script src="{{URL::to('dist/assets/pages/chart/echarts/js/echarts-all.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('dist/assets/pages/user-profile.js')}}"></script>


    <!--end  User Profile -->
    <!-- Select 2 js -->
    <script type="text/javascript" src="{{URL::to('dist\bower_components\select2\js\select2.full.min.js')}}"></script>

    <!-- calender js -->
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/full-calender/calendar.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/fullcalendar/js/fullcalendar.min.js')}}"></script>
    
    
    <script src="{{URL::to('dist/assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>

    <script src="{{URL::to('dist/assets/js/pcoded.min.js')}}"></script>
    <!-- custom js -->
    <script src="{{URL::to('dist/assets/js/vartical-layout.min.js')}}"></script>
   
    <script type="text/javascript" src="{{URL::to('dist/assets/js/script.min.js')}}"></script>

    <!--end  User Profile -->

    <!-- Department -->
    <!-- data-table js -->
    <script src="{{URL::to('dist/bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\data-table-custom.js')}}?v=1.0"></script>
    
     <!-- radial chart -->
    <link rel="stylesheet" href="{{URL::to('dist\assets\pages\chart\radial\css\radial.css')}}" type="text/css" media="all">
   
<script>
 /*priyanka*/   
function addCSRFRequest()
{
    var params='';
    params+="_token="+"{{csrf_token();}}";
    return params;
}
function alertMessage(type,message){
    if(type == 'success'){
        //swal("Success",message, "success");
          swal({
             title: "Success",
             text: message,
             type: "success",
             timer: 3000
             });
            /* function () {
                //location.reload(true);
                tr.hide();
             };*/
    }else if(type == 'warning') {
        swal({
              title: "Warning",
              text: message,
              type: "warning",
              timer: 3000
            });
    }
    else{ 
       // swal("Error", message, "error");
         swal({
              title: "Error",
              text: message,
              type: "error",
              button: "OK",
              timer: 3000
            });
    }
    /*swal({
        title: "Are you sure?",
        text: "Your will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
    function(){
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });*/
}


    /*priyanka*/
    var table = $('#table_name').val();
    var URL = $('#action').val();
    var DELETE_URL = "{{URL::to('common/delete')}}";
    var CHANGE_STATUS_URL = "{{URL::to('common/change_status')}}";
    var GET_DATA_URL = "{{URL::to('common/getDataById')}}";
  
    $(document).on('click','.delete_data',function() {
        var id = $(this).attr('data-id'); 
       
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            // closeOnConfirm: false
        }, function () {
             $.ajax({
            type: "post",
            url: DELETE_URL,
            data: {   "_token": "{{ csrf_token() }}",
                    "id":id,
                    table:table
                  },
            success: function (data) {
               if(data.status == 'true'){
                alertMessage('success',data.message);
                console.log($(this).closest('tr').remove());
                $('#table_tr_'+id).remove()
                /*setTimeout(function(){
                                location.reload();
                            }, 3000);*/
            }else{
                alertMessage('error',data.message);
            } 
                }         
             }); 
        });
    });
    $(document).on('click','.change_status',function(e) { 
       e.preventDefault();
            var id = $(this).attr('data-id'); 
            var type = $(this).attr('data-type'); 
                 $.ajax({
                type: "post",
                url: CHANGE_STATUS_URL,
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "type":type,
                        "table":table
                    },
                success: function (data) { 
                 var result =  JSON.parse(data); 
                  if(result.status == 'true'){
                  switch(table){
                     case 'clients':
                        if(result.data.status == 1){
                            var  deactive = '<button type="button" title="You want to active this client?" class="btn btn-warning btn-icon waves-effect waves-light hvr-bounce-in option-icon change_status" data-id="'+id+'" data-type="1" id="change_status'+id+'"><i class="icofont icofont-ui-check"></i></button>';     
                          
                         }else{
                               var  deactive = '<button type="button" title="You want to deactive this client?" class="btn btn-danger btn-icon waves-effect waves-light hvr-bounce-in option-icon change_status" data-id="'+id+'" data-type="0" id="change_status'+id+'"><i class="icofont icofont-ui-close"></i></button>';  
                        }
                            $('#change_status'+id).html(deactive);
                     break;

                     default:

                         if(result.data.status == 1){
                           var  deactive = '<a class="change_status"  data-id="'+id+'"data-type="1"><span class="label label-success">Active</span></a>';  
                         }else{
                              var  deactive = '<a class="change_status"  data-id="'+id+'" data-type="0"><span class="label label-warning">Deactive</span></a>';     
                        }
                            $('#change_status'+id).html(deactive);
                     break;
                    }
                $('#change_status'+id).html(deactive);
              }


         }
         });
    });
     $(document).on('click','.close_data',function(e) {
        e.preventDefault();
         var id = $(this).attr('data-id');
         $('#table_tr_'+id).find('.tabledit-span_'+id).show();
         $('#table_tr_'+id).find('.tabledit-input_'+id).hide();
                        
    })
    $(document).on('click','.edit_data',function(e) { 
       e.preventDefault();
        local_id = localStorage.getItem('id');
        $('#table_tr_'+local_id).find('.tabledit-span_'+local_id).show();
        $('#table_tr_'+local_id).find('.tabledit-input_'+local_id).hide();
            var id = $(this).attr('data-id'); 
              localStorage.setItem('id',id);
              
                 $.ajax({
                type: "post",
                url: GET_DATA_URL,
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "table":table
                    },
                success: function (data) { 
                 var result =  JSON.parse(data); 
                  
                 if(result.status == 'true'){ 
                    switch(table){

                        case 'department':
                            $( this ).toggleClass( '#table_tr_'+id );
                           
                           
                      
                         $('#table_tr_'+id).find('.tabledit-span_'+id).hide();
                         $('#table_tr_'+id).find('.tabledit-input_'+id).show();
                          //$("this").addClass("active").siblings().removeClass("active"); 
                         //$('#table_tr_'+id).addClass('active');
                          
                           /* $("#department_id_'+id+' > option"). each(function() { 

                                if(this. value == result.data.dept_id)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });*/
                              console.log("#status_"+id+" > option");
                           $("#status_"+id+" > option"). each(function() { 
                                if(this. value == result.data.status)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                        break;

                        case 'designation':
                            $('#table_tr_'+id).find('.tabledit-span_'+id).hide();
                         $('#table_tr_'+id).find('.tabledit-input_'+id).show();
                            $("#department_id_"+id+" > option"). each(function() { 

                                if(this. value == result.data.dept_id)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                           $("#status_"+id+" > option"). each(function() { 
                                if(this. value == result.data.status)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                        break;

                         case 'holiday':
                            $('#table_tr_'+id).find('.tabledit-span_'+id).hide();
                            $('#table_tr_'+id).find('.tabledit-input_'+id).show();
                           
                           $("#status_"+id+" > option"). each(function() { 
                                if(this. value == result.data.status)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                        break;

                        case 'leave':
                           
                            $('#leave_id').val(result.data.id);
                            $('#title').val(result.data.title);
                            $('#reason').val(result.data.reason);
                            $('#start_date').val(result.data.start_date);
                            $('#end_date').val(result.data.end_date);
                            $('#leave_type').val(result.data.leavetype);
                            $('#table_tr_'+id).find('.tablereply-span_'+id).hide();
                            $('#table_tr_'+id).find('.tablereply-input_'+id).show();
                           
                          
                            $("#department_id > option"). each(function() { 

                                if(this. value == result.data.dept_id)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                            $("#status > option"). each(function() { 
                                if(this. value == result.data.status)
                                {
                                  $(this).attr("selected","selected");
                                } 
                              });
                              $('#modal-1').addClass('md-show');
                        break;
                        
                        case 'notification':

                                $('#table_tr_'+id).find('.tabledit-span_'+id).hide();
                                $('#table_tr_'+id).find('.tabledit-input_'+id).show();
                                $("#title"+id+" > option"). each(function() { 
                                    if(this. value == result.data.title)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
    
                               $("#message"+id+" > option"). each(function() { 
                                    if(this. value == result.data.message)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                        break;
                        case 'system_information':
                                 $('#system_id').val(result.data.id);
                                 $("#platform > option"). each(function() { 
                                    if(this. value == result.data.platform)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $("#device > option"). each(function() { 
                                    if(this. value == result.data.device)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $('input[name=price]').val(result.data.price);
                                 $('input[name=system_name]').val(result.data.system_name);
                                 $('input[name=system_model]').val(result.data.system_model);
                                 $("#ram > option"). each(function() { 
                                    if(this. value == result.data.ram)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $('input[name=purchase_date]').val(result.data.purchase_date);
                                 $('input[name=purchase_from]').val(result.data.purchase_from);
                                 $('input[name=dealer_name]').val(result.data.dealer_name);
                                 $('input[name=os_version]').val(result.data.os_version);
                                 $("#storage > option"). each(function() { 
                                    if(this. value == result.data.storage)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $("#employee_name > option"). each(function() { 
                                    if(this. value == result.data.emp_id)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                  
                                  $('#modal-1').addClass('md-show');
                        break;
                           
                        case 'laptop':
                                 $('#laptop_id').val(result.data.id);
        
                                 $("#platform > option"). each(function() { 
                                    if(this. value == result.data.platform)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $("#device > option"). each(function() { 
                                    if(this. value == result.data.device)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                              });
                                     $('input[name=price]').val(result.data.price);
                                    $('input[name=system_name]').val(result.data.system_name);
                                     $('input[name=system_model]').val(result.data.system_model);
                                     $("#ram > option"). each(function() { 
                                        if(this. value == result.data.ram)
                                        {
                                          $(this).attr("selected","selected");
                                        } 
                                      });
                                     $('input[name=purchase_date]').val(result.data.purchase_date);
                                     $('input[name=purchase_from]').val(result.data.purchase_from);
                                     $("#storage > option"). each(function() { 
                                        if(this. value == result.data.storage)
                                        {
                                          $(this).attr("selected","selected");
                                        } 
                                      });
                          
                                      $("#gen > option"). each(function() { 
                                        if(this. value == result.data.gen)
                                        {
                                          $(this).attr("selected","selected");
                                        } 
                                      });
                                     $('input[name=dealer_name]').val(result.data.dealer_name);
                                     $('input[name=os_version]').val(result.data.os_version);
                                     
                                     $("#employee_name > option").each(function() {
                                     console.log(result.data.emp_id); 
                                        if(this. value == result.data.emp_id)
                                        {
                                          $(this).attr("selected","selected");
                                        } 
                                      });
                                       $('#old_invoice').val(result.data.invoice);
                                     $('#modal-1').addClass('md-show');
                        break;             

                        case 'mobile':
                         // alert(11);
                                 $('#mobile_id').val(result.data.id);
        
                                 $("#platform > option"). each(function() { 
                                    if(this. value == result.data.platform)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $('input[name=system_model]').val(result.data.system_model);
                                 $("#storage > option"). each(function() { 
                                    if(this. value == result.data.storage)
                                    {
                                      $(this).attr("selected","selected");
                                    } 
                                  });
                                 $('input[name=os_version]').val(result.data.os_version);
                                 $('input[name=price]').val(result.data.price);
                                  $('#old_invoice').val(result.data.invoice);
                                 $('#modal-4').addClass('md-show');
                                 
                        break;
                        
                        case 'other_expense':
                             $('#expense_id').val(result.data.id);
                             $('input[name=amount]').val(result.data.amount);
                             $('#expense_description').val(result.data.description);
                             $('input[name=date]').val(result.data.date);
                             $("#payment_type > option"). each(function() { 
                            if(this. value == result.data.payment_type)
                            {
                              $(this).attr("selected","selected");
                            } 
                          });
                           $("#paid_by").val(result.data.paid_by);
                           $('#old_invoice').val(result.data.invoice);
                          $('#modal-1').addClass('md-show');
                          console.log(result.data);

                        break; 
                    


                    }
                 }
                }
                });
            });
              $(document).on('click','.display_data',function(e) { 
              e.preventDefault();
        local_id = localStorage.getItem('id');
            var id = $(this).attr('data-id'); 
              localStorage.setItem('id',id);
              
                 $.ajax({
                type: "post",
                url: "{{URL::to('admin/leave_details')}}",
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "table":"leave"
                    },
                    dataType: "json",
                success: function (result) { 
                 //var result =  JSON.parse(data); 
                 if(result.status == 'true'){
                
                   /* switch(table){
                        case 'leave':*/
                        $('#employee_name_span').html(result.data.first_name);
                         $('#title_span').html(result.data.title);
                         $('#reason_span').html(result.data.reason);
                         $('#start_date_span').html(result.data.start_date);
                         $('#end_date_span').html(result.data.end_date);
                         if(result.data.leavetype == 11)
                             $('#leave_type_span').html(result.data.leave_days_others);
                        else
                            $('#leave_type_span').html(result.data.leavetype);
                         $('#status_span').html($('#change_status'+id).html());
                         $('#modal-3').addClass('md-show');
                       /* break;
                    }*/
                 }
                }
                });
            });
    
    $(document).on('click','.save_tr',function(e) {
    e.preventDefault();
    
    id = $(this).attr('data-id');
    status = $('#status_'+id).val();
    var params = addCSRFRequest();
    params+="&id="+id+"&status="+status;
    console.log(table);
    switch(table){
        case 'department':
            params+="&department_name="+$('#department_name_'+id).val();
            
        break;

        case 'designation':
            department_id = $('#department_id_'+id).val();
            designation_name = $('#designation_name_'+id).val();
            params+="&department_id="+department_id+"&designation_name="+designation_name;
           
        break;

        case 'holiday':
            holiday_name = $('#holiday_name_'+id).val();
            holiday_description = $('#holiday_description_'+id).val();
            start_date = $('#start_date'+id).val();
            end_date = $('#end_date'+id).val();
            params+="&holiday_name="+holiday_name+"&holiday_description="+holiday_description+"&start_date="+start_date+"&end_date="+end_date;
        break;
        
          case 'notification':
            title = $('#title_'+id).val();
            message = $('#message_'+id).val();
           
            params+="&title="+title+"&message="+message;
        break;

    }
   
        $.ajax({
            type: "POST",
            url: URL,
            data:params,
            success: function (data) { 
                 //var result =  JSON.parse(data); 
                 if(data.status == 'true'){
                    switch(table){
                        case 'department':
                           console.log(id);
                            $('.department_'+id).text($('#department_name_'+id).val());
                            var status = $('#status_'+id).find('option:selected').text();
                           
                            if($('#status_'+id).val() == 1){
                               var  status_html = '<a class="change_status"  data-id="'+id+'"data-type="1"><span class="label label-success">Active</span></a>';  
                             }else{
                                  var  status_html = '<a class="change_status"  data-id="'+id+'" data-type="0"><span class="label label-warning">Deactive</span></a>';     
                            }
                            $('.status_'+id).html(status_html);
                            $('#table_tr_'+id).find('.tabledit-span_'+id).show();
                            $('#table_tr_'+id).find('.tabledit-input_'+id).hide();
                         
                            alertMessage('success',data.message);
                        break;

                        case 'designation':
                            $('.department_'+id).text($('#department_id_'+id).find('option:selected').text());
                            $('.designation_'+id).text($('#designation_name_'+id).val());
                            var status = $('#status_'+id).find('option:selected').text();
                            console.log(status);
                            if($('#status_'+id).val() == 1){
                               var  status_html = '<a class="change_status"  data-id="'+id+'"data-type="1"><span class="label label-success">Active</span></a>';  
                             }else{
                                  var  status_html = '<a class="change_status"  data-id="'+id+'" data-type="0"><span class="label label-warning">Deactive</span></a>';     
                            }
                            $('.status_'+id).html(status_html);
                             $('#table_tr_'+id).find('.tabledit-span_'+id).show();
                         $('#table_tr_'+id).find('.tabledit-input_'+id).hide();
                            alertMessage('success',data.message);
                        break;



                         case 'holiday':
                            $('.holiday_name_'+id).text($('#holiday_name_'+id).val());
                            $('.holiday_description_'+id).text($('#holiday_description_'+id).val());
                             $('.start_date_'+id).text($('#start_date'+id).val());
                             $('.end_date_'+id).text($('#end_date'+id).val());
                            var status = $('#status_'+id).find('option:selected').text();
                            console.log(status);
                            if($('#status_'+id).val() == 1){
                               var  status_html = '<a class="change_status"  data-id="'+id+'"data-type="1"><span class="label label-success">Active</span></a>';  
                             }else{
                                  var  status_html = '<a class="change_status"  data-id="'+id+'" data-type="0"><span class="label label-warning">Deactive</span></a>';     
                            }

                            $('.status_'+id).html(status_html);
                             $('#table_tr_'+id).find('.tabledit-span_'+id).show();
                         $('#table_tr_'+id).find('.tabledit-input_'+id).hide();
                            alertMessage('success',data.message);
                        break;
                        
                         case 'notification':

                            $('.title_'+id).text($('#title_'+id).val());
                            $('.message_'+id).text($('#message_'+id).val());

                             $('#table_tr_'+id).find('.tabledit-span_'+id).show();
                             $('#table_tr_'+id).find('.tabledit-input_'+id).hide();
                            alertMessage('success',data.message);
                        break;

                }
             }
            }
        })
    });

</script>
<!-- Kirti -->
@php 

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url = explode('/', $url);
@endphp
@if(in_array('checkin',$url))
<script>
    function displayBreakHrs(){
        var get = $('#breakDr').val();
        var bTime = new Date(get).getTime();
        var currTime = new Date().getTime();
        
        var c =  currTime - bTime;
    
        var p = "00:00:00";
        if($('#breakPre').val() != "") {
            p = $('#breakPre').val();
        }
    
        var r = p.split(':');
    
        var h = Math.floor((c % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))+parseInt(r[0]);
        var m = Math.floor((c % (1000 * 60 * 60)) / (1000 * 60))+parseInt(r[1]);
        var s = Math.floor((c % (1000 * 60)) / 1000)+parseInt(r[2]);
    
        $("#breakTime").html(pad(h) + ":" + pad(m) + ":" + pad(s));
    }
    
    $(document).ready(function(){
        var actSal = $('#act').val();
        if(actSal !== "" && actSal !== undefined) {
            $('.tab-pane').removeClass('active');
            $('.tab').removeClass('active');
    
            $('.salaryInfo').addClass('active');
        }
    
        if($('#breakDr').val() != ""){
         breakInterval = setInterval(function () { 
            displayBreakHrs();
         }, 500);
        }
    })
</script>
@endif
<script type="text/javascript">

let breakInterval;

function pad(number) {
  return ("0" + number).slice(-2);
}
function searchEmployee()
{
    var id = $('#department_id').find('option:selected').val();
    var search_status = $('#search_status').find('option:selected').val();
    var text = $('#emp_name').val();
    $.ajax({
        type : 'GET',
        url : "{{URL::to('admin/search')}}",
        data : {department_id : id,search_status:search_status,text:text},
    
        success:function(data1)
        {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://bluepixeltech.com/pmt/public/dist/bower_components/switchery/js/switchery.min.js';
            script.onload = () => {
            };

            const scr = document.createElement('script');
            scr.type = 'text/javascript';
            scr.src = 'https://bluepixeltech.com/pmt/public/dist/assets/pages/advance-elements/swithces.js';
            scr.onload = () => {
              $('.div1').html(data1);
            };

            document.body.appendChild(scr);
        },
    });
}
function getSalarySlipDetail() {
    var id = $(".emp_id").val();

    var date = $('.date').val();

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{URL::to('admin/empSalarySlipInfo')}}",
        data: {_token: '{{ csrf_token() }}', id: id, date: date},
        success: function(res){
            if(res.status) {
                var emp = res.data.employee;
                var basic = res.data.basicInfo;
                if(emp !== null) {
                    $('.salary').val(emp.currentCTC);
                    $('.deduction').val(emp.deduction_amt);
                    $('.month_days').val(res.data.monthDays);
                    $('.pd').val(basic.present_days);
                    $('.wd').val(basic.working_days);
                    $('.curr_leave').val(basic.curr_leave);
                    $('.pre_leave').val(basic.pre_leave);
                }
            }
        }
    });
}
function sendSalaryMail(val){
    $.ajax({
        type: "POST",
        url: "{{URL::to('admin/sendSalarySlip')}}",
        data: {_token:"{{csrf_token()}}",date:val},
        success: function (res) {
          if(res.status){
            console.log('Process Done');
          }else{
            console.log('Something went wrong');
          }
        }         
    });
}
$(document).ready(function() {
    
    /*if($('#breakDr').val() != ""){
     breakInterval = setInterval(function () { 
        displayBreakHrs();
     }, 500);
    }*/
    
    $("#department_id").on("change", searchEmployee);

    $("#search_status").on("change", searchEmployee);
    var timeout;
    $("#emp_name").on("keyup",function(){
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }
        timeout = setTimeout(searchEmployee, 1000)
    });
    
    var salaryInfo = $('#salaryInfo').val();
    if(salaryInfo !== undefined && salaryInfo !== "") {
        $('#salary_info_tab').addClass('active');
        $('#personal_tab').removeClass('active');

        $('#salary_info').addClass('active');
        $('#personal').removeClass('active');
    }
    
    $('.tab').click(function(){
        $('#salary_info').removeClass('active');
    });
    
    $('.generate').click(function(){

        var month = $('#month').val();
        if(month === "") {
            alertMessage('error','Please select month');
            return false;
        }
        
        var ym = month.split('-');
        
        var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];

        var val = months[ym[1]-1]+ ' '+ym[0];

        swal({
            title: "Are you sure you want to generate salary?",
            text: "You have selected "+val+".",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
        },function(isConfirm) {
            if (isConfirm) {
                 $.ajax({
                    type: "POST",
                    url: "{{URL::to('admin/generateSalarySlip')}}",
                    data: {_token:"{{csrf_token()}}",month : month},
                    success: function (res) {
                      if(res.status){
                        alertMessage('success',res.message);
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                      }else{
                        alertMessage('error',res.message);
                        setTimeout(function(){
                            window.location.reload();
                        },3000);
                      }
                    }         
                 });
            }
        });
    })

    $('.submitSalary').click(function(){
        swal({
            title: "Are you sure you want to submit salary?",
            text: "If Yes, then you cannot change",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
        },function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                type: "POST",
                url: "{{URL::to('admin/submitSalarySlip')}}",
                data: {_token:"{{csrf_token()}}"},
                success: function (res) {
                  if(res.status){
                    alertMessage('success',res.message);
                    setTimeout(function(){
                        window.location.href = baseUrl+"/admin/salary_list";
                    },2000);
                  }else{
                    alertMessage('error',res.message);
                    window.location.reload();
                  }
                }         
                });
            }
        });  
    });
    
    $('.date').change(function(){
        
        var self = $(this);
        $.ajax({
        type: "get",
        url: "{{URL::to('empforsalaryslip')}}",
        data: {date:self.val()},
        success: function (res) {
          if(res.status){
            $('.emp_id').html('<option value="">Select Employee</option>');
            $.each(res.data,function(k,v){
             $('.emp_id').append('<option value="'+v.id+'">'+v.full_name+'</option>');
            });
          }else{
            alertMessage('error',res.message);
          }
        }         
        });
    });
    
    var baseUrl = $('#base_url').attr('data-href');
    $('.year').change(function(){
        if($(this).val() != "") {
            $.ajax({
            type: "POST",
            url: "{{URL::to('admin/salaryByYear')}}",
            data: {_token:'{{csrf_token()}}',id:$(this).attr('data-id'),year:$(this).val()},
            success: function (res) {
              if(res.status){
                alertMessage('success',res.message);
                $('#showSalSlip').html('');
                const m = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
                $.each(res.data,function(k,v){
                    var d = new Date(v.date);
                    
                    var borderColor = "success";
                    var amt = parseInt(v.total_amount) + v.professional_tax;
                    if(amt == v.currentCTC && v.cl > 0) {
                        borderColor = "info";
                    }if(amt != v.currentCTC && v.cl > 0) {
                        borderColor = "warning";
                    }
                    
                    $('#showSalSlip').append('<div class="col-sm-6">'+
                      '<div class="card card-border-'+borderColor+'">'+
                         '<div class="card-header">'+
                            '<h5>'+m[d.getMonth()]+'</h5>'+

                            '<div class="dropdown-secondary dropdown f-right">'+
                               '<button class="btn btn-primary btn-mini waves-effect waves-light" type="button"  aria-haspopup="true" aria-expanded="false">Paid</button>'+
                               '<span class="f-left m-r-5 text-inverse">Status : </span>'+
                            '</div>'+
                         '</div>'+
                         '<div class="card-block">'+
                            '<div class="row">'+
                                '<div class="col-sm-6">'+
                                  '<ul class="list list-unstyled">'+
                                     '<li><b>No. #:</b> &nbsp;00'+v.id+'</li>'+
                                     '<li><b>Created on:</b> <span class="text-semibold">'+v.fdate+'</span></li>'+
                                  '</ul>'+
                               '</div>'+
                               '<div class="col-sm-6">'+
                                  '<ul class="list list-unstyled text-right">'+
                                     '<li><b>Amount:</b> <span class="text-semibold">'+v.total_amount+'</span></li>'+
                                     '<li><b>Professional Tax:</b> <span class="text-semibold">'+v.professional_tax+'</span></li>'+
                                  '</ul>'+
                              '</div>'+
                            '</div>'+
                         '</div>'+
                         '<div class="card-footer">'+
                            '<div class="task-list-table">'+
                               '<p class="task-due"><strong>Leave Taken: </strong><strong class="label label-primary">'+v.cl+'</strong></p>'+
                            '</div>'+
                            '<div class="task-board m-0">'+
                               '<a href="'+baseUrl+'/admin/salary/'+v.id+'" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i> View</a> '+
                               '<div class="dropdown-secondary dropdown">'+
                                  '<a href="'+baseUrl+'/downloadSalarySlip/'+v.id+'" class="btn btn-info btn-mini waves-light b-none txt-muted" type="button" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-download-alt"></i>Download</a>'+
                               '</div>'+
                            '</div>'+
                         '</div>'+
                      '</div>'+
                   '</div>');
                });
              }
              else{
                    alertMessage('error',res.message);
                } 
            }         
        });
        }
    });
    $(document).on("submit", ".emp-form", function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token',"{{csrf_token()}}");
        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/store_employee')}}",
            cache : false,
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
              if(res.status){
                alertMessage('success',res.message);
                setTimeout(function(){
                    window.location.href = baseUrl+"/admin/employees_list";
                }, 3000);
              }
              else{
                    alertMessage('error',res.message);
                } 
            }         
        });
    });

    $(document).on("submit", ".emp-edit-form", function(e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token',"{{csrf_token()}}");
            $.ajax({
                type: "POST",
                url: "{{URL::to('admin/update_employee')}}",
                cache : false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res) {
                  if(res.status){
                    alertMessage('success',res.message);
                    setTimeout(function(){
                        window.location.href = baseUrl+"/admin/employees_list";
                    }, 3000);
                  }
                  else{
                        alertMessage('error',res.message);
                    } 
                }         
            });
        });

    $(".docs").select2({
        placeholder: "Select Documents To upload"
    });
    
    $(".emp_id").on("change", getSalarySlipDetail);

    $(".date").on("change", getSalarySlipDetail);

    $('#dept').change(function(){
        var self = $(this);
        $.ajax({
        type: "get",
        url: "{{URL::to('getdesignationbyDept')}}",
        data: {id:self.val()},
        success: function (res) {
          if(res.status){
            $('#designation').html('<option value="">Select Designation</option>');
            $.each(res.data,function(k,v){
             $('#designation').append('<option value="'+v.id+'">'+v.designation_name+'</option>')
            })
          } 
        }         
        });
    });
    
    $('.filtersalary').click(function(){
        var val = $('.month').val();

        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/getSalarybyMonth')}}",
            data: {_token:"{{csrf_token()}}",date:val},
            success: function (res) {
              if(res.status){
                $('#data').html('');
                $('.sendmail').removeClass('disabled');
                $('#net-total').text(res.total);
                $.each(res.data,function(k,v){
                    var r = Math.floor(Math.random() * 4) + 0;
            
                    var arr = ['primary','success','info','warning','danger'];
                    var color = arr[r];
                    
                    var array = ['lite-green','green','lite-green','yellow','pink'];
                    var color2 = array[r];

                    var path = '<?php echo env('APP_URL'); ?>';

                 $('#data').append('<div class="col-md-v col-lg-l"><div class="card"><div class="card-block user-radial-card"><div data-label="50%" class="radial-bar radial-bar-100 radial-bar-lg radial-bar-'+color+'"><img src="'+path+'/uploads/users/'+v.image+'" alt="User-Image"></div><br><a href="'+path+'/admin/employee_details/'+v.emp_id+'" target="_blank"><span class="f-36 text-c-'+color2+'" style="font-size: 20px;">'+v.full_name+'</span></a><p class="m-b-0 f-20">Rs.'+v.total_amount+'</p><div></div></div></div></div>');
                });
                alertMessage('success',res.message);
              }else{
                alertMessage('error',res.message);
              }
            }         
        });
    });
    
    $('.sendmail').click(function(){
        var val = $('.month').val();
        
        sendSalaryMail(val);
        $('.sendmail').addClass('disabled');
        setTimeout(function(){
           alertMessage('success','Mail sent successfully');
        }, 6000);
    })

    /*$('.checkin').click(function(){
        var self = $(this);

        $.ajax({
            type: "post",
            url: "{{URL::to('saveCheckin')}}",
            data: {_token:'{{csrf_token()}}',type:self.attr('data-type')},
            success: function (res) {
              if(res.status){
                var data = res.data;
                alertMessage('success',res.message);

                $('#in').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                $('#out').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
                $('#checkinRow').html('<tr><td>1</td><td>'+data.time_in+'</td><td>-</td><td>'+data.date+'</td><td>'+res.duration+'</td></tr>');
                $('.dCheckin').text(data.time_in);
                window.location.reload();
              } else {
                alertMessage('error',res.message);
              }
            }         
        });
        
    });*/
   
    $('#out').click(function(){
        var self = $(this);
        checkin = $("#checkin_c").text();
        date  = $("#date_c").val();
        console.log(date +' '+ checkin);

        var date1 = new Date(date +' '+ checkin);
        var date2 = new Date();
       
        
        var diff = date2.getTime() - date1.getTime();

        var msec = diff;
        var hh = Math.floor(msec / 1000 / 60 / 60);
        msec -= hh * 1000 * 60 * 60;
        var mm = Math.floor(msec / 1000 / 60);
        msec -= mm * 1000 * 60;
        var ss = Math.floor(msec / 1000);
        msec -= ss * 1000;

        //time = hh + ":" + mm + ":" + ss;
        time = hh + ":" + mm;
        if($('.rTime').text() != '00:00:00'){
            swal({
                title: "Are you sure you want to checkout?",
                text: "You have completed "+time+" hours.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false,

            },function(isConfirm) {
                if (isConfirm) {
                    sendData();
                }
            });
        } else {
            sendData();
        }
    });

    $('.break').click(function(){
        var self = $(this);

        $.ajax({
            type: "post",
            url: "{{URL::to('saveBreakin')}}",
            data: {_token:'{{csrf_token()}}',type:self.attr('data-type')},
            success: function (res) {
              if(res.status){
                if(res.type == "in") {
                    var data = res.data;
                    alertMessage('success',res.message);
                    $('#bin').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                    $('#bout').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
                    $('#breakRow').append('<tr><td></td><td>'+data.time_in+'</td><td>-</td><td>'+data.date+'</td><td>00:00:00</td></tr>');
                    $('#breakDr').val(res.dr);
                    breakInterval = setInterval(function () { 
                        displayBreakHrs();
                    }, 500);
                } else {

                    alertMessage('success',res.message);
                    $('#break tr:last').children('td.timeOut').text(res.time_out);
                    $('#bin').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
                    $('#bout').addClass('disabled').addClass('btn-primary').removeClass('btn-primary').prop('disabled', true);
                    clearInterval(breakInterval);
                }
              } else {
                alertMessage('error',res.message);
              }
            }         
        });
    });

    $('.term').click(function(){
        var self =  $(this);
        if(self.attr('data-type') == "1") {
            $('#term1').removeClass('nodisplay').addClass('display');
            $('#term2').removeClass('display').addClass('nodisplay');
        } else if (self.attr('data-type') == "2") {
            $('#term2').removeClass('nodisplay').addClass('display');
            $('#term1').removeClass('display').addClass('nodisplay');
        }
    });
    
    $('.empType').click(function(){
        var self =  $(this);
        if(self.val() == "user") {
            $('#traineeDur').removeClass('display').addClass('nodisplay');
        } else if (self.val() == "trainee") {
            $('#traineeDur').removeClass('nodisplay').addClass('display');
        }
    });

    var checkRadio = $('input[name="term"]:checked').val();
        
    if(checkRadio !== "") {
        
        if(checkRadio == 1) {
            $('#term1').removeClass('nodisplay').addClass('display');
            $('#term2').removeClass('display').addClass('nodisplay');
        } else if(checkRadio == 2) {
            $('#term2').removeClass('nodisplay').addClass('display');
            $('#term1').removeClass('display').addClass('nodisplay');
        }
    }

        var val = $('#in').attr('data-val');
        if(val == 1) {
            $('#in').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
            $('#out').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
        } else if (val == 2) {
            $('#in').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
            $('#out').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
        } else {
            $('#in').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
            $('#out').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
        }

        var bVal = $('#bin').attr('data-val');
        if(bVal == 1) {
            $('#bin').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
            $('#bout').removeClass('disabled').addClass('btn-primary').prop('disabled', false);
        } else if(bVal == 2) {
            $('#bin').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
            $('#bout').addClass('disabled').addClass('btn-primary').removeClass('btn-primary').prop('disabled', true);
        } else {
            $('#bin').removeClass('disabled').prop('disabled', false);
            $('#bout').addClass('disabled').addClass('btn-primary').removeClass('btn-primary').prop('disabled', true);
        }

        /* Display Greetings as per Time */
        var now = new Date();
        var hrs = now.getHours();
        var msg = "";

        if (hrs >=  4) msg = "Good Morning!";      // After 6am
        if (hrs >= 12) msg = "Good Afternoon!";    // After 12pm
        if (hrs >= 17) msg = "Good Evening!";      // After 5pm
        if (hrs >= 22) msg = "Good Night!";        // After 10pm

        $('#greeting').text(msg);
    })
    
    function sendData() {
        $.ajax({
            type: "post",
            url: "{{URL::to('saveCheckin')}}",
            data: {_token:'{{csrf_token()}}',type:"out"},
            success: function (res) {
              if(res.status){
                alertMessage('success',res.message);
                $('.checkOutTime').text(res.time_out);
                $('.dCheckout').text(res.time_out);
                $('#out').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                $('#bin').addClass('disabled').removeClass('btn-primary').prop('disabled', true);
                $('#bout').addClass('disabled').addClass('btn-primary').removeClass('btn-primary').prop('disabled', true);
                 clearInterval(interval_id);
              } else {
                alertMessage('error',res.message);
              }
            }         
        });
    }
    function dateFormat(inputDate, format) {
        //parse the input date
        const date = new Date(inputDate);
    
        //extract the parts of the date
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();    
    
        //replace the month
        format = format.replace("MM", month.toString().padStart(2,"0"));        
    
        //replace the year
        if (format.indexOf("yyyy") > -1) {
            format = format.replace("yyyy", year.toString());
        } else if (format.indexOf("yy") > -1) {
            format = format.replace("yy", year.toString().substr(2,2));
        }
    
        //replace the day
        format = format.replace("dd", day.toString().padStart(2,"0"));
    
        return format;
    }
</script>
    <!-- Kirti Scripts End-->
    <!-- Priyanka START -->
<script>
    $(document).on('click','.reply-btn',function(e) {
    e.preventDefault();
   
        id = $(this).attr('data-id');
        $('#id').val(id);    
        $('#modal-2').addClass('md-show');
    });
     $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-1').removeClass('md-show');
    });
     $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-2').removeClass('md-show');
    });
    $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-3').removeClass('md-show');
    });
    $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-4').removeClass('md-show');
    });
    $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-8').removeClass('md-show');
    });
    $(document).on('click','.btn-close',function(e) {
        e.preventDefault();
      
        $('#modal-9').removeClass('md-show');
    });
    $(document).ready(function() {
       @if(in_array('salary_details',$url))
      
        $("#lock-screen").modal('show');
        $('#first').focus()
        $('#salary_info').addClass('blur-bg');
        $('#official').addClass('blur-bg');
        @endif
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var output = d.getFullYear() + '/' +
            ((''+month).length<2 ? '0' : '') + month + '/' +
            ((''+day).length<2 ? '0' : '') + day;

        var date=(output);
        console.log(date);

        var getdate = new Date(date);

        getdate.setDate(getdate.getDate() - 6);
        
        $('#start_date').attr('min', getdate.toISOString().substr(0, 10));

     $(document).on('change','#start_date',function(e){
        var date=($('#start_date').val());
        console.log(date);
        var getdate = new Date(date);

        getdate.setDate(getdate.getDate() + 1);

        $('#end_date').attr('min', getdate.toISOString().substr(0, 10));

     })

     $(document).on('change','#start_date1',function(e){
        var date=($('#start_date1').val());
        console.log(date);
        var getdate = new Date(date);

        getdate.setDate(getdate.getDate() + 1);

        $('#end_date').attr('min', getdate.toISOString().substr(0, 10));

     })
     
      $(document).on('click','.select-month',function(e) {
    e.preventDefault();
    
    id = $(this).attr('data-id');
    year = $('select[name=select_year]').val();
    emp_id = $('#emp_id').val();
    var self = $(this);
    $.ajax({
                    type: "post",
                    url: "{{URL::to('getAttendanceByMonth')}}",
                    data: {_token:'{{csrf_token()}}',month:id,year:year,emp_id:emp_id},
                    success: function (res) {
                      if(res.status){
                        $(this).addClass("dd");
                        alertMessage('success',res.message);
                        
                        $('#monthly-data').html(res.html);
                         $('#present_days').html(res.data_html.present_days);
                        $('#leave_taken').html(res.data_html.taken_leave);
                        $('#late_entries').html(res.data_html.late_entry);
                        $("li a.active-month").removeClass("active-month"); 
                        self.addClass('active-month');
                      } else {
                        alertMessage('error',res.message);
                      }
                    }         
                });

});   
    $(function(){
       $(".candidate").select2({
        placeholder: "Select"
       });
    })
 })
</script>
<script type="text/javascript">
    $('#leave_type').on('change', function (e) { 
    if ($('#leave_type').val() == '11') {
        $("#leave_days_others").show();
    }else{
        $("#leave_days_others").hide();     
    }
    
    if($(this).val() == '1.0' || $(this).val() == '0.5') {
        $('.ed').hide();
    } else {
        $('.ed').show();
    }
});
   
</script>
<!-- Cancel Button in Leave -->
<script type="text/javascript">
function addtocart(id){
    alert(id);
}

  $('#removeleave').on('click',function(){
  var id = $(this).attr('data-id');
       
            swal({
                title: "Are you sure you want to cancel Leave?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('employee/cancelleave')}}",
                        data: {_token:'{{csrf_token()}}',id:id,type:3},
                        success: function (data) {
                                   console.log(data); 
                                   if(data.status == 'true'){
                        alertMessage('success',data.message);
                             setTimeout(function(){
                                           window.location.reload();
                                        }, 3000);
                      }else{
                        alertMessage('error',data.message);
                      }
                            }         
                    });
                }
    });
});
    
</script>
 <!-- Priyanka END-->
 <!-- Change Password -->

 <script type="text/javascript">
   $(document).on('click', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#pass_log_id");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
   
 $(document).on('change','#oldpassword',function(e) {
    var password = $("#oldpassword").val();
     if(password == ""){
            $('#old_password_message ').html('Enter New Password').show();
        }else{
            $('#old_password_message ').hide();
        }
 });
 $(document).on('change','#pass_log_id',function(e) {
    var password = $("#pass_log_id").val();
     if(password == ""){
            $('#password_msg').html('Enter New Password').show();
        }else{
            $('#password_msg').hide();
        }
 });
  $(document).on('change','#confirmpassword',function(e) {
    var cpassword = $("#confirmpassword").val();
     if(cpassword == ""){
            $('#cpassword_msg').html('Enter Confirm Password').show();
        }else{
            $('#cpassword_msg').hide();
        }
 });
 </script>
 <script type="text/javascript">
     $(document).on('click','#submitButton',function(e) {
    e.preventDefault();
    var oldpassword = $("#oldpassword").val(); 
    var password = $("#pass_log_id").val();
    var cpassword = $("#confirmpassword").val();
    
        if(password == "" || cpassword == "" || oldpassword  == ""){
            $('#old_password_message').html('Enter old password').show();
            $('#password_msg').html('Enter new password').show();
            $('#cpassword_msg').html('Enter confirm password').show();
        }
        else
        if(password == ""){
             $('#password_msg').html('Enter new password').show();
        }else
        if(oldpassword == ""){
             $('#old_password_message').html('Enter old password').show();
        }else
        if(cpassword == ""){
             $('#cpassword_msg').html('Enter confirm password').show();
        }else{
            $('#password_msg').hide();
            $('#cpassword_msg').hide();
       if(password != cpassword )
       {
            $("#cpassword_msg").show().html("Confirm password does not match");
             return false;
       }
            $("#cpassword_msg").hide();
       
        params =$('#changepassword').serialize();
        params += '&'+addCSRFRequest();
        console.log(params);
        $.ajax({
            type: "post",
            url: "{{URL::to('common/change_password')}}",
            data: params,
            success: function (data) {
                console.log(data.status);
                if(data.status == 'true'){
                    setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                     alertMessage('success',data.message);
                }
                // else if(data.status == 'false')
                // {
                //      $('.confirm_password_message').html(data.message);
                // }
                else{
                    console.log(data.message);
                    $('#old_password_message').html(data.message).show();
                }
            }
      });
          }
    });
       
 </script>
  <!-- Change Password End-->


<!-- Reset Employee-->
<script type="text/javascript">
    $(document).ready(function () {
    $('#clear').on('click',function(){
        window.location.reload();
        /*$("#department_id option:selected").prop("selected", false)
        $("#search_status option:selected").prop("selected", false)

        var id = "";
        var search_status = "";
        $.ajax({
            type : 'GET',
            url : "{{URL::to('admin/search')}}",
            data : {department_id : id,search_status:search_status}, //variablename : data variable =>$request->c pass in to the controller
       
        success:function(data1)
        {
            $('.div1').html(data1);
          },
    });*/
});
});
</script>
<script type="text/javascript">
$('#department').change(function(){
        var self = $(this);
        $.ajax({
        type: "get",
        url: "{{URL::to('getdesignationbyDepartment')}}",
        data: {id:self.val()},
        success: function (res) {
          if(res.status){
            $('#designation').html('<option value="">Select Designation</option>');
            $.each(res.data,function(k,v){
             $('#designation').append('<option value="'+v.id+'">'+v.designation_name+'</option>')
            })
          } 
        }         
        });
    });
</script>

<script>
$(".skill").select2({
        placeholder: "Select Skill"
    });
</script>
<script>
  $(".employee").select2({
 placeholder: "Employee Name"
 });
  $(".employee_id").select2({
 placeholder: "Employee Name"
 });
   </script>

<script type="text/javascript">
    $('#education').on('change', function (e) { 
    if ($('#education').val() == '7') {
        $("#eduction_text").show();
    }else{
        $("#eduction_text").hide();     
    }
});
   
</script>

<script type="text/javascript" src="{{URL::to('dist/assets/js/croppie.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){
    //ChangeTiming();
     setInterval(function () { 
        CurrentTiming();
      }, 1000);
    
     function CurrentTiming(){
        const d = new Date();
        $('#currenttime').html(d.toLocaleTimeString('en-GB'));


     }
    if($('.checkOutTime').text() != "-"){
         $("#displayTime").html($('#duration_c').html());
     }else{
    interval_id =  setInterval(function () { 
        ChangeTiming();
     }, 500);
     }
     
     function addHoursToDate(date, hours) {
      return new Date(new Date(date).setHours(date.getHours() + hours));
    }
    
    function ChangeTiming(){
    var time1 = $('#current_time').val();
    var time2 = $('#remaining_time').val();

    let myDate = new Date();
    //console.log(myDate);
    if($("#checkin_c").text() == "-"){
        var countDownDate = addHoursToDate(myDate,1).getTime()
        var time2 = $('#remaining_time').val(addHoursToDate(myDate,1));
        $('#current_time').val(myDate);
    }else{
        var countDownDate = new Date(time2).getTime();
    }
    
    var now = new Date().getTime();
    
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    time = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
    // If the count down is over, write some text 
    
    if (distance < 0) {
       
           // var time1 = $('#current_time').val();
            var time2 = $('#current_time').val();

            var countDownDate1 = new Date(time2).getTime();
            var now1 = new Date().getTime();
            
            var distance =  now1 - countDownDate1 ;
            
            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            hours = hours;
            time = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
            $("#displayTime").html(time);
            $('#duration_c').html(time);
            // If the count down is over, write some text 
            console.log(time);
            console.log(distance);
       
    }
     if($("#checkin_c").text() == "-"){
         const d = new Date();
        $('#displayTime').html(d.toLocaleTimeString('en-GB'));

    }else{
     $("#displayTime").html(time);
     //$('#duration_c').html(time);
     
    }


}
     /*function pad(number) {
          return ("0" + number).slice(-2);
        }*/
document.getElementById('buttonid').addEventListener('click', openDialog);

function openDialog() {
  document.getElementById('fileid').click();
}
        var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;
        function readFile(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 150,
                height: 150,
            },
            //enforceBoundary: false,
            enableExif: true
        });
        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log('jQuery bind complete');
            });
        });

        $('.item-img').on('change', function () {
           
         imageId = $(this).data('id'); tempFilename = $(this).val();
            $('#cancelCropBtn').data('id', imageId); readFile(this); 
        });
        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 150, height: 150}
            }).then(function (resp) {
                $('#item-img-output').attr('src', resp);
                // console.log(11);
                 var profile_image = $('#item-img-output').attr('src');
               var old_image = $('#old_image').val();
               id = $('#emp_id').val();
               var params = addCSRFRequest();
               params += '&id='+id;
               params += '&image='+profile_image;

                $.ajax({
                  type: "POST",
                  url: "{{URL::to('common/imageUpload')}}",
                  data: {id:id,'_token':'{{csrf_token()}}',old_image:old_image,image:profile_image},
                  success: function(data) {
                      if(data.status == 'true'){
                           $('#old_image').val(data.data)
                          $('#remove_image').removeClass('d-none');
                        alertMessage('success',data.message);
        
                      }else{
                        alertMessage('error',data.message);

                      }
                      /* setTimeout(function(){
                                           window.location.reload();
                                        }, 3000);*/
                  }
            });
         $('#cropImagePop').modal('hide');
        });
    });      
// <!-- View Image -->

    $('.view-image').on('click',function(){
         image = $('#item-img-output').attr('src');
        $('.view_image').attr('src', image); 
        // $('#Modal-lightbox').show().addClass('show');
                    $('#Modal-lightbox').modal({
                    show: true
                })
  });
  $(document).on('click','.remove-image',function(e) { 
       e.preventDefault();
            swal({
                title: "Are you sure you want to remove image?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false,

            },function(isConfirm) {
                if (isConfirm) {
                     var id = $(this).attr('data-id'); 
            var imgname = $('#old_image').val();
            var type = $(this).attr('data-type'); 
                 $.ajax({
                type: "post",
                url:"{{URL::to('common/removeimage')}}",
                data: { "_token": "{{ csrf_token() }}",
                        "id":id,
                        "image":imgname
                    },

                success: function (data) { 
                if(data.status == 'true'){
                        $('#item-img-output').attr('src', data.data);
                        alertMessage('success',data.message);

                      }else{
                        alertMessage('error',data.message);
                      }
                      $('#remove_image'+id).html();
              }
         });
                }
            });
       
      
           
         });
 });
</script>
<!-- Manuallay checkin -->
<script type="text/javascript">
    $(document).on('click','.checkin-manually',function(e) {
    var date = $(this).attr('data-date');
    var checkin = $(this).attr('data-checkin');
    var checkout = $(this).attr('data-checkout');
    var id = $(this).attr('data-id');
        $('#display-date').html(date);
        $('#checkin').val(checkin);
        $('#checkout').val(checkout);
        $('#at_id').val(id);
        $('#large-Modal').modal({
            show: true
        })
   })
    $(document).on('click','#add_checkin',function(e) {
     var emp_id = $('#emp_id').val();   
     var id = $('#at_id').val();   
        var checkin = $('#checkin').val();  
        var checkout = $('#checkout').val();   
        var date = $('#display-date').html();   
        $.ajax({
            type: "post",
            url: "{{URL::to('addAttendanceManually')}}",
            data: {_token:'{{csrf_token()}}',id:id,emp_id:emp_id,date:date,checkin:checkin,checkout:checkout},
            dataType: "json",
            success: function (data) {
               if(data.status == 'true'){
                $('.attendace-close-btn').trigger('click');
                alertMessage('success',data.message);
                $('#form_checkin')[0].reset();
                setTimeout(function(){
                           window.location.reload();
                        }, 3000);
                } else {
                alertMessage('error',data.message);
              }
            }         
        });
   })
   
   function clickEvent(first,last){
            if(first.value.length){
                document.getElementById(last).focus();
            }
        }

 $(document).ready(function() {
    $('.salaryinfo').on('click',function(){ 
       $("#lock-screen").modal('show');
        $('#first').focus()
        $('#salary_info').addClass('blur-bg');
        $('#official').addClass('blur-bg');
    })
    
   
     //Code Verification
var verificationCode = [];

$(".verification-code input[type=password]").keyup(function (e) {
  
  // Get Input for Hidden Field
  $(".verification-code input[type=password]").each(function (i) {
    verificationCode[i] = $(".verification-code input[type=password]")[i].value; 
    $('#verificationCode').val(Number(verificationCode.join('')));
  });
  var pin =   $('#verificationCode').val();
 if(pin.length == 4){
    //$(".office_lock_btn").click(function(e) {
    e.preventDefault();
       params =$('#office_lock').serialize();
        params += '&'+addCSRFRequest();
        console.log(params);
        $.ajax({
            type: "post",
            url: "{{URL::to('employee/office_lock')}}",
            data: params,
            success: function (data) {
                console.log(data.status);
                if(data.status == 'true'){
                   $('.message').html('<p class="text-danger text-center">'+data.message+'</p>')  
                   $('#office_lock')[0].reset();
                   $('#salary_info').removeClass('blur-bg');
                    $('#official').removeClass('blur-bg');
                   $('#lock-screen').modal('toggle');
                   $('.message').html('');
                }else{
                    $('.message').html('<p class="text-danger text-center">'+data.message+'</p>');
                    $('#office_lock')[0].reset();
                    $('#first').focus();

                }
                
                
            }
      });
   }
  //console.log(event.key, event.which);

  if ($(this).val() != "") {
    if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event.key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
      $(this).next().focus();
    }
  }else {
    if(event.key == 'Backspace'){
        $(this).prev().focus();
    }
  }

});

})
 $(document).ready(function(){
 $(document).on('click','.checkall',function(e){ 
         //$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
         $(".selectall").prop('checked', $(this).prop('checked'));
         $('.singlecheckall').prop('checked', $(this).prop('checked'))
      });
 var items = $('.singlecheck');
      $(document).on('click','.singlecheckall',function(e){
        id = $(this).attr('data-id');

        items.filter(function() {
        return $(this).attr('data-id') === id;
    }).prop('checked', $(this).prop('checked'));
        $('.checkall').prop('checked',false)
        
      })

      var items2 = $('.singlecheckall');
       $(document).on('click','.singlecheck',function(e){
        id = $(this).attr('data-id');
        items2.filter(function() {
        return $(this).attr('data-id') === id;
         }).prop('checked', false);
        $('.checkall').prop('checked',false)
      })
})

   $(document).on('change','.changeProp',function(e) {

    e.preventDefault(); 
            var id = $(this).attr('data-id'); 
            
            var type = $(this).attr('data-type'); 
                 $.ajax({
                type: "post",
                url: "{{URL::to('common/change_status')}}",
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "type":type,
                        "table":'employee'
                    },
                success: function (data) { 
                 var result =  JSON.parse(data); 
                  
                 if(result.status == 'true'){
                  
                $('#change_status'+id).val(result.data.status);
              }


         }
         });
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){

        $('.get_salary').on('click',function(e){

            id = $(this).attr('data-id');   
         $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{URL::to('admin/getsalary')}}",
            data: {_token: '{{ csrf_token() }}', id: id},
            success: function(res){
                if(res.status) {
                    var emp = res.data.employee;
                    var basic = res.data.basicInfo;
                    var html = '';
                     var d = new Date();
                    // var $k = '';
                     if(res.data != ""){
                    $.each(res.data, function( index, value ){
                        sr_no = index + 1;
                        html +="<tr>";
                        html +="<td>"+sr_no+"</td>";
                        html +="<td>"+value.year+"</td>";
                        html +="<td>"+value.amount+"</td>";
                        html +="</tr>";

                         });
                     }
                        $('#salary_details').html(html);
                    $('#large-Modal').modal({
                    show: true
                })
                }  
            }
        });
         }) 

        $('#addsalary').on('click',function(){
            $('.salary-form').show();
           
        })
          $('#closesalary').on('click',function(){
            $('.salary-form').hide('');
            $('#year').val('');
            $('#salary_amount').val(''); 
        })
   });
 $(document).on('change','#year',function(e) {
     var year = $('#year').val();
     if(year == ""){
            $('#year_msg').html('Please Select Year').show();
        }else{
            $('#year_msg').hide();
        }
 });
 $(document).on('change','#salary_amount',function(e) {
     var salary_amount = $('#salary_amount').val();
    if(salary_amount == ""){
             $('#salary_msg').html('Enter Amount').show();
        }else{
            $('#salary_msg').hide();
        }
 });
     $(document).on('click','#emp_salary',function(e) {

    e.preventDefault();
   
        id = $(employee_salary_id).val();
        var year = $('#year').val();
        var salary_amount = $('#salary_amount').val();

       
        if(year == "" && salary_amount == ""){
            $('#year_msg').html('Please Select Year').show();
            $('#salary_msg').html('Enter Amount').show();
        }else
        if(year == ""){
             $('#year_msg').html('Please Select Year').show();
        }else
        if(salary_amount == ""){
             $('#salary_msg').html('Enter Amount').show();
        }else{
            $('#year_msg').hide();
            $('#salary_msg').hide();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{URL::to('admin/employee_salary')}}",
            data: {_token: '{{ csrf_token() }}', id: id, year: year, salary_amount: salary_amount},
             success: function(res){
                if(res.status) {
                    var emp = res.data.employee;
                    var basic = res.data.basicInfo;
                    var html = '';
                        html +="<tr>";
                        $('input[name=currCTC]').val(salary_amount);
                        $('.year').val(year);
                        $('.salary_amount').val(salary_amount);
                        alertMessage('success',res.message);  
                        $('#year').val('');
                        $('#salary_amount').val('');
                   $('.salary-close-btn').trigger('click');
                    }
                }
    });
    }
         });
</script>
<script>
    $(document).on('click','.display_notification',function(e) { 
              e.preventDefault();

        local_id = localStorage.getItem('id');
            var id = $(this).attr('data-id'); 
              localStorage.setItem('id',id);
              
                 $.ajax({
                type: "post",
                url: "{{URL::to('admin/notification_details')}}",
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "table":"notification_list"
                    },
                    dataType: "json",
                success: function (result) { 
                    console.log(result.status);
                 if(result.status == 'true'){
                    console.log(result.data);
                         $('#sender_span').html(result.data.full_name);
                         $('#receiver_span').html(result.data.receiver_name);
                         $('#title_span').html(result.data.title);
                         $('#message_span').html(result.data.message);
                         $('#date_span').html(result.data.date);
                         $('#modal-3').addClass('md-show');
                 }
                }
                });
            });
    
</script>
@if(in_array('dashboard',$url))
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDIJOeRR9xG2R2Xi80k0SWIAjc7u_X2d7I",
        authDomain: "project-management-tool-60f18.firebaseapp.com",
        projectId: "project-management-tool-60f18",
        storageBucket: "project-management-tool-60f18.appspot.co",
        messagingSenderId: "642891304835",
        appId: "1:642891304835:web:35199e28a85f1e8565b0b6"
    };
    
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();
    if('serviceWorker' in navigator) { 
      navigator.serviceWorker.register('/pmt/public/firebase-messaging-sw.js')
        .then(function(registration) {
        console.log("Service Worker Registered");
        messaging.useServiceWorker(registration);  
        
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
            
            $.ajax({
                type: "post",
                url: "{{URL::to('updateFcm')}}",
                data: {_token:'{{csrf_token()}}',token:token},
                success: function (res) {
                 console.log('success');
                }         
            });

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
      }); 
    }
    
    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
</script>
@endif

<script>
   $(document).on('mouseover','.check-address',function(e) {
    e.preventDefault();
    address = $(this).attr('data-address');
    id = $(this).attr('data-id');
    console.log(id);
    $('.display_address').text(address);
});

</script>
<script>

const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );

})));

</script>

<script>

function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();    

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));        

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}
</script>  
<!--Add Client Details-->
<script type="text/javascript">
$(document).ready(function()
{
    $("#test1-body").on('click', '.deletecomm', function() 
    {
        $(this).closest('tr').remove();
    });
});

function delete_row(id)
{
        $('#row'+id).remove();
        alert(id);
}

</script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
$(document).ready(function()
{
     var rowIdx = 0;
     
        $('#add-row').on('click',function(){
            var i = ++rowIdx;
           $('#test-body').append(`<tr id="row${i}">
           <td><textarea class="form-control" name="last_conversion[]"  placeholder="Enter Last Conversion" style="width:385px;"></textarea></td>
           <td class="deleteconv"><span class="delete-row" data-id="${i}" value="Delete" style="margin-top:7px;"/><i class="fa fa-close"></i></span></td></tr>`);
            });   
            });
</script>

<script type="text/javascript">
$(document).ready(function()
{
     var rowIdx = 0;
     
        $('#add-row1').on('click',function(){
           $('#test1-body').append(`<tr id="row${++rowIdx}">
             <td>
            <textarea class="form-control" name="comments_from_clients[]"  placeholder="Enter Comments" style="width:385px;" maxlength="300"></textarea>
            </td>
             <td class="deletecomm">
                <span id="delete"  class='delete-row  deleterow delete1' data-id="${++rowIdx}"  value='Delete' style="margin-top:7px;"/><i class="fa fa-close"></i></span>
            </td>
              </tr>`
              );
      });   
            });
</script>

<script type="text/javascript">
    $('#test-body').on('click', '.deleteconv', function() 
    { 
        $(this).closest('tr').remove();
    });
</script>
<script>
    $(document).ready(function(){
        @if(in_array('dashboard',$url))
        anim = 'fadeInUp';
        testAnim(anim);
       function testAnim(x) {
        console.log(x);
        $('.animationSandbox').addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            });
    };
       @endif  
    /*Client details*/
    $('#edit-info').hide();
    $('#edit-save').hide();

      $('#edit-cancel').on('click', function() {
          var c = $('#edit-btn').find("i");
          c.removeClass('icofont-close');
          c.addClass('icofont-edit');
          $('#view-info').show();
          $('#edit-info').hide();
          $('#edit-save').hide();
      });

       $(document).on("submit", "#basic_info", function(e){ 
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token',"{{csrf_token()}}");
      
            $.ajax({
          type: "POST",
          url: "{{URL::to('admin/update_client')}}",
          data: formData, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
              if(data.status == 'true'){
               // $('#edit-info')[0].reset();
                 setTimeout(function(){
                   $('.md-close').trigger('click');
                   }, 3000);
                alertMessage('success',data.message);
               
                    var c = $('#edit-btn').find("i");
                  c.removeClass('icofont-close');
                  c.addClass('icofont-edit');
                  $('#view-info').show();
                  $('#edit-info').hide();
                  $('#edit-save').hide();
                
              }else{
                 setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                alertMessage('error',data.message);

              }
               setTimeout(function(){
                                   window.location.reload();
                                }, 4000);

          }
        });
         
      });
      $(document).on("submit", "#contact_info", function(e){ 
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token',"{{csrf_token()}}");
     
            $.ajax({
          type: "POST",
          url: "{{URL::to('admin/update_client')}}",
          data: formData, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
              if(data.status == 'true'){
               // $('#edit-info')[0].reset();
                 setTimeout(function(){
                   $('.md-close').trigger('click');
                   }, 3000);
                alertMessage('success',data.message);
                
                     var b = $('#edit-Contact').find("i");
                     b.removeClass('icofont-close');
                      b.addClass('icofont-edit');
                      $('#contact-info').show();
                      $('#edit-contact-info').hide();
               
              }else{
                 setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                alertMessage('error',data.message);

              }
               setTimeout(function(){
                                   window.location.reload();
                                }, 4000);

          }
        });
         
      });


      $('#edit-btn').on('click', function() {
          var b = $(this).find("i");

          var edit_class = b.attr('class');
          if (edit_class == 'icofont icofont-close') { 
              b.removeClass('icofont-edit');
              b.addClass('icofont-close');
              $('#view-info').hide();
              $('#edit-info').show();
              $('#edit-save').show();
          } else {
              b.removeClass('icofont-close');
              b.addClass('icofont-edit');
              $('#view-info').show();
              $('#edit-info').hide();
              $('#edit-save').hide();
          }
      });

     $('#edit-contact-info').hide();
     $('#contact-save').hide();
      $('#contact-save').on('click', function() {
          var c = $('#edit-Contact').find("i");
          c.removeClass('icofont-close');
          c.addClass('icofont-edit');
          $('#contact-info').show();
          $('#edit-contact-info').hide();
           $('#contact-save').hide();
      });

      $('#contact-cancel').on('click', function() {
          var c = $('#edit-Contact').find("i");
          c.removeClass('icofont-close');
          c.addClass('icofont-edit');
          $('#contact-info').show();
          $('#edit-contact-info').hide();
      });

      $('#edit-Contact').on('click', function() {
          var b = $(this).find("i");
          var edit_class = b.attr('class');

          if (edit_class == 'icofont icofont-edit') {
              b.removeClass('icofont-edit');
              b.addClass('icofont-close');
              $('#contact-info').hide();
              $('#edit-contact-info').show();
              $('#contact-save').show();
          } else {
              b.removeClass('icofont-close');
              b.addClass('icofont-edit');
              $('#contact-info').show();
              $('#edit-contact-info').hide();
               $('#contact-save').hide();
          }
      });
       //client decription
      $('#edit-description-info').hide();
         $(document).on("submit", "#description_info", function(e){ 
    
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('_token',"{{csrf_token()}}");
            $.ajax({
          type: "POST",
          url: "{{URL::to('admin/update_client')}}",
          data: formData, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
            console.log(data);
              if(data.status == 'true'){
               // $('#edit-info')[0].reset();
                 setTimeout(function(){
                   $('.md-close').trigger('click');
                   }, 3000);
                alertMessage('success',data.message);
                
                     var b = $('#edit-description').find("i");
                     b.removeClass('icofont-close');
                      b.addClass('icofont-edit');
                    //   $("#technologies").select2("val");
                    // $('#description-info').select2()
                    // $('#technologies').find(':selected');
                      $('#description-info').show();
                      $('#edit-description-info').hide();
                    //  
               
              }else{
                 setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                alertMessage('error',data.message);

              }
              /* setTimeout(function(){
                                   window.location.reload();
                                }, 4000);*/

          }
        });
         
      });
     
     $('#description-save').hide();
      $('#description-save').on('click', function() {
          var c = $('#edit-Contact').find("i");
          c.removeClass('icofont-close');
          c.addClass('icofont-edit');
          $('#description-info').show();
          $('#edit-description').hide();
           $('#description-save').hide();
      });
      
      $('#description-cancel').on('click', function() {
          var c = $('#edit-description').find("i");
          c.removeClass('icofont-close');
          c.addClass('icofont-edit');
          $('#description-info').show();
          $('#edit-description-info').hide();
          
      });

      $('#edit-description').on('click', function() {
          var b = $(this).find("i");
          var edit_class = b.attr('class');

          if (edit_class == 'icofont icofont-edit') {
              b.removeClass('icofont-edit');
              b.addClass('icofont-close');
              $('#description-info').hide();
              $('#edit-description-info').show();
               $('#description-save').show();
          } else {
              b.removeClass('icofont-close');
              b.addClass('icofont-edit');
              $('#description-info').show();
              $('#edit-description-info').hide();
               $('#description-save').hide();
          }
      });
});
</script>
<script>
$(document).ready(function(){
 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  $('li').removeClass('active');
  $(this).parent('li').addClass('active');
  var page = $(this).attr('href').split('page=')[1];
  var pagination_url = $('#pagination_url').val();
  
  fetch_data(page,pagination_url);
 });
 
 });
</script>
<script type="text/javascript">
function fetch_data(page,pagination_url)
 {
    
     var parts = pagination_url.split( '/' );
    var query = parts[parts.length-1].split( '.html' );
    query[0]= query[0].replace(/-/g," ");  
  
     Params = "page="+page;
     $.ajax({
       url:pagination_url,
       data:Params,
       type:"GET",
       success:function(data)
       {
           if(query == "employee_pagination"){
               const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://bluepixeltech.com/pmt/public/dist/bower_components/switchery/js/switchery.min.js';
            script.onload = () => {
            };

            const scr = document.createElement('script');
            scr.type = 'text/javascript';
            scr.src = 'https://bluepixeltech.com/pmt/public/dist/assets/pages/advance-elements/swithces.js';
            scr.onload = () => {
              $('.table_data').html(data);
            };

            document.body.appendChild(scr);
           }else{
               $('.table_data').html(data);
           }
           
            
        //$('.table_data').html(data);
      
       }
      });
 }
 </script>
 <script type="text/javascript">
    $(function(){
        $('.select2').select2({
           placeholder : "Select",

        }).on('change',function(){
        });
    })
</script>


<!--Add Client From Modal-->
<script type="text/javascript">
   $(document).ready(function(){

        $('.get_client').on('click',function(e){

            id = $(this).attr('data-id');  
             type = $(this).attr('data-type'); 
         $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{URL::to('admin/getclientcomments')}}",
            data: {_token: '{{ csrf_token() }}', id: id,type:type},
            success: function(res){
                if(res.status) {
                    var html = '';
                    if(type == 1)
                    {
                        $('.text-title').html('Conversions List');
                        $('.modal-title').html('Last Conversions ');
                        
                    }
                    else{
                         $('.text-title').html('Comments List');
                         $('.modal-title').html('Last Comments');
                    }
                    
                  $('#conversion_type').val(type);
                    
                        $('.table_data').html(res.html);
                    $('#conversion-Modal').modal({
                    show: true
                })
                }  
            }
        });
         }) 
        
        $('#addconversion').on('click',function(){
            $('.client-form').show();
           
        })
         $('#close_client').on('click',function(){
            $('.client-form').hide('');
             $('#comments').val('');
            
        })
   });
   
   $('.client').on('click',function(e) {

    e.preventDefault();
   
        id = $(client_id).val();
        var comments = $('#comments').val();
         var type = $('#conversion_type').val(); 
   
        if(comments == ""){
            $('#comment_msg').html('Enter Comment').show();
        }else
        if(comments == ""){
             $('#comment_msg').html('Enter Comment').show();
        }else
        {
            $('#comment_msg').hide();

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{URL::to('admin/client_conversion')}}",
            data: {_token: '{{ csrf_token() }}', id: id, comments: comments,type:type},
             success: function(res){
                if(res.status) {
                    var html = '';
                        html +="<tr>";
                        if(type == 1)
                        {
                             $('.comments').val(comments);
                        }
                        else{
                              $('.comments').val(comments);
                        }

                       
                   alertMessage('success',res.message);  
                      
                        $('#comments').val('');
                   $('.salary-close-btn').trigger('click');
                    }
                   
                }
    });
    }
         });
         
 $(document).on('change','.country', function(){
     var country = $('select[name^="country"] option:selected').val();
     $('select[name^="cost_symbol"] option[value="'+country+'"]').attr("selected", "selected");
 })
   </script>
   <!--Candidate List-->
 <script>
 $(document).ready(function(){
 
 $('.term').click(function(){
        var self =  $(this);
       
        if(self.attr('data-type') == "2") {
            $('#term1').removeClass('nodisplay').addClass('display');
            $('#term2').removeClass('display').addClass('nodisplay');
        } else if (self.attr('data-type') == "3") {
            $('#term2').removeClass('nodisplay').addClass('display');
            $('#term1').removeClass('display').addClass('nodisplay');
        }
    });

    var checkRadio = $('input[name="term"]:checked').val();
        
    if(checkRadio !== "") {
        
        if(checkRadio == 2) {
            $('#term1').removeClass('nodisplay').addClass('display');
            $('#term2').removeClass('display').addClass('nodisplay');
        } else if(checkRadio == 3) {
            $('#term2').removeClass('nodisplay').addClass('display');
            $('#term1').removeClass('display').addClass('nodisplay');
        }
    }
        
 })
     $(document).on('change','.candidatestatus',function(e) { 
     e.preventDefault();
            var id = $(this).attr('data-id');

        var value = $(this).val(); 
        
        if (value==2) {
        $('#modal-8').addClass('md-show');
        $('.candidate_id').val(id);
         $('#type').val(value);
        }
        else if(value==4)
        { 
          $('#modal-9').addClass('md-show');  
          $('.candidate_id').val(id);
         $('#interview_type').val(value); 
        }
        else{
             e.preventDefault();
            var id = $(this).attr('data-id');

            // alert(id);
            var type = $(this).attr('data-type'); 
                 $.ajax({
                type: "post",
                url: CHANGE_STATUS_URL,
                data: {   "_token": "{{ csrf_token() }}",
                        "id":id,
                        "type":value,
                        "table":table
                    },
                success: function (data) { 
                 var result =  JSON.parse(data); 
                   console.log(result);
                 if(result.status == 'true'){
                    console.log(result.data.status );
                 alertMessage('success','Status Updated Successfully');
                  setTimeout(function(){
                                   window.location.reload();
                                }, 3000);
              }
         }
         });
        }
 });
 //rejected
 $(document).on("submit", "#candidate_status", function(e){
        e.preventDefault();
        
        var formData = new FormData(this);
         var id = $(this).attr('data-id'); 
            
            var type = $(this).attr('data-type'); 
        formData.append('_token',"{{csrf_token()}}");
        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/candidate_status')}}",
            cache : false,
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
              if(res.status){
                 alertMessage('success','Status Updated Successfully');
                  setTimeout(function(){
                                   window.location.reload();
                                }, 3000);
              }
              else{
                    alertMessage('error',res.message);
                } 
            }         
        });
    });
    //reschedule
    $(document).on("submit", ".interview_schedule", function(e){
        e.preventDefault();
        var formData = new FormData(this);
         var id = $(this).attr('data-id'); 
            
            var type = $(this).attr('data-type'); 
        formData.append('_token',"{{csrf_token()}}");
        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/interview_schedule')}}",
            cache : false,
            processData: false,
            contentType: false,
            data: formData,
            success: function (res) {
              if(res.status){
                  alertMessage('success','Status Updated Successfully');
                  setTimeout(function(){
                                   window.location.reload();
                                }, 3000);
              }
              else{
                    alertMessage('error',res.message);
                } 
            }         
        });
    });
 </script>
 <script>
     $('.skill').on('change',function(){
         $("#skills :selected").each(function (i,sel) {
     if ($(sel).val() == 9) {
        $("#other_skill").show();
        }else{
            $("#other_skill").hide();     
        }
 });
     });
     
 </script>
 
<script>
  var rowIdx = 0;
    function AddNewItem(){
      
    //var t1= ++rowIdx;
    var table = document.getElementById("myTable");
    var t1=(table.rows.length);
    var row = table.insertRow(t1);
    
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    var cell4 = row.insertCell(4);
    var cell5 = row.insertCell(5);
    var cell6 = row.insertCell(6);
    var cell7 = row.insertCell(7);
    
    var addClass = "";
       if($('#is_include_tax').prop('checked') == true){
            addClass="";
       }else{
            addClass="d-none";
       }
     row.className = "new-row";
     cell4.className = 'text-center flex is_include_tax ' + addClass;
     cell5.className = 'text-center flex is_include_tax ' + addClass;
     cell7.className='text-center margin-top  ';
 
      $('<td><input type="text" class="form_control item_name" name="item['+t1+'][item_name]" placeholder="Item Name"></td>').appendTo(cell0);
      $('<input type="number" class="form_control quantity" name="item['+t1+'][quantity]" placeholder="Quantity">').appendTo(cell1);
      $('<input type="number" class="form_control rate" name="item['+t1+'][rate]" placeholder="Rate">').appendTo(cell2);
     
      $('<input type="text" class="form_control amount " name="item['+t1+'][amount]" placeholder="Amount">').appendTo(cell3);
      
      $('<input type="number" class="form_control tax is_include_tax" name="item['+t1+'][tax]" placeholder="Tax">').appendTo(cell4);
      $('<input type="number" class="form_control tax_amount is_include_tax" name="item['+t1+'][tax_amount]" placeholder="Tax Amount">').appendTo(cell5);
      $('<input type="number" class="form_control net_amount" name="item['+t1+'][net_amount]" placeholder="Net Amount">').appendTo(cell6);
  
      $('<div class="action_container"><button type="button" class="danger btn-sm delete-row margin-top "><i class="fa fa-close"></i></button></div>').appendTo(cell7);
            htmlCode = '<tr>';
    }
  
     
</script>


<script>
      $(document).on('click','.delete-row',function(){
        id = $(this).attr('data-id');
        // $('.tr'+id).remove();
        $(this).closest("tr").remove();
    });
</script>
<script>
$(document).on('change','.quantity',function() {
    var self = $(this);
    var price = $(this).parents('td').siblings('td').children('.rate').val();
    var quantity = self.val();
    self.parents('td').siblings('td').children('.amount').val(quantity*price);
  calculateAmount()
});

$(document).on('change','.rate',function() {
    var self = $(this);
    
    var rate = self.val();
    var quantity = $(this).parents('td').siblings('td').children('.quantity').val();
   
    self.parents('td').siblings('td').children('.amount').val(quantity*rate);
    self.parents('td').siblings('td').children('.net_amount').val(quantity*rate);
   calculateAmount()
});

$(document).on('change','.tax',function() {
   
    var self = $(this);
    var price = $(this).parents('td').siblings('td').children('.amount').val();
    var tax = self.val();
    var tax_amount = (price*tax)/100;
    var total_Amount = parseFloat(price) + parseFloat(tax_amount);

    self.parents('td').siblings('td').children('.tax_amount').val(tax_amount);
    self.parents('td').siblings('td').children('.net_amount').val(total_Amount);
    calculateAmount()
});

function calculateAmount()
{
  var subTotal = 0; var amount = 0;
  $('.amount').each(function()
  { 
    var value = $(this).val();
    if(value > 0)
      subTotal += parseFloat(value);
  });
  $('#sub-total').val(subTotal);
  $('.subTotal').text(subTotal);

  var tax_value = 0 ;
  $('.tax_amount').each(function()
  {
       var value = $(this).val();
     
        if(value > 0)
      tax_value += parseFloat(value);
  });  
  
  $('#tax_value').val(tax_value);
  $('.tax_value').val(tax_value);
  
  var total = subTotal  + parseFloat(tax_value);
  $('#total-amount').val(total);
}
</script>

<script>
    $(document).on('click','#is_include_tax',function(){
    console.log($('#is_include_tax').prop('checked'));
    if($('#is_include_tax').prop('checked')==true){
        $('.is_include_tax').removeClass('d-none');
        var tax_amount = 0;
        var self = $(this);
         var tax = 0; var tax_text = "";
         $('.tax_amount').each(function()
          { 
            var value = $(this).val();
            if(value > 0)
              tax_amount += parseFloat(value);
                $('.taxAmount').text(tax_amount);
                $('#total-tax').val(tax_amount);
                calculateAmount();
              });
        
    }else if($('#is_include_tax').prop('checked')==false){
        $('.is_include_tax').addClass('d-none');
        $('#total-tax').val(0);
        $('.taxAmount').text(0);
        calculateAmount()

    }
})

$(document).on('change','.tax_value',function(){
    value = $(this).val();
    calculateAmount();
})
</script>
</body>
</html>