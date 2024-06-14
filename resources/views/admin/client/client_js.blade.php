<script>
    
$(document).ready(function() {
    $('.portal').on('change', function(e) {
        e.preventDefault();
        let portal = $('.portal').val();
        
        if(portal == '3'){
            $('.applied_from').removeClass('d-none');
        }else{
            $('.applied_from').addClass('d-none');
        }
    });
    $(document).on('change','.project_bid',function(){
     bid =  $('#bid_by').val();
     
      if(bid == '-1'){
        $('#modal-1').addClass('md-show');

      }
    });
     $(document).on('click','.save_project_bid',function(e) {

        e.preventDefault();
        var category_name = $("#category_name").val(); 

        if(category_name == ""){

             $('#category_name_message').html('Enter Category Name').show();

        }else{

            $('#category_name_message').hide();
            $('.messages').hide();

            params =$('#bid_form').serialize();

            params += '&'+addCSRFRequest();

            $.ajax({

                type: "post",

                url: "{{URL::to('add_project_bid')}}",

                data: params,

                success: function (data) {

                    if(data.status == 'true'){
                         alertMessage('success',data.message);
                        table_name = $('#table_name').val();
                        
                        setTimeout(function(){
                            $('#bid_form')[0].reset();
                            $('#modal-1').removeClass('md-show');
                            $('.project_bid').html(data.html);
                        }, 2000);
                      
                        

                    }

                    else{

                       

                    }

                }

            });

        }

    });
    $(document).on('click','.close_project_bid_model',function(){
      $('#modal-1').removeClass('md-show');
    })
    $('.client').on('click', function(e) {
        e.preventDefault();
        comment_id = $('#comment_id').val();

        id = $('#client_id').val();

        var comments = $('#comments').val();

        var type = $('#conversion_type').val();



        if (comments == "") {

            $('#comment_msg').html('Enter Comment').show();

        } else

        if (comments == "") {

            $('#comment_msg').html('Enter Comment').show();

        } else {

            $('#comment_msg').hide();



            $.ajax({

                type: "POST",

                dataType: "json",

                url: "{{URL::to('admin/client_conversion')}}",

                data: {

                    _token: '{{ csrf_token() }}',

                    comment_id: comment_id,

                    id: id,

                    comments: comments,

                    type: type

                },

                success: function(res) {

                    if (res.status) {

                        var html = '';

                        html += "<tr>";

                        if (type == 1) {

                            $('.comments').val(comments);

                        } else {

                            $('.comments').val(comments);

                        }





                        alertMessage('success', res.message);

                        if (comment_id == "") {

                            $('#tb').prepend(res.html);

                        } else {

                            $('#comments_' + comment_id).children().eq(0).html(comments);

                        }

                        $('#comments').val('');

                        console.log();

                        $('.client-form').hide();

                        //   $('.salary-close-btn').trigger('click');

                    }



                }

            });

        }

    });

    $('.get_client').on('click', function(e) {



        id = $(this).attr('data-id');

        type = $(this).attr('data-type');

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{URL::to('admin/getclientcomments')}}",

            data: {

                _token: '{{ csrf_token() }}',

                id: id,

                type: type

            },

            success: function(res) {

                if (res.status) {

                    var html = '';

                    if (type == 1) {

                        $('.text-title').html('Conversions List');

                        $('.modal-title').html('Last Conversions ');



                    } else {

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

        var btnTxt = $(this).attr('data-add');

        $('#submit').text(btnTxt);

    })

    $('#close_client').on('click',function(){

        $('.client-form').hide('');

        $('#comments').val('');

        

    })



    var rowIdx = 0;

    $('#add-row').on('click',function(){

        var i = ++rowIdx;

        $('#test-body').append(`<tr id="row${i}">

       <td><textarea class="form-control " name="last_conversion[]"  placeholder="Enter Last Conversion" style="width:385px;"></textarea></td>

       <td class="deleteconv"><span class="delete-row" data-id="${i}" value="Delete" style="margin-top:7px;"/><i class="fa fa-close"></i></span></td></tr>`);

    });



    var rowIdx1 = 0;

    $('#add-row1').on('click',function(){

       $('#test1-body').append(`<tr id="row${++rowIdx1}"><td><textarea class="form-control " name="comments_from_clients[]"  placeholder="Enter Comments" style="width:385px;" ></textarea></td>
       <td class="deletecomm"><span id="delete"  class='delete-row  deleterow delete1' data-id="${++rowIdx1}"  value='Delete' style="margin-top:7px;"/><i class="fa fa-close"></i></span></td></tr>`);
        
    });



    $(document).on('click','.delete-row',function(){

        id = $(this).attr('data-id');

        $(this).closest("tr").remove();

    });
    
     $('#test-body').on('click', '.deleteconv', function() 

  { 

      $(this).closest('tr').remove();

  });

    $('#test1-body').on('click', '.deletecomm', function() 

  { 

      $(this).closest('tr').remove();

  });
  function delete_row(id)

  {

    $('#row'+id).remove();

    alert(id);

  }
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

    /*$('#contact-save').on('click', function() {

        var c = $('#edit-Contact').find("i");

        c.removeClass('icofont-close');

        c.addClass('icofont-edit');

        $('#contact-info').show();

        $('#edit-contact-info').hide();

        $('#contact-save').hide();

    });*/



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



    $('#description-save').hide();

  


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
    
    $("#addconversion").prop('value', 'Submit'); 

    $(".edit_cilent_comment_data").prop('value', 'Update'); 
    
    
  $(document).on('click', '.edit_cilent_comment_data', function() {

      var id = $(this).attr('data-id');

      var client_id = $(this).attr('data-client_id');

      var comment = $('#comments_' + id).children().eq(0).text();



      var btnTxt = $(this).attr('data-add');

      $('#submit').text(btnTxt);

      $('#comment_id').val(id);

      $('#comments').val(comment);

      $('#client_id').val(client_id);

      $('.client-form').show();

  });
  
  $(document).on('click','.filterClient',function(){
 
    type = $(this).attr('data-type');
    
    var id = '';
    var search = '';
    if(type == 1)
    {
        id  = $('#clientId').find('option:selected').val();
        search = $('#search-txt').val();
    }
    else{
        var id = '';
        $('#clientId').prop('selectedIndex',0);
        search = '';
    }
    
    $.ajax({

          type : 'POST',

          url : "{{URL::to('admin/searchClient')}}",

          data : {clientId : id,search : search,"_token": "{{ csrf_token() }}"},

          success:function(data1)
          {
              const script = document.createElement('script');

              script.type = 'text/javascript';

              script.src = 'https://www.pmt.bluepixeltech.com/public/dist/assets/icon/flag-icons/css/flag-icon.css';

              script.onload = () => {

              };

              const scr = document.createElement('script');

              scr.type = 'text/javascript';

              scr.src = 'https://www.pmt.bluepixeltech.com/public/dist/assets/pages/flag-icons.js';

              scr.onload = () => {

                $('.div1').html(data1);

              };

              document.body.appendChild(scr);

          },

      });

    });


        $('.get_description').on('click', function(e) {



        id = $(this).attr('data-id');

        type = $(this).attr('data-type');

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{URL::to('admin/getdescription')}}",

            data: {

                _token: '{{ csrf_token() }}',

                id: id,

                type: type

            },

            success: function(res) {

                if (res.status) {

                    var html = '';

                    if (type == 3) {

                        $('.text-title').html('Description');

                        $('.modal-title').html('Scope Description ');



                    } else {

                        $('.text-title').html('Description');

                        $('.modal-title').html('Overview Description');

                    }



                    $('#description_type').val(type);



                    $('.desc_data').html(res.html);



                    $('#description-Modal').modal({

                        show: true

                    })



                }

            }

        });

    })
    
     $('.get_notes').on('click', function(e) {



        id = $(this).attr('data-id');

        type = $(this).attr('data-type');

        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{URL::to('admin/getadditionalnotes')}}",

            data: {

                _token: '{{ csrf_token() }}',

                id: id,

                type: type

            },

            success: function(res) {

                if (res.status) {

                    var html = '';

                    if (type == 5) {

                        $('.text-title').html('Notes Description');

                        $('.modal-title').html('Additional Notes ');



                    } 


                    $('#additional_notes_type').val(type);



                    $('.additional_notes_data').html(res.html);



                    $('#additional-notes-Modal').modal({

                        show: true

                    })



                }

            }

        });

    })
    
    
    
    $(document).on('keyup','#email',function(){
        $email = $('#email').val();
        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{URL::to('admin/checkEmail')}}",
            data: {
                _token: '{{ csrf_token() }}',
                email:$email,
            },

            success: function(res) {
                console.log(res.status);
                if(res.status == true){
                   
                    $('.email_verify').text('Email address already in use!');
                }else{
                    
                    $('.email_verify').text('');
                }
            }
        })
    })
    
    })
</script>
<script>
     function ValidateFileUpload() {
        var fuData = document.getElementById('fileChooser');
        var FileUploadPath = fuData.value;
        var size = "";
    
        //To check if user upload any file
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

        //The file uploaded is an image
        var file = fuData.files;
        //var fileSize = file[0].size;
        var fileSize = Math.round((file[0].size / 1024));
       
        console.log(fileSize);
        var total_kb = 5*1024;
        console.log(total_kb);
       
        if ((Extension == "gif" || Extension == "png"  || Extension == "jpeg" || Extension == "jpg") && fileSize <= total_kb ) 
        {
            var error_message = " ";
            $('.error_message').html(error_message);
        } 
        else{
             var error_message = "Only allows  GIF, PNG, JPG, JPEG and file size should be 5MB.";
                $('.error_message').html(error_message);
                $('#fileChooser').val('');
        }
    }
</script>