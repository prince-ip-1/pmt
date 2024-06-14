<!DOCTYPE html>
<html lang="en">
<head>
    <title>PMT</title>
   @php 

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $uri = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $url = explode('/', $url);

@endphp
    <!-- Meta -->
    <base id="base_url" data-href="https://www.pmt.bluepixeltech.com/">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{AdminLogo(2)}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/icon/icons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" async integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/style.css?v=1.3')}}">
    <!-- Sweet Alert -->
   
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components/sweetalert/css/sweetalert.css')}}">
   
    <!-- Common Style -->
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/assets/css/component.css')}}">
    @if(!in_array('checkin',$url))
    
    <link rel="stylesheet" href="{{URL::to('dist/assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('dist/bower_components/select2/css/select2.min.css')}}">
    @endif
    
    
    <!-- DataTables -->
    @if(!in_array('tasks_list',$url) || !in_array('checkin',$url))
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
   @endif

   <!-- weekly task report start-->
   @if(in_array('weekly_task_report',$url))
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\fullcalendar\css\fullcalendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/bower_components\fullcalendar\css\fullcalendar.print.css')}}" media='print'>
  @endif
   <!-- weekly task report end-->
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
   
    <style>
        select{-moz-appearance: none;-webkit-appearance: none;appearance: none;}
        select.form-control{
            background-image: linear-gradient(45deg, transparent 50%, #000 50%), linear-gradient(135deg, #000 50%, transparent 50%);
            background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px), calc(100% - 2.5em) 0.5em;
            background-size: 5px 5px, 5px 5px, 1px 1.5em;
            background-repeat: no-repeat;/*font-family: "Font Awesome";content:"\f107";background-repeat: no-repeat;background-position-x: 98%;background-position-y: 5px;*/}
        .btn-cs {padding: 8px 18px}
        .order-card .system-icon{position:absolute;right:-2px;font-size:62px;top:15px;opacity:0.5}
    </style>
    
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
     
    <!-- Jquery -->
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/bootstrap/js/bootstrap.min.js')}}" async></script>
    <script type="text/javascript" src="{{URL::to('dist\bower_components\switchery\js\switchery.min.js')}}" async></script>
    <script type="text/javascript">
        "use strict";
        $(document).ready(function() {
            var elem = Array.prototype.slice.call(document.querySelectorAll('.js-small'));
            elem.forEach(function(html) {
                var switchery = new Switchery(html, { color: '#FFB64D', jackColor: '#fff', size: 'small'});
            });
        });
    </script>
    
    <script type="text/javascript" src="{{URL::to('dist/assets/js/SmoothScroll.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}" async></script>
    <!--Forms - Wizard js-->
    <script src="{{URL::to('dist/bower_components/jquery.cookie/js/jquery.cookie.js')}}" defer></script>
    <script src="{{URL::to('dist/bower_components/jquery.steps/js/jquery.steps.js?v='.filemtime(public_path('dist/bower_components/jquery.steps/js/jquery.steps.js')))}}"></script>
    <script src="{{URL::to('dist/bower_components/jquery-validation/js/jquery.validate.js')}}" defer></script>
    
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/js/components.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/form-validation/validate.js')}}" async></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js" defer></script>
    
    @include('layouts.form-validation')
    
    <!-- data-table js -->
    <script src="{{URL::to('dist/assets/js/dataTables-js.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script src="{{URL::to('dist/bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{URL::to('dist/assets\pages\data-table\js\data-table-custom.js')}}?v=1.2"></script>
    
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/toolbar/jquery.toolbar.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist/assets/pages/toolbar/custom-toolbar.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('dist\bower_components\select2\js\select2.full.min.js')}}"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    
   <!-- <script type="text/javascript" src="{{URL::to('dist/assets/pages/advance-elements/select2-custom.js')}}" defer></script>-->
    <!--<script type="text/javascript" src="{{URL::to('dist/bower_components/select2/js/select2.full.min.js')}}"></script>-->
    
<script type="text/javascript">
    $(function () {
         var  code = "<?= isset($data['client']->country_code)?$data['client']->country_code:"+1";?>"; 
         var  phone_number = "<?= isset($data['client']->contact_no)?$data['client']->contact_no:"";?>"; 
         //var code = "+92"; // Assigning value from model.
        $('#txtPhone').val(code+' '+phone_number);
        var iti = $('#txtPhone');
        iti.intlTelInput();
        
        iti.on('countrychange',function(){
        var countryCode =  iti.val();
        //  $('#country_code').val(countryCode);
    })
    });
</script>
    @php
    $uri = url()->current();
    @endphp

    @if(in_array('edit_employee',explode('/',$uri)) || in_array('add_employee',explode('/',$uri)))
    <script src="{{URL::to('dist/assets/pages/forms-wizard-validation/form-wizard.js')}}"></script>
    @endif
    <script src="{{URL::to('dist/assets/js/pcoded.min.js')}}"></script>
    <script src="{{URL::to('dist/assets/js/vartical-layout.min.js')}}"></script>
   
    <script type="text/javascript" src="{{URL::to('dist/assets/js/script.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::to('dist/assets/js/script.js')}}"></script>

    @include('includes.scripts')
    
    <script defer>
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
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#clear').on('click',function(){
            window.location.reload();
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
    
    <script type="text/javascript" src="{{URL::to('dist/assets/js/croppie.js')}}" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {

            $(document).on('click', '#buttonid', openDialog);
            
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
                    reader.onload = function(e) {
                        $('.upload-demo').addClass('ready');
                        $('#cropImagePop').modal('show');
                        rawImg = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
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
            $('#cropImagePop').on('shown.bs.modal', function() {
                $uploadCrop.croppie('bind', {
                    url: rawImg
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            });
        
            $('.item-img').on('change', function() {
        
                imageId = $(this).data('id');
                tempFilename = $(this).val();
                $('#cancelCropBtn').data('id', imageId);
                readFile(this);
            });
            $('#cropImageBtn').on('click', function(ev) {
                $uploadCrop.croppie('result', {
                    type: 'base64',
                    format: 'jpeg',
                    size: {
                        width: 150,
                        height: 150
                    }
                }).then(function(resp) {
                    $('#item-img-output').attr('src', resp);
                    var profile_image = $('#item-img-output').attr('src');
                    var old_image = $('#old_image').val();
                    id = $('#emp_id').val();
                    var params = addCSRFRequest();
                    params += '&id=' + id;
                    params += '&image=' + profile_image;
        
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('common/imageUpload')}}",
                        data: {
                            id: id,
                            '_token': '{{csrf_token()}}',
                            old_image: old_image,
                            image: profile_image
                        },
                        success: function(data) {
                            if (data.status == 'true') {
                                $('#old_image').val(data.data)
                                $('#remove_image').removeClass('d-none');
                                alertMessage('success', data.message);
        
                            } else {
                                alertMessage('error', data.message);
        
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
        
            $('.view-image').on('click', function() {
                image = $('#item-img-output').attr('src');
                $('.view_image').attr('src', image);
                // $('#Modal-lightbox').show().addClass('show');
                $('#Modal-lightbox').modal({
                    show: true
                })
            });
            $(document).on('click', '.remove-image', function(e) {
                e.preventDefault();
                swal({
                    title: "Are you sure you want to remove image?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
        
                }, function(isConfirm) {
                    if (isConfirm) {
                        var id = $(this).attr('data-id');
                        var imgname = $('#old_image').val();
                        var type = $(this).attr('data-type');
                        $.ajax({
                            type: "post",
                            url: "{{URL::to('common/removeimage')}}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id,
                                "image": imgname
                            },
        
                            success: function(data) {
                                if (data.status == 'true') {
                                    $('#item-img-output').attr('src', data.data);
                                    alertMessage('success', data.message);
        
                                } else {
                                    alertMessage('error', data.message);
                                }
                                $('#remove_image' + id).html();
                            }
                        });
                    }
                });
            });
            
            $(document).on('click', '.checkall', function(e) {
                $(".selectall").prop('checked', $(this).prop('checked'));
                $('.singlecheckall').prop('checked', $(this).prop('checked'))
            });
            var items = $('.singlecheck');
            $(document).on('click', '.singlecheckall', function(e) {
                id = $(this).attr('data-id');
            
                items.filter(function() {
                    return $(this).attr('data-id') === id;
                }).prop('checked', $(this).prop('checked'));
                $('.checkall').prop('checked', false)
            
            })
            
            var items2 = $('.singlecheckall');
            $(document).on('click', '.singlecheck', function(e) {
                id = $(this).attr('data-id');
                items2.filter(function() {
                    return $(this).attr('data-id') === id;
                }).prop('checked', false);
                $('.checkall').prop('checked', false)
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
        });
     
    </script>
    @if(in_array('weekly_hours_report',$url) || in_array('daily_task_report2',$url))
    <script src="{{ URL::to('dist/assets\pages\chart\echarts\js\echarts-all.js')}}" type="text/javascript"></script>
    @endif
</body>
</html>