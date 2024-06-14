<script type="text/javascript" defer>
    function alertMessage(t,e){
        "success"==t?swal({title:"Success",text:e,type:"success",timer:3e3}):"warning"==t?swal({title:"Warning",text:e,type:"warning",timer:3e3}):swal({title:"Error",text:e,type:"error",button:"OK",timer:3e3})
    }
	function addCSRFRequest()

	{

	  var params='';

	  params+="_token="+"{{csrf_token();}}";

	  return params;

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

  function pad(number) {

    return ("0" + number).slice(-2);

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

              script.src = 'https://www.pmt.bluepixeltech.com/public/dist/bower_components/switchery/js/switchery.min.js';

              script.onload = () => {

              };



              const scr = document.createElement('script');

              scr.type = 'text/javascript';

              scr.src = 'https://www.pmt.bluepixeltech.com/public/dist/assets/pages/advance-elements/swithces.js';

              scr.onload = () => {

                $('.table_data').html(data);

              };



              document.body.appendChild(scr);

             }else{

                 $('.table_data').html(data);

             }

          }

      });

  }

  function AddNewItem(){

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



	var table = $('#table_name').val();

  var URL = $('#action').val();

  var DELETE_URL = "{{URL::to('common/delete')}}";

  var CHANGE_STATUS_URL = "{{URL::to('common/change_status')}}";
  var EMPLOYEE_STATUS_URL = "{{URL::to('common/employeeChangeStatus')}}";

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

      }, function () {

           $.ajax({

          type: "post",

          url: DELETE_URL,

          data: {"_token": "{{ csrf_token() }}","id":id,table:table},

          success: function (data) {

             if(data.status == 'true'){

                  alertMessage('success',data.message);

                  console.log($(this).closest('tr').remove());

                  $('#table_tr_'+id).remove()

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

                          var deactive = '<button type="button" title="You want to active this client?" class="btn btn-warning btn-icon waves-effect waves-light hvr-bounce-in option-icon change_status" data-id="'+id+'" data-type="1" id="change_status'+id+'"><i class="icofont icofont-ui-check"></i></button>';     

                        

                       }else{

                             var deactive = '<button type="button" title="You want to deactive this client?" class="btn btn-danger btn-icon waves-effect waves-light hvr-bounce-in option-icon change_status" data-id="'+id+'" data-type="0" id="change_status'+id+'"><i class="icofont icofont-ui-close"></i></button>';  

                      }

                      $('#change_status'+id).html(deactive);

                   break;



                   default:



                       if(result.data.status == 1){

                         var deactive = '<a class="change_status"  data-id="'+id+'"data-type="1"><span class="label label-success">Active</span></a>';  

                       }else{

                          var deactive = '<a class="change_status"  data-id="'+id+'" data-type="0"><span class="label label-warning">Deactive</span></a>';     

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

              data: {"_token": "{{ csrf_token() }}","id":id,"table":table},

              success: function (data) { 

                  var result =  JSON.parse(data); 

                

               if(result.status == 'true'){ 

                  switch(table){

                      case 'department':

                          $( this ).toggleClass( '#table_tr_'+id );

                          $('#table_tr_'+id).find('.tabledit-span_'+id).hide();

                          $('#table_tr_'+id).find('.tabledit-input_'+id).show();

                          $("#status_"+id+" > option"). each(function() { 

                          if(this. value == result.data.status)

                          {

                            $(this).attr("selected","selected");

                          } 

                        });

                      break;
                    case 'expense_category':

                          $( this ).toggleClass( '#table_tr_'+id );

                          $('#table_tr_'+id).find('.tabledit-span_'+id).hide();

                          $('#table_tr_'+id).find('.tabledit-input_'+id).show();

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



                      case 'leave_details':

                         

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

          data: {"_token": "{{ csrf_token() }}","id":id,"table":"leave"},

          dataType: "json",

          success: function (result) {

              if(result.status == 'true'){

          

                  $('#employee_name_span').html(result.data.full_name+ ' (' +result.data.designation_name+')');

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

      switch(table){

          case 'department':

              params+="&department_name="+$('#department_name_'+id).val();
          break;

        case 'expense_category':
           params+="&category_name="+$('#category_name_'+id).val();
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

                      case 'expense_category':

                         console.log(id);
                         console.log($('#category_name_'+id).val());

                          $('.category_'+id).text($('#category_name_'+id).val());

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

  $(document).ready(function() {
    
    $('#tds').change(function() {
      var total = parseInt($('#total').attr('data-val'));
      var deduct = parseInt($('#deduction').attr('data-val'));
      var tds = parseInt($(this).val());

      $('#deduction').val(Math.abs(tds + deduct));
      $('#total').val(Math.abs(total - tds));
    });
    
    var salaryInfo = $('#salaryInfo').val();

    if(salaryInfo !== undefined && salaryInfo !== "") {

        $('#salary_info_tab').addClass('active');

        $('#personal_tab').removeClass('active');



        $('#salary_info').addClass('active');

        $('#personal').removeClass('active');

    }

    

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

    

    $('.tab').click(function(){

        $('#salary_info').removeClass('active');

    });



    $(".docs").select2({

        placeholder: "Select Documents To upload"

    });    

    $('.term').click(function(){

        var self =  $(this);
        if(self.attr('data-type') == "0") {

            $('#term0').removeClass('nodisplay').addClass('display');

            $('#term1').removeClass('display').addClass('nodisplay');
            $('#term2').removeClass('display').addClass('nodisplay');
            $('#term3').removeClass('nodisplay').addClass('display');

        }
        else if(self.attr('data-type') == "1") {

            $('#term1').removeClass('nodisplay').addClass('display');
            $('#term3').removeClass('nodisplay').addClass('display');
             $('#term0').removeClass('display').addClass('nodisplay');

        } else if (self.attr('data-type') == "2") {

            $('#term2').removeClass('nodisplay').addClass('display');
            $('#term1').removeClass('display').addClass('nodisplay');
            $('#term0').removeClass('display').addClass('nodisplay');
            $('#term3').removeClass('display').addClass('nodisplay');
            $('#term5').removeClass('display').addClass('nodisplay');
            $('#term4').removeClass('display').addClass('nodisplay');

        }
        else if(self.attr('data-type') == "3")
        {
          $('#term4').removeClass('nodisplay').addClass('display');
          $('#term6').removeClass('display').addClass('nodisplay');
        }
         else if(self.attr('data-value') == "4"){
            $('#term6').removeClass('nodisplay').addClass('display');
            $('#term4').removeClass('display').addClass('nodisplay');
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

    var actSal = $('#act').val();

    if(actSal !== "" && actSal !== undefined) {

        $('.tab-pane').removeClass('active');

        $('.tab').removeClass('active');



        $('.salaryInfo').addClass('active');

    }



    $('.salaryinfo').on('click',function(){ 

        $("#lock-screen").modal('show');

        $('#first').focus()

        $('#salary_info').addClass('blur-bg');

        $('#official').addClass('blur-bg');

    })



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

  });// Document.ready close

  var baseUrl = $('#base_url').attr('data-href');

  $(document).on('change','#dept',function(){

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

                               '<a href="'+baseUrl+'admin/salary/'+v.id+'" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i> View</a> '+

                               '<div class="dropdown-secondary dropdown">'+

                                  '<a href="'+baseUrl+'downloadSalarySlip/'+v.id+'" class="btn btn-info btn-mini waves-light b-none txt-muted" type="button" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-download-alt"></i>Download</a>'+

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

                  window.location.href = baseUrl+"admin/employees_list";

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

                      window.location.href = baseUrl+"admin/employees_list";

                  }, 3000);

                }

                else{

                      alertMessage('error',res.message);

                  } 

              }         

          });

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

@php 

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $uri = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $url = explode('/', $url);

@endphp

<script type="text/javascript" defer>

  @if(strpos($uri,'employees_list') !== false)
    
    function employee_list(aParam = "")
    {
      var aParams = "";
      var page = "";

      if(aParam.page != undefined) {
        page = aParam.page;
      }
      var department_id = $('#department_id').find('option:selected').val();
      var search_status = $('#search_status').find('option:selected').val();      
      var searchVal = $('#search').val();

      aParams = "page="+page+"?department_id="+department_id+"?search_status="+search_status+"?search="+searchVal;

      $.ajax({
        url:"{{URL::to('admin/employee_pagination')}}",
        data:{page:page,department_id:department_id,search_status:search_status,search:searchVal},
        type:"GET",
        success:function(data)
        {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://www.pmt.bluepixeltech.com/public/dist/bower_components/switchery/js/switchery.min.js';
            script.onload = () => {
            };

            const scr = document.createElement('script');
            scr.type = 'text/javascript';
            scr.src = 'https://www.pmt.bluepixeltech.com/public/dist/assets/pages/advance-elements/swithces.js';
            scr.onload = () => {
              $('.table_data').html(data);
            };

            document.body.appendChild(scr);
        }
      })
    }
    
    $(document).on('click', '.pagination a', function(event){

        event.preventDefault(); 
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var page = $(this).attr('href').split('page=')[1];
        var aParam = {"page":page}
        employee_list(aParam)
    
    });

    $(document).ready(function() {
        
        employee_list()
        
        $("#filterBtn").on("click", function() {
          employee_list()
        });

      var timeout;

      $("#emp_name").on("keyup",function(){

          if(timeout) {

              clearTimeout(timeout);

              timeout = null;

          }

          timeout = setTimeout(searchEmployee, 1000)

      });

    });

  @endif



  @if(in_array('salary_list',$url) || in_array('listsalaryslip',$url))

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

    $(document).ready(function(){

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

                          window.location.href = baseUrl+"admin/salary_list";

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
                  
                  var data = res.data;
                  data.sort( function ( a, b ) { return b.total_amount - a.total_amount; } );

                  $.each(data,function(k,v){

                      var r = Math.floor(Math.random() * 4) + 0;

              

                      var arr = ['primary','success','info','warning','danger'];

                      var color = arr[r];

                      

                      var array = ['lite-green','green','lite-green','yellow','pink'];

                      var color2 = array[r];



                      var path = 'https://www.pmt.bluepixeltech.com/';



                   $('#data').append('<div class="col-md-v col-lg-l"><div class="card"><div class="card-block user-radial-card"><div data-label="50%" class="radial-bar radial-bar-100 radial-bar-lg radial-bar-'+color+'"><img src="'+path+'/uploads/users/'+v.image+'" alt="User-Image"></div><br><a href="'+path+'admin/employee_details/'+v.emp_id+'" target="_blank"><span class="f-36 text-c-'+color2+'" style="font-size: 20px;">'+v.full_name+'</span></a><p class="m-b-0 f-20">Rs.'+v.total_amount+'</p><div></div></div></div></div>');

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

          }, 4000);

      })

    })

  @endif



  @if(in_array('checkin',$url))
    
    let breakInterval;

    if($('#breakDr').val() != ""){

      breakInterval = setInterval(function () { 

        displayBreakHrs();

      }, 500);

    }

  @endif


  @if(strpos($uri, 'dashboard') !== false || strpos($uri, 'checkin') !== false)

    

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

             

          }

          if($("#checkin_c").text() == "-"){

              const d = new Date();

              $('#displayTime').html(d.toLocaleTimeString('en-GB'));

          }else{

           $("#displayTime").html(time);

          }

      }



        anim = 'fadeInUp';

        testAnim(anim);

        function testAnim(x) {

          $('.animationSandbox').addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){

            });

        };

        

        /* Display Greetings as per Time */

        var now = new Date();

        var hrs = now.getHours();

        var msg = "";



        if (hrs >=  4) msg = "Good Morning!";  // After 6am

        if (hrs >= 12) msg = "Good Afternoon!";// After 12pm

        if (hrs >= 17) msg = "Good Evening!";  // After 5pm

        if (hrs >= 22) msg = "Good Night!";    // After 10pm



        $('#greeting').text(msg);



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

    })

  @endif



  $(document).ready(function(){

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



    var getdate = new Date(date);



    getdate.setDate(getdate.getDate() - 6);

    

    $('#start_date').attr('min', getdate.toISOString().substr(0, 10));



    $(document).on('change','#start_date',function(e){

        var date=($('#start_date').val());

        var getdate = new Date(date);

        getdate.setDate(getdate.getDate() + 1);

        $('#end_date').attr('min', getdate.toISOString().substr(0, 10));

    })



    $(document).on('change','#start_date1',function(e){

        var date=($('#start_date1').val());

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

  })



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

           if(password != cpassword ) {

                $("#cpassword_msg").show().html("Confirm password does not match");

                return false;

           }

           $("#cpassword_msg").hide();

           

            params =$('#changepassword').serialize();

            params += '&'+addCSRFRequest();

            $.ajax({

                type: "post",

                url: "{{URL::to('common/change_password')}}",

                data: params,

                success: function (data) {

                    if(data.status == 'true'){

                        setTimeout(function(){

                            $('.md-close').trigger('click');

                        }, 3000);

                         alertMessage('success',data.message);

                    }

                    else{

                        $('#old_password_message').html(data.message).show();

                    }

                }

            });

        }

  });



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





</script>
@if(in_array('client_details',$url))
  @include('admin.client.client_js')
@endif

@if(in_array('add_client',$url) || in_array('edit_client',$url) || in_array('clients_list',$url))
  @include('admin.client.client_js')
@endif

@if(in_array('tasks_list',$url) || in_array('view_project_details',$url) || in_array('tasks_report',$url) || in_array('daily_task_report',$url))
  @include('admin.task.tasks_js')
@endif

@if(in_array('weekly_task_report',$url) || in_array('weekly_task_report',$url) || in_array('weekly_task_report',$url) || in_array('weekly_task_report',$url))
   <script type="text/javascript" src="{{ URL::to('dist/\bower_components\fullcalendar\js\fullcalendar.min.js')}}"></script>
     
  @include('admin.task.calender_js')
@endif
@if(in_array('weekly_hours_report',$url) || in_array('daily_task_report2',$url))
  @include('admin.task.echart-custom_js')
@endif
@if(in_array('view_project_details',$url))
  @include('admin.project.project_js')
@endif

@if(in_array('add_template',$url) || in_array('edit_template',$url))
  @include('admin.custom_template.template_js')
@endif
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

      navigator.serviceWorker.register('/public/firebase-messaging-sw.js')

        .then(function(registration) {

        messaging.useServiceWorker(registration);  

        

        messaging.requestPermission().then(function () {

            return messaging.getToken()

        }).then(function(token) {

            console.log(token);

            $.ajax({

                type: "post",

                url: "{{URL::to('updateFcm')}}",

                data: {_token:'{{csrf_token()}}',token:token},

                success: function (res) {

                }         

            });



        }).catch(function (err) {

        });

      }); 

    }

    

    messaging.onMessage(function({data:{body,title}}){

        new Notification(title, {body});

    });

</script>

@endif

<script type="text/javascript">

  $(document).ready(function() {

    

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



    

   


  

   



   



  





  }) //Document ready close



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

           if(result.status == 'true'){

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



  $(document).on('mouseover','.check-address',function(e) {

      e.preventDefault();

      address = $(this).attr('data-address');

      id = $(this).attr('data-id');

      $('.display_address').text(address);

  });



  $('#test-body').on('click', '.deleteconv', function() 

  { 

      $(this).closest('tr').remove();

  });



  function delete_row(id)

  {

    $('#row'+id).remove();

    alert(id);

  }



</script>

<script type="text/javascript">

  $(document).ready(function(){




    $('.select2').select2({

       placeholder : "Select",



    }).on('change',function(){

    });



    $('.skill').on('change',function(){

        $("#skills :selected").each(function (i,sel) {

          if ($(sel).val() == 15) {

            $("#other_skill").show();

          }else{

            $("#other_skill").hide();     

          }

        });

    });

/*

    var url = 'edit-status.php';

    $('ul[id^="sort"]').sortable({

          connectWith: ".sortable",

          receive: function (e, ui) {

             var status_id = $(ui.item).parent(".sortable").data("status-id");

             var task_id = $(ui.item).data("task-id");

          }

     

    }).disableSelection();
*/


    var  code = "<?= isset($data['client']->country_code)?$data['client']->country_code:"+1";?>"; 
    var  phone_number = "<?= isset($data['client']->contact_no)?$data['client']->contact_no:"";?>"; 
    $('#txtPhone').val(code+' '+phone_number);

    var iti = $('#txtPhone');

    iti.intlTelInput();



    iti.on('countrychange', function() {
        
        var countryCode = iti.val();

    })



    $("#addconversion").prop('value', 'Submit'); 

    $(".edit_cilent_comment_data").prop('value', 'Update'); 

  }) //Document ready close



 



  



  

  $(document).on('change','.country', function(){

     var country = $('select[name^="country"] option:selected').val();

     $('select[name^="cost_symbol"] option[value="'+country+'"]').attr("selected", "selected");

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

        else if(value == 4)

        { 

            $('#modal-9').addClass('md-show');  
            $('#schedule').prop('checked', true);
            // $('#reschedule').prop({readonly: true, disabled: true});
            // $('#cancel').prop({readonly: true, disabled: true});
            $('#term0').removeClass('nodisplay').addClass('display');
            $('.candidate_id').val(id);

            $('#interview_type').val(value); 

        }
        else if(value == 8){
            $('#modal-9').addClass('md-show');  
            $('#reschedule').prop('checked', true);
            // $('#schedule').prop({readonly: true, disabled: true});
            // $('#cancel').prop({readonly: true, disabled: true});
            $('#term0').removeClass('display').addClass('nodisplay');
            $('#term1').removeClass('nodisplay').addClass('display');
            $('.candidate_id').val(id);

            $('#interview_type').val(value); 
        }
        else{

            // e.preventDefault();

            var id = $(this).attr('data-id');

            var type = $(this).attr('data-type'); 
            var table = $('#table_name').val();

            $.ajax({

                type: "post",

                url: CHANGE_STATUS_URL,

                data: {"_token": "{{ csrf_token() }}","id":id,"type":value,"table":table},

                success: function (data) { 

                var result =  JSON.parse(data);

                if(result.status == 'true'){

                    alertMessage('success','Status Updated Successfully');

                    setTimeout(function(){

                        window.location.reload();

                    }, 3000);

                }

                }

            });

        }

  });

// employeecandidatestatus
 $(document).on('change','.employeecandidatestatus',function(e) { 
    
        // e.preventDefault();
        var id = $(this).attr('data-id');
        
        var value = $(this).val(); 
        
          
            var table = $('#table_name').val();

            $.ajax({

                type: "post",

                url: EMPLOYEE_STATUS_URL,

                data: {"_token": "{{ csrf_token() }}","id":id,"type":value,"table":table},

                success: function (data) { 

                var result =  JSON.parse(data);

                if(result.status == 'true'){
                    
                    alertMessage('success','Status Updated Successfully');

                    setTimeout(function(){

                        window.location.reload();

                    }, 3000);

                }

                }

            });
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



  $(document).on('click', '.add-new-task', function() {

      var tab = $(this).attr('data-task-tab');

      if (tab == 1) {



          $('.to-do-form').removeClass('d-none');

          var objDiv = document.getElementById("sort1");

          objDiv.scrollTop = objDiv.scrollHeight;

          console.log(objDiv.scrollTop);

      } else {

          $('.pending-form').removeClass('d-none');

      }



  })

  $(document).on('click', '.to-do-form-close', function() {

      $('.to-do-form').addClass('d-none');

  })

  $(document).on('click', '.to-do-form-submit', function() {



      var tabSubmit = $(this).attr('data-task-submit');

      if (tabSubmit == 1) {

          var taskTitle = $('#task-title').val();

          if (taskTitle == "") {

              alertMessage('False', "Please enter task");

          }

          var html = '<li class="text-row ui-sortable-handle card-border-warning to-do-add" data-task-id="1" >';

          html += '<a href="#" class="card-title">' + taskTitle + '</a>';

          html += '</li>';

          $('.new-div-append').append(html);

          $('#task-title').val('');

          $('.to-do-form').addClass('d-none');

      } else {

          var taskTitle = $('#task-title2').val();

          if (taskTitle == "") {

              alertMessage('False', "Please enter task");

          }

          var html = '<li class="text-row ui-sortable-handle card-border-primary to-do-add" data-task-id="1" >';

          html += '<a href="#" class="card-title">' + taskTitle + '</a>';

          html += '</li>';

          $('.new-div-append').append(html);

          $('#task-title2').val('');

          $('.pending-form').addClass('d-none');

      }



  })



 

  $(document).ready(function()
{
     $(document).on('click','.remove-milestone', function() {

       
        var id = $(this).attr('data-id');
        var type = $('#submit_type').val();
        console.log(id);
        
              $.ajax({
               type: "post",
               url: "{{URL::to('project/delete_milestone')}}",
               data: {"_token": "{{ csrf_token() }}","id":id},
               success: function (data) { 
                  // if(data.status == "true"){
                         $('.row_'+id).closest("tr").remove();  
                        //   }
               }
                   });
        
    
    });
     //var rowIdx = 0;
      
        $('#add-new-row').on('click',function(){
            var rowIdx= $('#test-table tbody tr').length - 1;
       
           $('#test-body').append(`<tr id="row${++rowIdx}" class="text-center row_${rowIdx}">
             <td>
            <textarea  value='' name="milestone[${rowIdx}][title]" type='text' size="150" class='form-control input-md' /></textarea>
            </td>
            <td>
            <input type="date" value='' name="milestone[${rowIdx}][sdate]" type='text'  class='form-control input-md' />
            </td>
            <td>
            <input type="date" value='' name="milestone[${rowIdx}][edate]" type='text' class='form-control input-md' />
            </td>
            <td>
            <select class="form-control show-tick" name="milestone[${rowIdx}][status]" >
            <option value="">Select</option>
            <option value="0">Active</option>
            <option value="1">Compelete</option>
            <option value="2">Deactive</option>
            <option value="3">Hold</option>
            <option value="4">InProgress</option>
            <option value="5">Paid</option>
            <option value="6">Sleep</option>
            </select>
            </td>
            <td>
            <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="1"  class='notify-row btn btn-primary'name="milestone[${rowIdx}][notify]">
          </td>
          <td class="text-center">
            <button class="remove-milestone btn btn-sm btn-danger delete" type="button" data-id="${rowIdx}"><span class="icofont icofont-ui-delete"></span></button>
          </td>
              </tr>`
              );
      });   
              
 });
</script>
</script>

@if(in_array('other_expense',$url) || in_array('list_other_expense',$url) || in_array('edit_other_expense',$url))

<script type="text/javascript" defer>
  
  $(document).on('click','.downloadExpCsv', function() {
      var from = $('.from').val('');
      var to = $('.to').val('');
      $('#expDownloadMdl').addClass('md-show');
  });
  
  function convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
  }

  function exportCSVFile(headers, items, fileTitle) {
        if (headers) {
          items.unshift(headers);
        }

        var jsonObject = JSON.stringify(items);

        var csv = this.convertToCSV(jsonObject);

        var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(blob, exportedFilenmae);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) {
                var myURL = window.URL || window.webkitURL
                var url = myURL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", exportedFilenmae);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
  }
  
  $(document).on('click','.downloadExpCsvBtn',function() {
      var from = $('.from').val();
      var to = $('.to').val();
      if(from == "" || to == "") {
        alertMessage('error','Please select both dates');
      }

      $.ajax({
          type: "POST",
          url: "{{URL::to('admin/download_expenses')}}",
          data: {_token: "{{ csrf_token() }}",from:from,to:to},
          success: function (res) {
            if(res.status){

              var headers = {
                srno:'Sr No.',
                date:'Purchased Date',
                category:'Category',
                description:'Description',
                payment_type:'Payment Type',
                tax_type: 'Tax(%)',
                tax:'Tax Amount',
                amount:'Amount'
              };

              var items = res.data;

              var fileTitle = 'Expenses_'+from+'-'+to;

              exportCSVFile(headers, items, fileTitle);
              
              $("#expDownloadMdl").removeClass('md-show');
              $('.md-close').trigger('click');
              alertMessage('success',res.message);  
            }
            else{
              alertMessage('error',res.message);
            } 
          }         
      });
  });

  $('.md-close-1').click(function(){
    $("#expDownloadMdl").removeClass('md-show');
  })
  
  $(document).on('change','.quantity',function() {

      var self = $(this);

      var price = $(this).parents('td').siblings('td').children('.rate').val();

      var quantity = self.val();

      self.parents('td').siblings('td').children('.amount').val((quantity*price).toFixed(2));

    calculateAmount()

  });



  $(document).on('change','.rate',function() {

      var self = $(this);

      

      var rate = self.val();

      var quantity = $(this).parents('td').siblings('td').children('.quantity').val();

     

      self.parents('td').siblings('td').children('.amount').val(quantity*rate);

      self.parents('td').siblings('td').children('.net_amount').val((quantity*rate).toFixed(2));

     calculateAmount()

  });

 $(document).on('change','.net_amount',function(){
       var self = $(this);
       var subTotal = 0;
        $('.net_amount').each(function()

    { 

      var value = $(this).val();

      if(value > 0)

        subTotal += parseFloat(value);

    });
    subTotal = subTotal.toFixed(2);

    $('#sub-total').val(subTotal);

    $('.subTotal').text(subTotal);
    
     $('#total-amount').val(subTotal);
 });

  $(document).on('change','.tax',function() {

     

      var self = $(this);

      var price = $(this).parents('td').siblings('td').children('.amount').val();

      var tax = self.val();

      var tax_amount = (price*tax)/100;

      var total_Amount = parseFloat(price) + parseFloat(tax_amount);



      self.parents('td').siblings('td').children('.tax_amount').val(tax_amount.toFixed(2));

    //   self.parents('td').siblings('td').children('.net_amount').val(total_Amount);

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
     subTotal = subTotal.toFixed(2);
    $('#sub-total').val(subTotal);

    $('.subTotal').text(subTotal);



    var tax_value = 0 ;
    if($('#is_include_tax').prop('checked')==true){
    $('.tax_amount').each(function()

    {
         var value = $(this).val();
          if(value > 0)
        tax_value += parseFloat(value);

    }); 
    }
    else{
    $('.tax_amount').each(function()
  {
    var value = $(this).val('');
   
  });
     $('.tax').each(function()
  {
    var value = $(this).val('');
    
  });
}

    tax_value = tax_value.toFixed(2);

    $('#tax_value').val(tax_value);

    $('.tax_value').val(tax_value);

    

    var total = parseFloat(subTotal)  + parseFloat(tax_value);

    $('#total-amount').val(total.toFixed(2));

  }

  $(document).on('click','#is_include_tax',function(){
 var self = $(this);
      if($('#is_include_tax').prop('checked')==true){

          $('.is_include_tax').removeClass('d-none');

          var tax_amount = 0;

         

           var tax = 0; var tax_text = "";

           $('.tax_amount').each(function()

            { 

              var value = $(this).val();

              if(value > 0)

                tax_amount += parseFloat(value);

                  $('.taxAmount').text(tax_amount.toFixed(2));

                  $('#total-tax').val(tax_amount.toFixed(2));

                  calculateAmount();

                });

          

      }else if($('#is_include_tax').prop('checked')==false){

          $('.is_include_tax').addClass('d-none');

          $('#total-tax').val(0);

          $('.taxAmount').text(0);
            var price = $(this).parents('td').siblings('td').children('.amount').val();
          self.parents('td').siblings('td').children('.net_amount').val(price.toFixed(2));

          calculateAmount()



      }

  })



  $(document).on('change','.tax_value',function(){

      value = $(this).val();

      calculateAmount();

  })

 
</script>
@endif
<!--Candidate Scripts-->
 <script>
    $(document).on('click','.submit_btn',function(){
        $('.submit_btn').removeClass("add");
      var id = $(this).attr('data-id');
     
      $("."+id).addClass("add");
})

$(document).on('click','.edit_data_leave',function(e) { 
         var table = 'leave_details';
        var id = $(this).attr('data-id');
        
          $.ajax({

              type: "post",

              url: GET_DATA_URL,

              data: {"_token": "{{ csrf_token() }}","id":id,"table":table},

              success: function (data) { 

                   var result =  JSON.parse(data); 

                

               if(result.status == 'true'){ 
                          $('#edit_leave_id').val(result.data.id);

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
                   
               }
              }
          })
     })
     $(document).on('click','#submitChatButton',function(e) {

        e.preventDefault();
        
        var title = $("#title").val(); 

        var reason = $("#reason").val();

        var start_date = $("#start_date").val();
        
        var leave_type = $("#leave_type").val();

    

        if(title == "" || reason == "" || start_date  == "" || leave_type  == ""){

            $('#tittle').html('Enter old password').show();

            $('#reason').html('Enter new password').show();

            $('#start_date').html('Enter confirm password').show();
            
            $('#leave_type').html('Enter confirm password').show();

        }

       

            params =$('#main2').serialize();
            params += '&id='+$('#edit_leave_id').val();
            params += '&'+addCSRFRequest();

            $.ajax({

                type: "post",

                url: "{{URL::to('add_empleave')}}",

                data: params,

                success: function (data) {

                    if(data.status == 'true'){
                         $('.md-close').trigger('click');
                              
                       alertMessage('success',data.message);
                        setTimeout(function(){

                             window.location.reload();

                        }, 3000);

                        
                    }

                    else{

                         setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 3000);
                alertMessage('error',data.message);
                    }

                }

            });

        

  });
 </script>
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
  </script>
  <!--Candidate-->
  <script>
    $(document).on('change', '.qualification_list', function () {

      var id = $(this).val();
      if(id == "qualification"){
          $('#model_qualification_form')[0].reset();
          $('#qualification-Modal').modal('show');
      }
   })
   
   $('.close-model').click(function() {
    $('#qualification-Modal').modal('hide');
});
  
</script>
<script>
     $('.qualification').on('click', function(e) {

        e.preventDefault();

        var name = $('#name').val();
            $.ajax({

                type: "POST",

                dataType: "json",

                url: "{{URL::to('admin/addqualification')}}",

                data: {

                    _token: '{{ csrf_token() }}',

                    name: name,
                   

                },

                success: function(res) {
                  
                    $('.name').val(name);
                     $('.qualification_list').html(res.data);
                    $('#name').val('');

                        console.log();

                        $('#qualification-Modal').modal('hide');
                   
                }

            });

    });
</script>
<script>
 $("#address-country").change(function() {
    let countryCode = $(this).find('option:selected').data('country-code');
  console.log(countryCode);//hk
    let value = "+" + $(this).val();
    console.log(value);//109
    $('#txtPhone').val(value).intlTelInput("setCountry", countryCode);
  });   
 
 
 $('#fileChooser').change(function () {
    if (this.files[0] == undefined)
      return;
    $('#clientImagePop').modal('show');
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      window.src = reader.result;
      $('#fileChooser').val('');
    }, false);
    if (this.files[0]) {
      reader.readAsDataURL(this.files[0]);
    }
});


let croppi;
$('#clientImagePop').on('shown.bs.modal', function () {
  let width = document.getElementById('upload-demo1').offsetWidth - 20;
  $('#upload-demo1').height((width - 80) + 'px');
    croppi = $('#upload-demo1').croppie({
      viewport: {
        width: width,
        height: width 
      },
    });
  $('.modal-body1').height(document.getElementById('upload-demo1').offsetHeight + 30 + 'px');
  croppi.croppie('bind', {
    url: window.src,
  }).then(function () {
    croppi.croppie('setZoom', 0);
  });
});
$('#clientImagePop').on('hidden.bs.modal', function () {
  croppi.croppie('destroy');
});

$(document).on('click', '.save-modal', function (ev) {
  croppi.croppie('result', {
    type: 'base64',
    format: 'jpeg',
    size: 'original'
  }).then(function (resp) {
      $('#item-img-output').attr('src', resp);
       var client_image = $('#item-img-output').attr('src');
     var new_image = $('#new_image').val();
      $('#clientImagePop').modal('hide');
  });
});

</script>
<!--Project Js-->
<script>
    $(document).on('change','.project_type',function(){

        var val =  $(this).val();
        if(val == 0){
            $('#project_type1').removeClass('nodisplay').addClass('display');
            $('#project_type2').removeClass('display').addClass('nodisplay');
            $('.project_type3').removeClass('display').addClass('nodisplay');
                
        }else if(val == 1){
            $('#project_type2').removeClass('nodisplay').addClass('display');
            $('#project_type1').removeClass('display').addClass('nodisplay');
            $('.project_type3').removeClass('display').addClass('nodisplay');
        
        }else{
            $('.project_type3').removeClass('nodisplay').addClass('display');
            $('#project_type2').removeClass('display').addClass('nodisplay');
            $('#project_type1').removeClass('display').addClass('nodisplay');
        
        }
    
    });
     $(document).on("click",'#completed',function(e){
        e.preventDefault();
      project_id = $(this).attr('data-id');
     $.ajax({
              type: "GET",
              dataType: "json",
              url: "{{URL::to('admin/viewprojecttask')}}",
              data: {project_id:project_id},
              success: function(data) {
                   setTimeout(function(){
                        window.location.href =  "https://www.pmt.bluepixeltech.com/admin/tasks_list";
                    }, 500);
                }
           });
    });
    
    function checkProjectValidation()
    {
        if($('#technology_id').val() == '') 
        {
            $('.error_message').text('Please Select Technologies');
        }
        else{
              $('.error_message').text('');
              return true;
        }
        if($('#team_member').val() == '') 
        {
            $('.error_message1').text('Please Select Team Members');
        }
        else{
              $('.error_message1').text('');
              return true;
        }
         return false;
    }
    
     $('.get_project_description').on('click', function(e) {

        id = $(this).attr('data-id');

        type = $(this).attr('data-type');

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{URL::to('admin/getprojectdescription')}}",

            data: {

                _token: '{{ csrf_token() }}',

                id: id,

                type: type

            },

            success: function(res) {

                if (res.status) {

                    var html = '';

                    if (type == 2) {

                        $('.text-title').html('Project Description');

                        $('.modal-title').html('Project Description ');



                    } 


                    $('#project_description_type').val(type);



                    $('.project_description_data').html(res.html);



                    $('#project_description-Modal').modal({

                        show: true

                    })



                }

            }

        });

    })
    
     var showChar = 50;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    
        
</script>

<script>
   /* function filterColumn ( i, id ) {
       
        $('#ProjectTable').DataTable().column( i ).search(id).draw();
        
    }*/
    

    $(document).ready(function() {
        
        $(".js-example-basic-single").select2();
        $('#ProjectTable').DataTable();
        $('#filterProject').on( 'click', function () {
            
            var id  = $('#projectId2').find('option:selected').val();
           
            //filterColumn(1,id);
            $('#ProjectTable').DataTable().column(1).search('PMT').draw();
        } );
    } );
</script>
<script>
$(document).on('click','#send_mail',function(){
   var checked = []
    $("input[name='mail_status[]']:checked").each(function ()
    {
        checked.push(parseInt($(this).val()));
    });
    console.log(checked);
    var mail_status  = checked;
    var isCheckedEmployee = $('#employee')[0].checked;
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-type'); 
    var interview_place_status = $('#interview_place_status').val(); 
         sendMail(id,type,interview_place_status,mail_status);
            //alertMessage('success','Mail sent successfully');

                    // setTimeout(function(){

                    //     window.location.reload();

                    // }, 3000);
      })
   function sendMail(id,type,interview_place_status,mail_status){
       
         $.ajax({

          type: "post",

          url: "{{URL::to('admin/sendMailAgain')}}",

          data: {"_token": "{{ csrf_token() }}","id":id,"type":type,"interview_place_status":interview_place_status,"mail_status":mail_status},

          dataType: "json",

          success: function (result) {

              if(result.status == "true"){

              alertMessage('success','Mail sent successfully')

            }else{
                alertMessage('error','Mail not sent')
              console.log('Something went wrong');

            }

          }

      });
    }
    
    

</script>
<script>
        $('#duration').on('change', function (e) { 

        if ($('#duration').val() == 'other') {

            $("#other_year").show();

        }else{

            $("#other_year").hide();     

        }

    });
</script>

@if(in_array('candidate_list2',$url))
<script>
    $(document).ready(function () {
   
   
      $("#CandidateTable").dataTable({
        "searching": true
      });

    //   //Get a reference to the new datatable
      var table_a = $('#CandidateTable').DataTable();

      $("#filterTable_filter.dataTables_filter").append($("#candidate_status"));
      
      var categoryIndex = 5;
      $("#CandidateTable th").each(function (i) {
          
        if ($($(this)).html() == "status") {
          categoryIndex = i; return false;
        }
      });

      //Use the built in datatables API to filter the existing rows by the Category column
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#candidate_status').val()
          var category = data[categoryIndex];
          if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );

      //Set the change event for the Category Filter dropdown to redraw the datatable each time

      //a user selects a new filter.
      $("#candidate_status").change(function (e) {
       var table_a = $('#CandidateTable').DataTable();
       
        table_a.draw();
      });

    //   table_a.draw();
   
 
});
</script>

@endif
@if(in_array('candidate_list',$url))
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#candidate_status").change(function (e) {
       var table_a = $('#CandidateTable').DataTable();
       
        table_a.draw();
      });

  $(function () {
      
    var table = $('#CandidateTable').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        pageLength:25,
        ajax: {
          url: "{{  URL::TO('employee/candidate_list') }}",
          data: function (d) {
                d.candidate_status = $('#candidate_status').val(),
                d.search = $('input[type="search"]').val()
            }
        },
         "columnDefs": [
        {
            "render": function (data, type, row) {
                return row.DT_RowIndex;
            },
            "targets": 0, // Assuming the ID column is the first column
        },
       
       ],
        columns: [ 
            {data: 'id', name: 'id'},
            {data: 'fullname', name: 'fullname'},
            {data: 'email_id', name: 'email_id'},
            {data: 'mobile_no', name: 'mobile_no'},
            {data: 'technology', name: 'technology'},
            {data: 'status_name', name: 'status_name'},
            {data: 'status', name: 'status'},
            {data: 'interview_date', name: 'interview_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
});
</script>
@endif
<script>
  $(document).ready(function(){
    $(document).on('change','.category',function(){
     category =  $('.category').val();
      if(category == '-1'){
        $('#modal-1').addClass('md-show');

      }

    });
    $(document).on('click','.save_category',function(e) {

        e.preventDefault();
        var category_name = $("#category_name").val(); 

        if(category_name == ""){

             $('#category_name_message').html('Enter Category Name').show();

        }else{

            $('#category_name_message').hide();
            $('.messages').hide();

            params =$('#category_form').serialize();

            params += '&'+addCSRFRequest();

            $.ajax({

                type: "post",

                url: "{{URL::to('add_expense_category')}}",

                data: params,

                success: function (data) {

                    if(data.status == 'true'){
                         alertMessage('success',data.message);
                        table_name = $('#table_name').val();
                        if(table_name == 'expense_category'){
                          window.location.reload();
                        }else{
                        setTimeout(function(){
                            $('#category_form')[0].reset();
                            $('#modal-1').removeClass('md-show');
                            $('.category').html(data.html);
                        }, 2000);
                      }
                        

                    }

                    else{

                       

                    }

                }

            });

        }

  });
    $(document).on('click','.close_category_model',function(){
      $('#modal-1').removeClass('md-show');
    })
  });
  
    $('.task-report-exp').click(function(){
      var id = $(this).attr('data-id');
      $('#project_id').val(id);
      $('#task-report-exp-mdl').modal({ show: true });
    });
    $('#task_report_submit').click(function(){
        var projectId = $('#project_id').val();
        var month = $('#month').val();
        if(month == "") {
          alert("Please select month");
          return false;
        }

        var url = baseUrl+'export_monthly_task_report/'+projectId+'/'+month;

        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();

        $("#task-report-exp-mdl").modal('hide');
        
    })
</script>
<script>
      $(document).on('click','.submit_btn_feedback',function(e) {

        e.preventDefault();
        
        var comment = $('#comment').val(); 

       

        if(comment == ""){

            $('#comment_message').html('Enter feedback message').show();

        }else {

            $('#comment_message').hide();
            params =$('#feedback-form').serialize();

            params += '&'+addCSRFRequest();

            $.ajax({

                type: "post",

                url: "{{URL::to('common/post_feedback')}}",

                data: params,

                success: function (data) {

                    if(data.status == 'true'){

                         alertMessage('success',data.message);
                         setTimeout(function(){

                              window.location.reload();

                          },2000);
                    }

                }

            });

        }

  });
</script>
