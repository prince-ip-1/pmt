<script>
     $('textarea.summernote').summernote({
        placeholder: 'Enter Text',
        tabsize: 2,
        height: 100,
  toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline',]],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        // ['table', ['table']],
        // ['view', ['fullscreen', 'codeview']],
        // ['help', ['help']]
      ],
      });
// Edit Project Description 
$('.project_desc').on('click',function(){
     $('#project_description').addClass('d-none');
    $('.project_description_form').removeClass('d-none');
    $('.project_desc_close').removeClass('d-none');
    $('.comment_desc').addClass('d-none');
    $('.project_description').removeClass('d-none');
    $('.project_desc').addClass('d-none');
})
$('.project_desc_close').on('click',function(){
    $('.project_desc_close').addClass('d-none');
    $('.project_description_form').addClass('d-none');
    $('.project_desc').removeClass('d-none');
    $('.project_description').addClass('d-none');
    $('.comment_desc').removeClass('d-none');
})
// Add File
$('.project_add_file').on('click',function(){
    $('.project_add_file').addClass('d-none');
    $('.project_file_close').removeClass('d-none');
    $('.project_no_file').addClass('d-none');
    $('.project_file').removeClass('d-none');
    $('.attachment_form').removeClass('d-none');
})
$('.project_file_close').on('click',function(){
    $('.project_file_close').addClass('d-none');
    $('.project_add_file').removeClass('d-none');
    $('.project_file').addClass('d-none');
    $('.project_no_file').removeClass('d-none');
    $('.attachment_form').addClass('d-none');
  
    
})
     $(document).on("click", "#submit_description", function(e){
            e.preventDefault();
            var formData = new FormData($('.project_description_form')[0]);
            console.log(formData);
            formData.append('_token',"{{csrf_token()}}");
            formData.append('project_id',$('#project_id').val());
            $.ajax({
                type: "POST",
                url: "{{URL::to('admin/edit_project_description')}}",
                cache : false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res){
                  if(res.status){
                    alertMessage('success',res.message);
                  var markup = $('.summernote').summernote('code');
                 
                  $('.comment_desc').removeClass('d-none');
                  $('.comment_desc').html(markup);
                  $('.project_description_form').addClass('d-none');
                  $('.project_desc_close').addClass('d-none');
                  $('.project_desc').removeClass('d-none');

                  }else{
                    alertMessage('error',res.message);
                  }
                }         
            });
        });

     $(document).on("click", "#submit_attachment", function(e){
            e.preventDefault();
           //  var id = $(this).attr('data-id'); 
            var formData = new FormData($('.attachment_form')[0]);
            console.log(formData);
            formData.append('_token',"{{csrf_token()}}");
            formData.append('project_id',$('#project_id').val());
            $.ajax({
                type: "POST",
                url: "{{URL::to('admin/add_attachment')}}",
                cache : false,
                processData: false,
                contentType: false,
                data: formData,
                success: function (res){
                  if(res.status){
                    alertMessage('success',res.message);
                      $('.project_no_file').removeClass('d-none');
                      $('.attachment_form').addClass('d-none');
                      $('.project_file_close').addClass('d-none');
                      $('.project_add_file').removeClass('d-none');
                      $('.project_no_file').addClass('d-none');
                      
                      $('.project_file_attach').append(res.html);
                      $('input[name=attachment').val('');
                    //   $('.attachment_'+id).addClass('d-none');
                      
                  }else{
                    alertMessage('error',res.message);
                  }
                }         
            });
        });
</script>