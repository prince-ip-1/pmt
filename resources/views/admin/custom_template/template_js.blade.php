<script>
    function checkTemplateValidation()
    {
        if($('#template_title').val() == '') 
        {
            $('.error_message').text('Please Enter Title');
        }
        else{
              $('.error_message').text('');
              return true;
        }
        
        if($('#template_summernote').val() == '') 
        {
            $('.error_message1').text('Please Enter Description');
        }
        else{
              $('.error_message1').text('');
              return true;
        }
         return false;
    }

    $('textarea#template_summernote').summernote({
    placeholder: 'Enter Text',
        tabsize: 10,
        fontsize:13,
        height: 300,
        followingToolbar: false,
                    toolbar:[
                     ['style', ['style']],
                     ['font', ['bold', 'italic', 'underline', 'clear']],
                     ['color', ['color']],
                     ['para', ['ul', 'ol', 'paragraph']],
                     ['height', ['height']],
                     ['table', ['table']],
                     //['insert', ['link', 'picture', 'hr']],
                     ['view', ['fullscreen', 'codeview']],
                     ['help', ['help']]
                ]
                
                })
</script>