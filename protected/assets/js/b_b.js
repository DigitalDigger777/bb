(function($){
    $('document').ready(function(){
        //сохранение категории
        $('#category_save').click(function(){
            $.ajax({
                url:'index.php',
                dataType:'json',
                data:{
                    r:'category/save',
                    id:$('#id').val(),
                    parent_id:$('#parent_id').val(),
                    name:$('#name').val(),
                    meta_keywords:$('#meta_keywords').val(),
                    meta_desc:$('#meta_desc').val()
                },
                success:function(obj){
                    /*
                    $('<tr>'+
                        '<td>'+obj.id+'</td>'+
                        '<td>'+obj.name+'</td>'+
                        '<td>'+obj['public']+'</td>'+
                        '<td>'+obj.order+'</td>'+
                        '<td><a href="index.php?r=product&amp;category_id='+obj.id+'"><span class="label label-success">Продукты</span></a></td>'+
                      '</tr>').appendTo('#categories');*/
                    window.location = 'index.php?r=category';
                },
                error:function(obj){
                    console.log(obj);
                }
            });
        });
        //сохранение бренда
        $('#brand_save').click(function(){
            $.ajax({
                url:'index.php',
                data:{
                    r:'brand/save',
                    name:$('#name').val()
                },
                success:function(obj){
                    console.log(obj);
                },
                error:function(obj){
                    console.log(obj);
                }
            });            
        });
        //редактирование категории
        $('[task="edit"]').click(function(){
            var cat_id = $(this).attr('cat_id');
            
            $('form #id').val(cat_id);
            
            $.ajax({
                url:'index.php',
                dataType:'json',
                async:false,
                data:{
                    r:'category/load',
                    id:$('form #id').val()
                },
                success:function(obj){
                    $('#id').val(obj.id);
                    $('#name').val(obj.name);
                    $('#parent_id option:selected').removeAttr('selected');
                    $('form #parent_id option[value="'+obj.parent_id+'"]').attr('selected', 'selected');
                    $('form #parent_id').val(obj.parent_id);
                    $('form #meta_keywords').val(obj.meta_keywords);
                    $('form #meta_desc').val(obj.meta_desc);
                }
            });            
        });
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
                $('.photo').attr('src', 'images/products/'+m.img);
                $('[name="photo"]').val(m.img);
            }
        });
        //добавление в корзину
        $('.add_to_cart').click(function(){
            var product_id = $(this).attr('product_id')
            alert('Товар добавлен в корзину');

            $.ajax({
                url:'index.php',
                data:{
                    r:'cart/addtocart',
                    product_id:product_id
                },
                success:function(data){
                    $('#cart_count').text(data);
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        //изменение количества едениц товара в корзине
        $('input[name="count"]').change(function(){
            var product_id = $(this).attr('product_id');
            var count = $(this).val();

            $.ajax({
                url:'index.php',
                data:{
                    r:'cart/ChangeCount',
                    product_id:product_id,
                    count:count
                },
                success:function(data){
                    $('#cart_count').text(data);
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        //удаление из корзины
        $('.delete').click(function(){
            var product_id = $(this).attr('product_id');
            var obj = $(this).parent().parent();
            $.ajax({
                url:'index.php',
                data:{
                    r:'cart/delete',
                    product_id:product_id
                },
                success:function(data){
                    obj.remove();
                    $('#cart_count').text(data);
                },
                error:function(data){
                    console.log(data);
                }
            });            
        });
        //открывает товар
        $('img[product_id]').click(function(){
            $.ajax({
                url:'index.php',
                data:{
                    r:'product/frontproduct',
                    id:$(this).attr('product_id')
                },
                success:function(data){
                    $('div#product').html(data);
                    $('#product').modal('show');
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
    });
})(jQuery)