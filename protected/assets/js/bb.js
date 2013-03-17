var base_url = '/bb/backend/';

(function($){
    $('document').ready(function(){
        
        //загрузка изображения
        $('.photo').click(function(){
            $('#_photo').click();
        });
        
        $('#_photo').change(function(){
           $('#upload_photo').submit();
        });
        
        $('#result_upload').load(function(){
            var result = $('#result_upload').contents().find('body').text();
            var m = $.parseJSON(result);
            if(m.error)
                alert(m.error);
            else
            {
                $('.photo').attr('src', base_url+'images/products/'+m.img);
                $('[name="photo"]').val(m.img);
            }
        });

    });
})(jQuery)