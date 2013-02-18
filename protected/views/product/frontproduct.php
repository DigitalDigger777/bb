<div class="modal-header">
    <a href="#" class="btn btn-primary pull-right add_to_cart" product_id="<?php echo $product->id;?>">В корзину</a>
    <h3><?php echo $product->name; ?></h3>
</div>
<div class="modal-body">
    <img class="img-rounded" src="images/products/<?php echo $product->photo; ?>" alt="<?php echo $product->name; ?>" />
    <p><?php echo $product->desc; ?></p>
</div>
<script type="text/javascript">
(function($){
    $('document').ready(function(){
        //добавление в корзину
        $('.modal-header .add_to_cart').click(function(){
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
    });
})(jQuery)
</script>