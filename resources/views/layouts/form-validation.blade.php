<script type="text/javascript">
 $(document).ready(function() {

      validate.extend(validate.validators.datetime, {

          parse: function(value, options) {

              return +moment.utc(value);
          },
          // Input is a unix timestamp
          format: function(value, options) {

              var format = options.dateOnly ? "DD/MM/YYYY" : "DD/MM/YYYY";
              return moment.utc(value).format(format);
          }
      });

      // These are the constraints used to validate the form
      var constraints = {
          department_name: {
              // Email is required
              presence: true,
            
          },
         /* designation: {
              // Email is required
              presence: true,
            
          },
          email: {
              // Email is required
              presence: true,
              // and must be an email (duh)
              email: true
          },
          password: {
              // Password is also required
              presence: true,
              // And must be at least 5 characters long
              length: {
                  minimum: 5
              }
          },
          "repeat-password": {
              // You need to confirm your password
              presence: true,
              // and it needs to be equal to the other password
              equality: {
                  attribute: "password",
                  message: "^The passwords does not match"
              }
          },
          name: {
              // You need to pick a username too
              presence: true,
              // And it must be between 3 and 20 characters long
              length: {
                  minimum: 3,
                  maximum: 20
              },

              format: {
                  // We don't allow anything that a-z and 0-9
                  pattern: "[a-z0-9]+",
                  // but we don't care if the username is uppercase or lowercase
                  flags: "i",
                  message: "can only contain a-z and 0-9"
              }
          },
          addon: {
              // You need to pick a username too
              presence: true,
              // And it must be between 3 and 20 characters long
              length: {
                  minimum: 3,
                  maximum: 20
              },

              format: {
                  // We don't allow anything that a-z and 0-9
                  pattern: "[a-z0-9]+",
                  // but we don't care if the username is uppercase or lowercase
                  flags: "i",
                  message: "can only contain a-z and 0-9"
              }
          },
          maxlength: {
              presence: true,
              numericality: {
                  onlyNumeric: true,
                  greaterThan: 10
              }
          },
          minlength: {
              presence: true,
              numericality: {
                  onlyNumeric: true,
                  lessThan: 5
              }
          },
          gender: {
              // You need to pick a gender too
              presence: true,
          },*/
          status: {
              // You need to pick a gender too
              presence: true,
          }
      };
      // for designation rules
      var constraints2 = {
           department_id: {presence: {message: "^Department Name can't be blank"}
            
          },
          designation_name: {
              presence: true,
            
          },
          status: {
              presence: true,
          }
      };

      //for Holiday rule
       var constraints3 = {
          holiday_name: {
              presence: true,
            
          },
          start_date: {
              presence: true,
            
          },
          status: {
              presence: true,
          }
      };

      //for leave rule

       var constraints4 = {
          title: {
              presence: true,
            
          },
          reason: {
              presence: true,
            
          },
          start_date: {
              presence: true,
            
          },
          leave_type: {
              presence: true,
            
          }
        };

        // for Salary Slip rule
      var constraints5 = {
        emp_id:{
          presence : true,
        },
        date:{
          presence : true,
        },
        month_days:{
          presence : true,
        },
        wd:{
          presence : true,
        },
        pl:{
          presence : true,
        },
        cl:{
          presence : true,
        },
        lwp:{
          presence : true,
        },
        security_deduction:{
          presence : true,
        },
        oa:{
          presence : true,
        },
        ma:{
          presence : true,
        },
        lta:{
          presence : true,
        },
        pf:{
          presence : true,
        },
        pt:{
          presence : true,
        },
        basic_salary:{
          presence : true,
        },
        present_days:{
          presence : true,
        },
      };
      var constraints6 = {
           status: {
              presence: true,
          }
      };
      var constraints7 = {
        fullname:{
          presence : true,
        },
       /* address:{
          presence : false,
        },
        city:{
          presence : true,
        },
        state:{
          presence : true,
        },*/

       /* email_id:{
          presence : true,
        },*/
        mobile_no:{
          presence :true,
           
        },
       /* position:{
          presence : true,
        },
        experience:{
          presence : true,
         
        },
        dob:{
          presence : false,
        },
        application_date:{
          presence : true,
        },
       
       desi_id:{
           presence :true,
        },
        current_employer:{
          presence : true,
        },
        reason:{
          presence : true,
        },
        education:{
          presence : false,
        },
        skills:{
          presence : false,
        },
        cv:{
          presence : false,
        },
        current_ctc:{
          presence : false,
        },
        expected_ctc:{
          presence : false,
        },
        notice_period:{
          presence : true,
        },*/
      };
      var constraints8 = {
          company_name: {
              presence: true,
            
          },
          company_email: {
              presence: true,
            
          },
          hr_email: {
              presence: true,
            
          },
          address: {
              presence: true,
            
          },
           mobile_no: {
              presence: true,
            
          },
          p_tax: {
              presence: true,
            
          },
           website_url: {
              presence: true,
            
          },
           skype_url: {
              presence: true,
            
          },
           linkedin_url: {
              presence: true,
            
          },
          since_year: {
              presence: true,
            
          },
      };
      
      var constraints9 = {
           first_name: {
            presence:true,
           },
            gender: {
              presence: true,
          },
          dob: {
            presence:true,
           },
          address: {
              presence: true,
          },

          email: {
              presence: true,
          },
      };
      
      var constraints10 = {

          employee_name: {
            presence:true,
           },

           platform: {
            presence:true,
           },
            system_name: {
              presence: true,
          },

          system_model:{
              presence: true,
          },

          ram:{
              presence: true,
          },
           gen:{
              presence: true,
          },
          storage:{
              presence: true,
          },
          
          price:{
              presence: true,
          },
          
          purchase_date:{
              presence: true,
          },
purchase_from:{
              presence: true,
          },

          device:{
              presence: true,
          },
            
        
      };
      
      
      var constraints11 = {
           title: {
            presence:true,
           },
            message: {
              presence: true,
          },
        
      };
      
      /*var constraints12 = {
         firstname: {
            presence:false,
        },
        lastname:{
          presence :false,
        },
        gender: {
              presence: false,
        },
        email: {
            presence:false,
        },
        lastname:{
          presence :false,
        },
        contact_no: {
              presence: false,
        },
        country: {
            presence:false,
        },
        company_name:{
          presence :false,
        },
        company_address: {
              presence: false,
        },
        company_website: {
            presence:false,
        },
        image:{
          presence :false,
        },
        status:{
          presence :false,
        },

      };*/
       var constraints13 = {
        
          date: {
              presence: true,
          },
          payment_type: {
              presence: true,
          },
          paid_by:{
              presence:true,
          },
         /* invoice:{
              presence:false,
          },*/
         category_id:{
              presence:true,
          },
          
      };
      
        var constraints14 = {

            send_to:{
              presence: true,
          },

          title:{
              presence: true,
          },

           message:{
              presence: true,
          },
        };
      var constraints15 = {

            send_to:{
              presence: true,
          },

          employee:{
              presence: true,
          },

           message:{
              presence: true,
          },
      };
      
       var constraints16 = {

            
          rate:{
              presence:true,
          },
           item_name:{
              presence:true,
          },
           quantity:{
              presence:true,
          },
          amount:{
              presence:true,
          }
        };
        
        var constraints17 = {
          attachment:{
            presence:true,
          },
        };
      
      
      
      
      // Hook up the form so we can prevent it from being posted
      var form = document.querySelector("form#main");
     
      if(form != null) {
          form.addEventListener("submit", function(ev) {
    
              ev.preventDefault();
              handleFormSubmit(form);
          });
      }

      // Hook up the inputs to validate on the fly
      var inputs = document.querySelectorAll("input, textarea, select")
      for (var i = 0; i < inputs.length; ++i) {

          inputs.item(i).addEventListener("change", function(ev) {

              var errors = validate(form, constraints) || {};
              showErrorsForInput(this, errors[this.name]);

          });
      }

      function handleFormSubmit(form, input) {

          var table_name = $('#table_name').val();
          
          console.log(table_name);
          switch(table_name){
            case 'department':
              var errors = validate(form, constraints);
            break;

            case 'designation':
              var errors = validate(form, constraints2);
            break;

            case 'holiday':
              var errors = validate(form, constraints3);
            break;

            case 'leave_details':
              var errors = validate(form, constraints4);
            break;

             case 'salary':
              var errors = validate(form, constraints5);
            break;

            case 'reply':
              var errors = validate(form, constraints6);
            break;

            case 'candidate':
              var errors = validate(form, constraints7);
            break;
                
            case 'company':
              var errors = validate(form, constraints8);
            break;
            
            case 'myprofile':
              var errors = validate(form, constraints9);
            break; 
            
             case 'system_information':
              var errors = validate(form, constraints10);
            break; 
            
             case 'notification':
              var errors = validate(form, constraints11);
            break; 
            
            /*case 'clients':
              var errors = validate(form, constraints12);
            break;*/
            
            case 'other_expense':
              var errors = validate(form, constraints13);
            break;
             case 'attachment':
              var errors = validate(form, constraints17);
            break;
             case 'send_notification':
               var table_name = $('#table_name').val();
                switch(table_name){
                  case 'send_notification':
                  send_to = $('input[name=send_to]:checked').val(); 
                  if(send_to == 2){
                    emp = $('.employee').val(); 
                    if(emp == ""){
                     var errors = validate(form, constraints15);
                    }
                  }else{
                    var errors = validate(form, constraints14);
                  }
                  break;

                }
            break;


          }
          // validate the form aainst the constraints
          
          // then we update the form to reflect the results
          showErrors(form, errors || {});
          if (!errors) {
              showSuccess();
          }
      }

      // Updates the inputs with the validation errors
      function showErrors(form, errors) {
          // We loop through all the inputs and show the errors for that input
          _.each(form.querySelectorAll("input[name], select[name],textarea"), function(input) {
              // Since the errors can be null if no errors were found we need to handle
              // that
              showErrorsForInput(input, errors && errors[input.name]);
          });
      }

      // Shows the errors for a specific input
      function showErrorsForInput(input, errors) {
          // This is the root of the input

          var formGroup = closestParent(input.parentNode, "form-group");
              // Find where the error messages will be insert into
          var messages = "";
              // Find where the error messages will be insert into
          if(formGroup != null){
              messages = formGroup.querySelector(".messages");
              resetFormGroup(formGroup);
          }
          // If we have errors
          if (errors) {
              // we first mark the group has having errors
              formGroup.classList.add("has-error");
              // then we append all the errors
              _.each(errors, function(error) {

                  addError(messages, error, input);
              });
          } else {
            if(formGroup != null){
              // otherwise we simply mark it as success
              formGroup.classList.add("has-success");
            }
          }
      }

      // Recusively finds the closest parent that has the specified class
      function closestParent(child, className) {
          if (!child || child == document) {
              return null;
          }
          if (child.classList.contains(className)) {
              return child;
          } else {
              return closestParent(child.parentNode, className);
          }
      }

      function resetFormGroup(formGroup) {

          // Remove the success and error classes
          formGroup.classList.remove("has-error");
          formGroup.classList.remove("has-success");
          // and remove any old messages
          _.each(formGroup.querySelectorAll(".text-danger"), function(el) {
              el.parentNode.removeChild(el);
          });
      }

      // Adds the specified error with the following markup
      // <p class="help-block error">[message]</p>
      function addError(messages, error, input) {
        
          var block = document.createElement("p");
          block.classList.add("text-danger");
          block.classList.add("error");
          block.innerText = error;
          messages.appendChild(block);
          $(input).addClass("input-danger");
      }

      function showSuccess() {
        var base_url = $('#base_url').attr('data-href');
        
           form= new FormData($('#main')[0]);
           form.append("_token","{{csrf_token()}}");

         var table_name = $('#table_name').val();
          switch(table_name){
            case 'department':
              var  post_url = "{{URL::to('adddepartment')}}";

            break;
            case 'designation':
               form.append('id',$('#id').val());
              var  post_url = "{{URL::to('post_designation')}}";
            break;

             case 'holiday':
              var  post_url = "{{URL::to('add_holiday')}}";
            break;

           case 'leave_details':
              form.append('id',$('#leave_id').val()); 
              var  post_url = "{{URL::to('add_empleave')}}";
            break;
          
           case 'salary':
              var  post_url = "{{URL::to('/admin/add_salary')}}";
            break;

            case 'reply':
              form.append('id',$('#id').val());
              var  post_url = "{{URL::to('/admin/add_reply')}}";
            break;

            case 'candidate':
                let add = document.getElementsByClassName("add");
                 let status = add[0].getAttribute("data-value");
                 form.append('submit_status',status);
                  form.append('id',$('#candidate_id').val());
                   if($('#candidate_id').val() != ""){
                  form.append('old_cv',$('#old_cv').val());
                   }
              var  post_url = "{{URL::to('/admin/add_candidate')}}";
            break;

            case 'company':
            form.append('id',$('#id').val());
              var  post_url = "{{URL::to('/admin/add_companyprofile')}}";
            break;
            
             case 'myprofile':
            form.append('id',$('#id').val());
              var  post_url = "{{URL::to('/admin/update_myprofile')}}";
            break;

            case 'mobile':

                form.append('id',$('#mobile_id').val());
                 form.append('old_invoice',$('#old_invoice').val());
            var  post_url = "{{URL::to('/admin/add_system_information')}}";
            break;

            case 'laptop':
                form.append('id',$('#laptop_id').val());
                 form.append('old_invoice',$('#old_invoice').val());
            var  post_url = "{{URL::to('/admin/add_system_information')}}";
            break;
            
             case 'notification':
              var  post_url = "{{URL::to('/admin/add_notification')}}";
            break;
            
            /*case 'clients':
            form.append('id',$('#client_id').val()); 
             form.append('old_image',$('#old_image').val());
              var  post_url = "{{URL::to('/admin/addclient')}}";
            break;*/
             case 'client_conversion':
                form.append('id',$('#client_id').val());
             form.append('comment_id',$('#comment_id').val()); 
              var  post_url = "{{URL::to('client_conversion')}}";
            break;
            case 'attachments':
                form.append('id',$('#project_id').val());
             form.append('attachment_id',$('#attachment_id').val()); 
            //   var  post_url = "{{URL::to('client_conversion')}}";
            break;
            case 'attachments':
               form.append('project_id',$('#project_id').val());
               var  post_url = "{{URL::to('admin/add_attachment')}}";
            break;
            case 'other_expense':
               form.append('id',$('#other_expense_id').val());
               form.append('id',$('#other_expense').val());
               form.append('old_invoice',$('#old_invoice').val());
              var  post_url = "{{URL::to('/admin/add_other_expense')}}";
            break;

             case 'send_notification':
            send_to = $('input[name=send_to]:checked').val();
            if(send_to == 2){
              emp = $('.employee').val();
              if(emp == []){
                $('.messages').text('asa');
              }
            }
              var  post_url = "{{URL::to('/admin/send_to')}}";
            break;

          }
          //data.append('_token',$('meta[name="_token"]').attr('content'));
         
          $.ajax({
          type: "POST",
          url: post_url,
          data: form, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
            //   data = JSON.parse(data);
                 
              if(data.status == 'true'){
                $('#main')[0].reset();
                 setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                alertMessage('success',data.message);
              switch(table_name){
                case 'candidate':
                window.location.href = "{{URL::to('/admin/candidate_list')}}";
                break;
              /* case 'clients':
                 window.location.href = "{{URL::to('/admin/clients_list')}}";
                break;*/
                case 'other_expense':
               // window.location.href = "{{URL::to('/admin/list_other_expense')}}";
                break;
                case 'leave_details':
                     @php

                if(session('user_type') == "admin")
                  $a = URL::to('admin/leave/all_leave');
                else
                  $a =  URL::to('employee/leave_list/');

                @endphp
                 window.location.href = '<?php echo $a ?>';
              
                break;
              }
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
      }
    


});
 $(document).ready(function($) {
       $("#project_form").validate({
               
                rules: {
                    project_name: "required",                    
                    project_description: "required",
                    client_id: "required",
                    start_date: "required",
                    end_date: "required",
                    project_manager_id: "required",
                    project_report_id: "required",
                    employee_id: "required",
                    technology_id: "required",
                    project_status: "required",
                    project_priority: "required",
                    project_type: "required",
                    hour_rate:"required",
                    project_amount:"required",
                    
                },
                messages: {
                    project_name: "Please Enter Project Name",                   
                    project_description: "Please Enter Project Description",
                    client_id: "Please Select Client Name",
                    start_date: "Please Select Start Date",
                    end_date: "Please Select End Date",
                    project_manager_id: "Please Select Manager Name",
                    project_report_id: "Please Select Reporter Name",
                    employee_id: "Please Select Employees",
                    technology_id: "Please Select Technologies",
                    project_status: "Please Select Project Status",
                    project_priority: "Please Select Project Priority",
                    project_type: "Please Select Project Type",
                    hour_rate: "Please Enter Hour Rate",
                    project_amount: "Please Enter Project Amount",
                  
                },
                 errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.form-group') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },
        submitHandler: function(form) {
          form = new FormData($('#project_form')[0]);
          form.append('id',$('#project_id').val());
           var  post_url = "{{URL::to('admin/post_project')}}";
            $('.submit_project').attr('disabled','disabled').addClass('btn-disabled');
        $.ajax({
          type: "POST",
          url: post_url,
          data: form, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
              //data = JSON.parse(data);
                 
              if(data.status == 'true'){
                   $('.submit_project').removeAttr('disabled').removeClass('btn-disabled'); 
                   @php
                   if(session('user_type') == "admin")
                  $a = URL::to('admin/projects_list');
                else
                  $a =  URL::to('employee/projects_list/');

                @endphp
                 window.location.href = '<?php echo $a ?>';
                alertMessage('success',data.message);
                }else{
                  alertMessage('error',data.message);
                }
              }
        });
                
      }
  });
         $('#client_form').validate({
        
        //  ignore: 'input[type=hidden]',
         rules: {
                firstname: "required",                    
                lastname:"required",
                /*company_name:"required",
                company_website:"required",
                company_address:"required",
                country:"required",
                contact_no:"required",
                email:"required",
                portal:"required",
                applied_from_account:"required",
                date:"required",
                cost_symbol:"required",
                project_cost:"required",
                bid_by:"required",
                scope:"required",
                overview:"required",
                invited_by:"required",
                // response_date_by_client:"required",
                // reply_date_from_you:"required",
                plateform:"required",
                technologies:"required",
                status:"required",*/
                },
                messages: {
                    firstname: "Please Enter First Name",                    
                    lastname:"Please Enter Last Name",
                   /* company_name:"Please Enter Company Name",
                    company_website:"Please Enter Company Website",
                    company_address:"Please Enter Company Address",
                    country:"Please Select Country",
                    contact_no:"Please Enter Contact No",
                    email:"Please Enter Valid Mail Id",
                    portal:"Please Select Portal",
                    applied_from_account:"Please Select Applied Account",
                    date:"Please Select Date",
                    cost_symbol:"Please Select Cost Symbol",
                    project_cost:"Please Enter Project Cost",
                    bid_by:"Please Select Bid",
                    scope:"Please Enter Scope",
                    overview:"Please Enter Overview",
                    invited_by:"Please Select Applied By",
                    // response_date_by_client:"Please Select Response Date",
                    // reply_date_from_you:"Please Select Reply Date",
                    plateform:"Please Select Platform",
                    technologies:"Please Select Technology",                   
                    status:"Please Select Status", */                  
                },
                
                errorPlacement: function(error, element)
                {
                    if ( element.is(":radio") ) 
                    {
                    error.appendTo( element.parents('.form-group') );
                    }
                    else 
                    { // This is the default behavior
                    
                    error.insertAfter( element );
                    }
                },
                 submitHandler: function(form) {
                   
                  form = new FormData($('#client_form')[0]);
                  form.append('id',$('#client_id').val()); 
                  form.append('old_image',$('#old_image').val());
                   var client_image = $('#item-img-output').attr('src');
                  form.append('new_image',client_image);
                  form.append("_token","{{csrf_token()}}");
                 
                   var  post_url = "{{URL::to('admin/addclient')}}";
                    $('.submit_client').attr('disabled','disabled').addClass('btn-disabled');
                $.ajax({
                  type: "POST",
                  url: post_url,
                  data: form, 
                  cache : false,
                  processData: false,
                  contentType: false,
                 success: function(data) {
                    //   data = JSON.parse(data);
                 
                      if(data.status == 'true'){
                          
                           $('.submit_client').removeAttr('disabled').removeClass('btn-disabled');  
                         window.location.href = "{{URL::to('/admin/clients_list')}}";
                         alertMessage('success',data.message);
                        }else{
                          alertMessage('error',data.message);
                        }
                      }
                });
                
                }
                
    });     


  $("#basic_info").validate({
    // Specify validation rules
    rules: {
      firstname: "required",
      lastname: "required",
      company_name:"required",
      company_website:"required",
      company_address:"required",
      
    },
    // Specify validation error messages
    messages: {
      firstname: "Please Enter First Name",
      lastname: "Please Enter Last Name",
      company_name:"Please Enter Company Name",
      company_website:"Please Enter Company Website",
      company_address:"Please Enter Company Address",
      
    },
    errorPlacement: function(error, element)
                {
                    if ( element.is(":radio") ) 
                    {
                    error.appendTo( element.parents('.form-group') );
                    }
                    else 
                    { // This is the default behavior 
                    error.insertAfter( element );
                    }
                },
    submitHandler: function(form) {
  form = new FormData($('#basic_info')[0]);
        form.append('_token',"{{csrf_token()}}");
        form.append('client_id',$('#client_id').val()); 
 var  post_url = "{{URL::to('admin/update_client')}}";
        $.ajax({

            type: "POST",

            url: post_url,

            data: form, 

            cache : false,

            processData: false,

            contentType: false,

            success: function(data) {
             data = JSON.parse(data);
                 
                if(data.status == 'true'){

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

                    setTimeout(function(){$('.md-close').trigger('click');}, 3000);

                    alertMessage('error',data.message);
                }

                setTimeout(function(){

                   window.location.reload();

                }, 4000);



            }
    })
    }
  });
  
  $("#contact_info").validate({
    // Specify validation rules
    rules: {
      contact_no: "required",
      email: "required",
      
    },
    // Specify validation error messages
    messages: {
      contact_no: "Please Enter Contact No",
      email: "Please Enter Valid Mail Id",
      
    },
    errorPlacement: function(error, element)
                {
                    if ( element.is(":radio") ) 
                    {
                    error.appendTo( element.parents('.form-group') );
                    }
                    else 
                    { // This is the default behavior 
                    error.insertAfter( element );
                    }
                },
    submitHandler: function(form) {
  form = new FormData($('#contact_info')[0]);
        form.append('_token',"{{csrf_token()}}");
        form.append('client_id',$('#client_id').val()); 
 var  post_url = "{{URL::to('admin/update_client')}}";
        $.ajax({

            type: "POST",

            url: post_url,

            data: form, 

            cache : false,

            processData: false,

            contentType: false,

            success: function(data) {
             data = JSON.parse(data);
                 
       if (data.status == 'true') {
          

                // $('#edit-info')[0].reset();

                setTimeout(function() {

                    $('.md-close').trigger('click');

                }, 3000);

                alertMessage('success', data.message);



                var b = $('#edit-Contact').find("i");

                b.removeClass('icofont-close');

                b.addClass('icofont-edit');

                $('#contact-info').show();

                $('#edit-contact-info').hide();



            } else {

                setTimeout(function() {

                    $('.md-close').trigger('click');

                }, 3000);

                alertMessage('error', data.message);



            }

                setTimeout(function(){

                   window.location.reload();

                }, 4000);
            }
    })
    }
  });
  
   $("#description_info").validate({
    // Specify validation rules
    rules: {
      portal:"required",
                applied_from_account:"required",
                date:"required",
                cost_symbol:"required",
                project_cost:"required",
                bid_by:"required",
                scope:"required",
                overview:"required",
                invited_by:"required",
                // response_date_by_client:"required",
                // reply_date_from_you:"required",
                plateform:"required",
                technologies:"required",
                status:"required",
      
    },
    // Specify validation error messages
    messages: {
      portal:"Please Select Portal",
                    applied_from_account:"Please Select Applied Account",
                    date:"Please Select Date",
                    cost_symbol:"Please Select Cost Symbol",
                    project_cost:"Please Enter Project Cost",
                    bid_by:"Please Select Bid",
                    scope:"Please Enter Scope",
                    overview:"Please Enter Overview",
                    invited_by:"Please Select Applied By",
                    // response_date_by_client:"Please Select Response Date",
                    // reply_date_from_you:"Please Select Reply Date",
                    plateform:"Please Select Platform",
                    technologies:"Please Select Technology",                   
                    status:"Please Select Status", 
      
    },
    errorPlacement: function(error, element)
                {
                    if ( element.is(":radio") ) 
                    {
                    error.appendTo( element.parents('.form-group') );
                    }
                    else 
                    { // This is the default behavior 
                    error.insertAfter( element );
                    }
                },
    submitHandler: function(form) {
  form = new FormData($('#description_info')[0]);
        form.append('_token',"{{csrf_token()}}");
        form.append('client_id',$('#client_id').val()); 
 var  post_url = "{{URL::to('admin/update_client')}}";
        $.ajax({

            type: "POST",

            url: post_url,

            data: form, 

            cache : false,

            processData: false,

            contentType: false,

            success: function(data) {
             data = JSON.parse(data);
                 
               if (data.status == 'true') {

                // $('#edit-info')[0].reset();

                setTimeout(function() {

                    $('.md-close').trigger('click');

                }, 3000);

                alertMessage('success', data.message);



                var b = $('#edit-description').find("i");

                b.removeClass('icofont-close');

                b.addClass('icofont-edit');

                $('#description-info').show();

                $('#edit-description-info').hide();

                 $('#description-save').hide();

            } else {

                setTimeout(function() {

                    $('.md-close').trigger('click');

                }, 3000);

                alertMessage('error', data.message);

            }
             setTimeout(function() {

                window.location.reload();

            }, 4000);



            }
    })
    }
  });
 
     
        //Task Form
        $("#task_form").validate({
                rules: {
                    duration:"required",
                    task_title: "required",
                   
                    start_date:"required",
                    end_date:"required",
                    task_description:"required",
                    assign_to:"required",
                    report_to:"required",
                    assign_to_qa:"required",
                },
                messages: {
                    duration:"Please Select Duration",
                    task_title: "Please Enter Task Name",  
                    start_date:"Please Select Start Date",
                    end_date:"Please Select End Date",
                    task_description:"Please Enter Description",
                    assign_to:"Please Select Members",
                    report_to:"Please Select Report To",
                    assign_to_qa:"Please Select Assign QA Name",
                    
                },
                 errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.form-group') );
                
            }
            else 
            { // This is the default behavior 
                
                error.insertAfter( element );
            }
         },
        submitHandler: function(form) { 
            var options = $('#emp_id > option:selected');
             if(options.length == 0){
                 return false;
             }
            
          form = new FormData($('#task_form')[0]);
          var tab = $('#tab_id').val();
          form.append('id',$('#task_id').val());
          form.append('project_id',$('#project_id').val());
          form.append('priority',$("input[name='priority']:checked").val());
          var  post_url = "{{URL::to('task/post_task')}}";
           $('.submit_btn').attr('disabled','disabled').addClass('btn-disabled');
                $.ajax({
                  type: "POST",
                  url: post_url,
                  data: form, 
                  cache : false,
                  processData: false,
                  contentType: false,
                 success: function(data) {
                
              if(data.status == 'true'){
                $('.submit_btn').removeAttr('disabled').removeClass('btn-disabled');  
                showPreloader(true,tab);
                $('#task_form')[0].reset();
                console.log(form);
                 setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 2000);
                alertMessage('success',data.message);
                var change_status = $('#change_status').val();
                
                setTimeout(function(){
                                    to_do_div(tab);
                                    if(change_status != ""){
                                        to_do_div(change_status); 
                                    }
                                    
                                }, 4000);
                  
                }else{
                  alertMessage('error',data.message);
                }
              }
        });
                
      }
  }); 
  
   $("#template_form").validate({
               
                rules: {
                    template_name: "required",                    
                    template_description: "required",
                   
                },
                messages: {
                    template_name: "Please Enter Project Name",                   
                    template_description: "Please Enter Project Description",
                   
                },
                 errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.form-group') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         },
        submitHandler: function(form) {
          form = new FormData($('#template_form')[0]);
          form.append('id',$('#template_id').val());
           var  post_url = "{{URL::to('admin/post_template')}}";
            $('.submit_template').attr('disabled','disabled').addClass('btn-disabled');
        $.ajax({
          type: "POST",
          url: post_url,
          data: form, 
          cache : false,
          processData: false,
          contentType: false,
         success: function(data) {
              ///data = JSON.parse(data);
                 
              if(data.status == 'true'){
                   $('.submit_template').removeAttr('disabled').removeClass('btn-disabled'); 
                window.location.href = "{{URL::to('/employee/template_list')}}";
                alertMessage('success',data.message);
                }else{
                  alertMessage('error',data.message);
                }
              }
        });
                
      }
  });
  
     
 })
</script>