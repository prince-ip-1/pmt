
<script type="text/javascript">
$(document).ready(function() {

loadTaskList();
/*loadTaskCount();*/
function loadTaskList(){
	/**/
  to_do_div(0);
  to_do_div(1);
  to_do_div(2);
  to_do_div(3);
  to_do_div(4);
  to_do_div(5);
}
	 $(document).on('change','#project_id',function(){
            project_id = $('#project_id').val();
            task_employee_id = $('#task_employee_id').val('');
            changeEmpoyeeList(project_id);
            loadTaskList();
            
           /* loadTaskCount(project_id);*/
           
      })
      $(document).on('change','#task_employee_id',function(){
            task_employee_id = $('#task_employee_id').val();
            
            loadTaskList();
           /* loadTaskCount(project_id);*/
           
      }) 
      $(document).on('change','#task_qa_id',function(){
            task_qa_id = $('#task_qa_id').val();
            
            loadTaskList();
           /* loadTaskCount(project_id);*/
           
      })
        $(document).on('click','#clear_employee',function(){
            if($('#task_employee_id').val() != ""){
                $('#task_employee_id').val('');
                $('#task_qa_id').val('');
             loadTaskList();
            }
           
      })
	  $('ul[id^="sort"]').sortable({
         connectWith: ".sortable",
         receive: function (e, ui) {
             var status_id = $(ui.item).parent(".sortable").data("status-id");
             
             var task_id = $(ui.item).data("task-id");
             var tab_id = $(ui.item).data("tab-id");
             console.log(task_id);
             $.ajax({
                 url: "{{URL::to('task/changeTaskStatus')}}?status_id="+status_id+"&task_id="+task_id+"&from_status="+tab_id,
                 success: function(response){
                     //response = JSON.parse(response); 
                     if(response.status == 'true'){
                            to_do_div(status_id);
                            to_do_div(tab_id);
                     }else{
                         alertMessage('error',response.message);
                          to_do_div(status_id);
                          to_do_div(tab_id);
                     }
                }
             });
             }
     
     }).disableSelection();


	 
	  


$(document).on('keyup',$('textarea#add_comment'),function(){
    if ($('textarea#add_comment').summernote('isEmpty') ) {
            $('#submit_task').attr('disabled','disabled');
    }else{
        $('#submit_task').removeAttr('disabled');
    }
   /* if ($('textarea#add_comment').summernote('isEmpty') ) {
             $('.add_comment_div').addClass('d-none');
             return $('.error_msg').text('Please enter comment.');
    }*/
});

$(document).on("click", "#submit_task", function(e){
            e.preventDefault();
            

            var formData = new FormData($('.task_comments_form')[0]);
            var task_id = $('#task_id').val();
            var total =  $('.comment_list_count').attr('data-total-comment');
            
            $('.comment_list_div').prepend(ShowLoader());
            formData.append('_token',"{{csrf_token()}}");
            formData.append('task_id',$('#task_id').val());
            formData.append('comment_id',$('#comment_id').val());
            $.ajax({
                type: "POST",
                url: "{{URL::to('task/add_comments')}}",
                cache : false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res){
                    
                   $('.pre-loader').addClass('d-none');
                  if(res.status == 'true'){
                     $('textarea#add_comment').summernote('reset');
                    console.log(total);
                    
                    if($('#comment_id').val() == ""){
                        var count = parseInt(total) + 1;
                        $('.comment_list_count').html('('+count+')');
                       }
                        $('.comment_list_count').attr('data-total-comment',count);
                        $('.task_comment_' + $('#comment_id').val()).remove();
                        $('.comment_list_div').prepend(res.data);
                    
                        console.log($('#add_comment').summernote('code'))
                       // $('.comment_'+$('#comment_id').val()).html($('#add_comment').summernote('code'))
                   
                   
                    
                    $('#submit_task').attr('disabled','disabled');
                    }else{
                    alertMessage('error',res.message);
                  }
                }         
            });
});
$(document).on('change','#tab_status',function(){
    $('#change_status').val($(this).val());
})
$(document).on('click','.add-task',function(){
    
               id=$(this).attr('data-task_id');
               tab=$(this).attr('data-task-tab');
               project_id = $('#project_id').val();
               console.log(tab);
                $('#tab_status').val(tab).attr("selected", "selected");
                $('#tab_id').val(tab);
               
               if(id == ""){
                   $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "{{URL::to('GetProjectMemberList')}}",
                     data: {_token: '{{ csrf_token() }}',project_id:project_id },
                     success: function(res){
                        //  res = JSON.parse(res); 
                         if(res.status == 'true'){
                             console.log(res.html)
                             $('.emp_id').html(res.html);
                         }
                         $('#task_form')[0].reset();
                            $('textarea#summernote').summernote('reset');
                            $("input[name=priority][value='m']").attr('checked', true);
                            $('#tab_status').val(tab).attr("selected", "selected");
                            $('#add-task-Modal').modal({
                                show: true
                             });
                            $('.submit_btn').html('Save');
                            $('.delete_task_btn').addClass('d-none');
                            $("#emp_id").select2({
                                dropdownParent: $("#add-task-Modal")
                              });
                            $('#assign_to_qa').select2({
                                dropdownParent: $("#add-task-Modal")
                             })
                            $('.task_model_title').text('Add Task');
                            $('#task_id').val(id);
                     }
                   });
                   
               }else{
                $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "{{URL::to('GetTaskDetailsById')}}",
                     data: {_token: '{{ csrf_token() }}',id:id },
                     success: function(res){
                            
                        result = res.data;
                        
                         $('#add-task-Modal').modal({
                                show: true
                            });
                        
                         $('.submit_btn').html('Update');
                         $('.delete_task_btn').removeClass('d-none');
                         $('.delete_task_btn').html('Delete');
                         $('.delete_task_btn').attr('data-id',id);
                          $("#emp_id").select2({
                            dropdownParent: $("#add-task-Modal")
                          });
                        $("#assign_to_qa").select2({
                            dropdownParent: $("#add-task-Modal")
                          });
                        $('.task_model_title').text('Edit Task');
                        $('#task_id').val(id);
                        $('#duration').val(result.duration).attr("selected", "selected");
                        $('#report_to').val(result.report_to).attr("selected", "selected");
                        // $('#assign_to_qa').val(result.assign_to_qa).attr("selected", "selected");
                        $('#assign_to_dev').val(result.assign_to_dev).attr("selected", "selected");
                        $("input[name=priority][value="+result.priority+"]").attr('checked', 'checked');
                        $("#is_notify").val(result.is_notify).attr('checked', 'checked');
                        $('#task_start_date').val(result.start_date);
                        $('#task_end_date').val(result.end_date);
                       
                        $('#task_title').val(result.task_title); 
                        $('#task_description').val(result.task_description); 
                        $('#task_type').val(result.task_type).attr("selected", "selected");
                        emp_list = JSON.parse(result.assign_to);
                        emp_qa_list = JSON.parse(result.assign_to_qa);
                        console.log(emp_list);
                        $('#emp_id').val(emp_list).trigger('change');
                        $('#assign_to_qa').val(emp_qa_list).trigger('change');
                        // $('#emp_id').val(emp_list);
                        $("#summernote").summernote("code", result.task_description);
                       
                        },
                      
                        })
                         
                   }
                  
});
 $(document).on('click','.delete_task_btn',function(){
     var id = $(this).attr('data-id'); 
     tab=$(this).attr('data-task-tab');
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

          url: "{{URL::to('task/delete_task')}}",

          data: {"_token": "{{ csrf_token() }}","id":id},

          success: function (data) {
              data = JSON.parse(data); 
             if(data.status == 'true'){
                   
                  alertMessage('success',data.message);
                  setTimeout(function(){
                                    $('.md-close').trigger('click');
                                }, 1000);
                   to_do_div($('#tab_id').val());
                    
             }
             else{
                  alertMessage('error',data.message);
             }
        },
    })
      
 });
})
$(document).on('click','.view-task',function(){
               id=$(this).attr('data-task-id');
               $('.add_comment_div').addClass('d-none'); 
               $.ajax({
                     type: "GET",
                     dataType: "json",
                     url: "{{URL::to('task/TaskDetails')}}",
                     data: {id:id},
                     success: function(res){
                         result = res.data;
                         $('#view-task-Modal').modal({
                            show: true
                         });
                          $('.modal-title').html("#" +result.task_project_id+" "+result.task_title);
                          $('#description_div').html(result.task_description);
                        //   var start_date = moment(result.start_date).format('DD-MM-YYYY');
                        //   $("#start_date_div").text(start_date);
                          $('#start_date_div').html(result.start_date);
                          $('#end_date_div').html(result.end_date);
                          $('#assign_to_div').html(result.employee_list);
                          $('#t_id').val(result.id);
                          $('.emp_list').html(result.emp_list);
                          $('#report_to_div').html(result.reporter_name);
                          $('#assign_to_qa_div').html(result.employee_qa_list);
                          $('#priority_div').html(result.priority);
                          $('#status_div').html(result.status_name).attr('data-status',result.status);
                          $('#task_id').val(result.id);
                          $('.comment_name').html(result.comment_name);
                          if(result.status != 2 && result.status != 4){
                            $('#mark_as_done').hide();
                            $('.start_task_tracking').hide();
                             $('#task_start_time').val();
                            $('#task_start_time_div').hide();
                         }
                         else{
                             $('#mark_as_done').show();
                             $('#mark_as_done').attr('data-status',result.data_status)
                            $('.start_task_tracking').show();
                            $('#task_start_time').val();
                            $('#task_start_time_div').hide();
                            
                            if(result.timer_start != ""){
                                $('#task_start_time_div').show();
                                $('#task_start_time').val(result.timer_start); 
                                $('.start_task_tracking').text('Stop Tracking').attr('data-type',1);
                                taskInterval = setInterval(function () { 
                                    displayTaskTime();
                                }, 500);
                            }else{
                                 $('.start_task_tracking').text('Start Tracking').attr('data-type',0);
                            }
                            
                         }
                          commentTaskList(result.id,0);
                          trackingTaskList(result.id,0);
                          
                     }
                     });
});
/*task description start*/
/*$('textarea#summernote').summernote({
    placeholder: 'Enter Text',
        tabsize: 3,
        fontsize:13,
        height: 100,
        followingToolbar: false,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                         ['height', ['height']],
                        ['para', ['ul', 'ol', 'paragraph']]
                    ]
                });*/
    function registerSummernote(element, placeholder, max, callbackMax) {
    $(element).summernote({
        tabsize: 3,
        fontsize:13,
        height: 100,
    followingToolbar: false,
      toolbar: [
         ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                         ['height', ['height']],
                        ['para', ['ul', 'ol', 'paragraph']]
      ],
      placeholder,
      callbacks: {
        onKeydown: function(e) {
          var t = e.currentTarget.innerText;
          if (t.length >= max) {
            //delete key
            if (e.keyCode != 8)
              e.preventDefault();
            // add other keys ...
          }
        },
        onKeyup: function(e) {
          var t = e.currentTarget.innerText;
          if (typeof callbackMax == 'function') {
            callbackMax(max - t.length);
          }
        },
        onPaste: function(e) {
          var t = e.currentTarget.innerText;
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          var all = t + bufferText;
          document.execCommand('insertText', false, all.trim().substring(0, 1000));
          if (typeof callbackMax == 'function') {
            callbackMax(max - t.length);
          }
        }
      }
    });
  }

 $(function(){
  registerSummernote('#summernote', 'Enter Description', 1000, function(max) {
      console.log(max);
      if(max < 0){
          
          $('.error_message').text('Please Enter Description Upto 1000 Characters');
          $('.submit_btn').attr('disabled','disabled').addClass('btn-disabled');
      }else{
          $('.error_message').text('');
           $('.submit_btn').removeAttr('disabled').removeClass('btn-disabled');  
      }
    //$('#maxContentPost').text(max)
  });
});
/*task description end*/
$("div.note-editing-area div.note-editable").keypress(function (evt) {
       var kc = evt.keyCode;
       var qbQuestion = $('textarea#summernote').summernote('code');
       if (kc === 32 && (qbQuestion.length == 0 || qbQuestion == '<p><br></p>')) {
          event.preventDefault();
       }
    });
      
$('textarea.project_summernote').summernote({
        placeholder: 'Enter Text',
        tabsize: 3,
        height: 100,
        followingToolbar: false,
        toolbar:[
                   // ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                   // ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    //['insert', ['link', 'picture', 'hr']],
                    // ['view', ['fullscreen', 'codeview']],
                    // ['help', ['help']]
                ],
});

$('textarea#add_comment').summernote({
        placeholder: 'Enter Text',
        tabsize: 2,
        height: 100,
        followingToolbar: false,
        toolbar:[
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    //['insert', ['link', 'picture', 'hr']],
               ],
});

$(document).on('click','.add_comment',function(){
    
    $('.add_comment_div').removeClass('d-none'); 
    $('.no_comment_message').addClass('d-none'); 
    $('textarea#add_comment').summernote('reset');
    $('#submit_task').html('Post');
    var comment_id = $(this).attr('data-id'); 
    $('#comment_id').val(comment_id);
 })

$(document).on('click','.close_comment',function(){
    $('.add_comment_div').addClass('d-none'); 
    id  = $('#comment_id').val();
    $('.task_comment_'+id).removeClass('d-none');
    $('.add_comment ').removeClass('d-none');
})

$(document).on('click','.start_task_tracking',function(e) {
	    e.preventDefault();
	    
	    var task_id = $('#task_id').val();
        var status = $('#status_div').attr('data-status');
        var type = $(this).attr('data-type');
        var project_id = $('#project_id').val();
         $('.task_tracking_div_new').prepend(ShowLoader());
         $('.start_task_tracking').attr('disabled','disabled')
	    $.ajax({
	       type: "POST",
	          url: "{{URL::to('task/task_tracking')}}",
	          data: {   "_token": "{{ csrf_token() }}",
	                    "task_id":task_id,
	                    "type":type,
                        "status":status,
                        "project_id":project_id
                   },
            success: function(res) {
                
                $('.pre-loader').addClass('d-none');
                $('.start_task_tracking').removeAttr('disabled');
              if(res.status == 'true'){
                   
                var total =  $('.task_tracking_count').attr('data-total-tracking');
                if(total == 0){
                   $('.no_tracking_message').addClass('d-none');
                   trackingTaskList(task_id,0);
                }
                 if(type == 0){
                      var count = parseInt(total) + 1;
                        $('.task_tracking_count').html('('+count+')');
                        $('.task_tracking_count').attr('data-total-tracking',count);
                        $("#task_tracking_tbl tbody tr:first").after(res.data.html);
                        $('#task_start_time').val(res.data.start_time);
                        $('#task_start_time_div').show();
                        $('.task_icon').show();
                        $('.start_task_tracking').text('Stop Tracking').attr('data-type',1);
                        taskInterval = setInterval(function () { 
                                displayTaskTime();
                            }, 500);
                 }else{
                    clearInterval(taskInterval);
                    console.log(0);
                    $('.end_time_'+res.data.id).html(res.data.end_time);
                    $('.duration_'+res.data.id).html(res.data.duration);
                    $('.start_task_tracking').text('Start Tracking').attr('data-type',0);
                 }
                  
              }else{
                  alertMessage('error',res.message);
              } 
            }
})

		})   
$(document).on('change','#status_div',function(e) {
			 var task_id = $('#task_id').val(); 
             var status_id = $(this).val();
             $.ajax({
                 url: "{{URL::to('task/changeTaskStatus')}}?task_id="+task_id+"&status_id="+status_id,
                 success: function(res){
                    loadTaskList();
                    $('.md-close').trigger('click');

                }
             });

}) 
$(document).on('click','#mark_as_done',function(e) {
    
             var task_id = $('#task_id').val(); 
             var status_id = $(this).attr('data-status');
             var type = $(this).attr('data-type');
             $('#mark_as_done').attr('disabled','disabled');
             $.ajax({
                 url: "{{URL::to('task/changeTaskStatus')}}?task_id="+task_id+"&status_id="+status_id+"&type="+type,
                 success: function(res){
                        //res = JSON.parse(res);     
                        //$('#mark_as_done').text('Completed');
                        $('#mark_as_done').removeAttr('disabled');
                         if(res.status == 'true'){
                             alertMessage2();
                              
                                $('.md-close').trigger('click');
        
                                loadTaskList();
                            }else{
                             alertMessage('error',res.message);
                            }
                       

                }
             });
})
});
 function alertMessage2(){
   
        //swal("Success",message, "success");
          swal({
             title: "Good Job",
             text: "You have perform task well",
             type: "success",
             timer: 3000
             });
            /* function () {
                //location.reload(true);
                tr.hide();
             };*/
    }
function commentTaskList(task_id,emp_id){
                
              var  post_url = "{{URL::to('task/getTaskCommentList')}}";
              var task_id = $('#task_id').val();
               $.ajax({
                      type: "POST",
                      url: post_url,
                      data: {   "_token": "{{ csrf_token() }}",
                                "task_id":task_id,
                                "emp_id":emp_id
                               },
                      success: function(res) {
                       
                         $('.comment_list_div').html(res.result);
                         $('.comment_list_count').html('('+res.total+')');
                         
                         
                         $('.comment_list_count').attr('data-total-comment',res.total);
                          
                          }
                    });
                
            }
function trackingTaskList(task_id,emp_id){
                
              var  post_url = "{{URL::to('task/getTaskTrackingList')}}";
              var task_id = $('#task_id').val();
               $.ajax({
                      type: "POST",
                      url: post_url,
                      data: {   "_token": "{{ csrf_token() }}",
                                "task_id":task_id,
                                "emp_id":emp_id
                               },
                      success: function(res) {
                          
                         $('.task_tracking_div').html(res.result);
                         $('.task_tracking_count').html('('+res.total+')');
                         $('.task_tracking_count').attr('data-total-tracking',res.total);
                          
                          }
                    });
                
            }            
function displayTaskTime(){
        var get = $('#task_start_time').val();
        var bTime = new Date(get).getTime();
        var currTime = new Date().getTime();
        var c =  currTime - bTime;
       
        var p = "00:00:00";
        if($('#task_pre').val() != "") {
            p = $('#task_pre').val();
        }
    
        var r = p.split(':');
    
        var h = Math.floor((c % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))+parseInt(r[0]);
        var m = Math.floor((c % (1000 * 60 * 60)) / (1000 * 60))+parseInt(r[1]);
        var s = Math.floor((c % (1000 * 60)) / 1000)+parseInt(r[2]);
    
        $("#task_start_time_div").html(pad(h) + ":" + pad(m) + ":" + pad(s));
        }

  function ShowLoader(){
        $html = '<div class="pre-loader">';
        $html += '<div class="preloader3 loader-block backlog-loader">';
        $html +='<div class="circ1 loader-backlog"></div>';
        $html +='<div class="circ2 loader-backlog"></div>';
        $html +='<div class="circ3 loader-backlog"></div>';
        $html +='<div class="circ4 loader-backlog"></div>';
        $html +='</div>';
        $html +='</div>';
     return $html;                        
  }      
 function showPreloader(busy,tab)
{

  let spinnerWrapper = document.querySelector('.backlog-loader');
  let spinnerWrapper1 = document.querySelector('.to-do-loader');
  let spinnerWrapper2 = document.querySelector('.in-progress-loader');
  let spinnerWrapper3 = document.querySelector('.completed-loader');
  let spinnerWrapper4 = document.querySelector('.in-testing-loader');
  let spinnerWrapper5 = document.querySelector('.ready-to-deploy-loader');

  if(tab == 0){
    if(busy){
       $(spinnerWrapper).show(); 
    } else {
       $(spinnerWrapper).hide(); 
    }
  } if(tab == 1){
    if(busy){
       $(spinnerWrapper1).show(); 
    } else {
       $(spinnerWrapper1).hide(); 
    }
  }
  if(tab == 2){
    if(busy){
       $(spinnerWrapper2).show(); 
    } else {
       $(spinnerWrapper2).hide(); 
    }
  }
  if(tab == 3){
    if(busy){
       $(spinnerWrapper3).show(); 
    } else {
       $(spinnerWrapper3).hide(); 
    }
  }
  if(tab == 4){
    if(busy){
       $(spinnerWrapper4).show(); 
    } else {
       $(spinnerWrapper4).hide(); 
    }
  }
  if(tab == 5){
    if(busy){
       $(spinnerWrapper5).show(); 
    } else {
       $(spinnerWrapper5).hide(); 
    }
  }
}
function to_do_div(tab){
 showPreloader(true,tab);
 
  var  post_url = "{{URL::to('task/getTaskList')}}";
  var project_id = $('#project_id').val();
  var task_employee_id = $('#task_employee_id').val();
  var task_qa_id = $('#task_qa_id').val();
   $.ajax({
          type: "POST",
          url: post_url,
          data: {   "_token": "{{ csrf_token() }}",
                    "tab":tab,
                    "project_id":project_id,
                    "task_employee_id":task_employee_id,
                    "task_qa_id":task_qa_id,
                   },
          success: function(data) {
             
            showPreloader(false,tab);
              if(tab == 0){
                  
              	 $('.backlog-div').html(data.result);
                $('.backlog-count').html('('+data.total_count+')');
              
                
              }else if(tab == 1){
              	$('.to-do-div').html(data.result);
                $('.to-do-count').html('('+data.total_count+')');
               
              }
              else if(tab == 2){
              	 $('.in-progress-div').html(data.result);
                $('.in-progress-count').html('('+data.total_count+')');
                
              }
              else if(tab == 3){
              	$('.completed-div').html(data.result);
                $('.completed-count').html('('+data.total_count+')');
              
               }
              else if(tab == 4){
              	$('.in-testing-div').html(data.result);
                $('.in-testing-count').html('('+data.total_count+')');
                }
              else if(tab == 5){
                $('.ready-to-deploy-div').html(data.result);
                $('.ready-to-deploy-count').html('('+data.total_count+')');
              }
            }
        });
}                    

function changeEmpoyeeList(){
           
            var  post_url = "{{URL::to('task/getTaskEmplist')}}";
            var project_id = $('#project_id').val();
           
             $.ajax({
          type: "POST",
          url: post_url,
          data: {   "_token": "{{ csrf_token() }}",
                    "project_id":project_id
                   },
         success: function(data) {
                $('#task_employee_id').html(data.employee_list);
              }
        });
      }
      
   
</script>
<script>
$(document).on('change','#emp_id',function(e){

          if($('#emp_id').val() == '') {
             $('.error_message1').text("Please Select Members");
          }
          else{
                 $('.error_message1').text('');
               
          }
    })
    $(document).on('change','#assign_to_dev',function(e){

         if($('#assign_to_dev').val() == '') {
            $('.error_message2').text("Please Select Developers");
          }
          else{
                 $('.error_message2').text('');
                 return true;
          }
    })
    
    
function checkButton() {
    if ($('textarea#summernote').summernote('isEmpty')) {
            $('.error_message').text('Please Enter Description Upto 1000 Characters');
             $('.submit_btn').attr('disabled','disabled').addClass('btn-disabled');
            return false;
    }
    else{
      $('.error_message').text('');
      $('.submit_btn').removeAttr('disabled').removeClass('btn-disabled');
      return true;
    }

    if($('#emp_id').val() == '') {
         $('.error_message1').text("Please Select Members");
      }
      else{
             $('.error_message1').text('');
             return true;
      }
      
      if($('#assign_to_dev').val() == '') {
         $('.error_message2').text("Please Select Developers");
      }
      else{
             $('.error_message2').text('');
             return true;
      }
      
       return false;
}
</script>
<script>
    $(document).on('change','#task_start_date',function(e){

        var date=($('#task_start_date').val());

        var getdate = new Date(date);

        getdate.setDate(getdate.getDate() + 0);

        $('#task_end_date').attr('min', getdate.toISOString().substr(0, 10));

    })
</script>
<script>
$(document).on('change','#task_title',function(e){
            var field = $('#task_title').val(); 
            var mnlen = 2;
            var mxlen = 250;
            if(field.length<mnlen || field.length> mxlen) {
                
                $('.task_error').text("Please Enter Title Between 2 to 250 Characters");
                $('.submit_btn').attr('disabled','disabled').addClass('btn-disabled');
            }
            else{
                $('.task_error').text('');
                $('.submit_btn').removeAttr('disabled').removeClass('btn-disabled');
                   
            }
    })

</script>
 <script>
      $(document).on('click','.edit_comment',function(){
            var comment_id = $(this).attr('data-id');
             var comment = $(this).attr('data-comment');
            $('#submit_task').text('Update');
            $('#comment_id').val(comment_id);
            $('textarea#add_comment').summernote("code",comment);
            $('.add_comment_div').removeClass('d-none'); 
            $('.task_comment_'+comment_id).addClass('d-none');
            $('.add_comment').addClass('d-none');
           
      })
      $(document).on('change','#emp_list',function(){
          emp_id = $(this).val();
          t_id = $('#t_id').val();
          trackingTaskList(t_id,emp_id);
      })
      $(document).on('change','#emp_list2',function(){
          emp_id = $(this).val();
          t_id = $('#t_id').val();
          commentTaskList(t_id,emp_id);
      });
  </script>
  <script>
    $(document).ready(function(){
        $(document).on('click','.view_task_report',function(){
            user_id = $(this).attr('data-id');
            start_date = $(this).attr('data-start_date');
             $.ajax({

                type: "post",

                url: "{{URL::to('view-task-report')}}",

                data: {"_token": "{{ csrf_token() }}","user_id":user_id,"start_date":start_date},

                success: function (data) { 

                var result =  JSON.parse(data);
                 var html = '';
               if(result.status == 'true'){

                   // alertMessage('success','Status Updated Successfully');
                     $.each(result.data, function( index, value ){
                            console.log(value.task_title);
                            
                           
                            sr_no = index + 1;
                        
                            html +="<tr>";

                            html +="<td>"+sr_no+"</td>";

                            html +="<td style='word-wrap: break-word;white-space: inherit;'>"+value.task_title+" (<b>"+value.project_name+"</b>)</td>";

                            html +="<td>"+value.start_time+" - "+value.end_time+"</td>";
                            html +="<td>"+value.duration+"</td>";

                            html +="</tr>";



                             });
                         $('#employee_name_r').html(result.user[0].full_name);
                         $('#date_r').html(result.user[0].date);
                         $('#task-report-details').html(html);

                         $('#task-report-Modal').modal({

                        show: true

                    })

                   

                }

                }

            });
        })
    })
</script>
<script>
    $(document).on('click','.select-month-task',function(e) {

        e.preventDefault();

        

        id = $(this).attr('data-id');

        year = $('select[name=select_year]').val();

        emp_id = $('#emp_id').val();

        var self = $(this);

        $.ajax({

            type: "post",

            url: "{{URL::to('getTaskByMonth')}}",

            data: {_token:'{{csrf_token()}}',month:id,year:year,emp_id:emp_id},

            success: function (res) {

              if(res.status){

                $(this).addClass("dd");

                alertMessage('success',res.message);

                

                $('#monthly-data').html(res.html);

                $("li a.active-month").removeClass("active-month"); 

                self.addClass('active-month');

              } else {

                alertMessage('error',res.message);

              }

            }         

        });



    });  
</script>
