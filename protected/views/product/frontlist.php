<div class="row-fluid">
    <div class="span12">
        <div class="row-fluid">
            <div class="navbar navbar-fixed-top" style="margin-top: 40px;">
                <div class="navbar-inner container-fluid" style="padding-top: 8px">
                    <div class="span8 offset2">
                        <div class="row-fluid">
                            <form name="filter" action="<?php echo $this->createUrl('product/productlist'); ?>" method="POST">
                                <div class="span3">
                                    <select name="brand_id" id="brand_sh" data-placeholder="Поиск по бренду" class="span12">
                                        <option value="0"></option>
                                        <?php foreach($brands as $brand):?>
                                        <option value="<?php echo $brand['id'];?>" <?php echo isset($_REQUEST['brand_id'])&&$_REQUEST['brand_id']==$brand['id']?'selected':''; ?>><?php echo $brand['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                    </div>
                                    <div class="span3">
                                    <select name="cat_id" id="category_sh" data-placeholder="Поиск по категории" class="span12">
                                        <option value="0"></option>
                                        <?php foreach($categories as $category):?>
                                        <option value="<?php echo $category->id; ?>" <?php echo isset($_REQUEST['cat_id'])&&$category->id == $_REQUEST['cat_id']?'selected':''; ?>><?php echo $category->parent_id != 0?' - '.$category->name:$category->name; ?></option>
                                        <?php endforeach;?>                
                                    </select>
                                </div>
                                <div class="span3">
                                    <select name="price" id="price_sh" data-placeholder="Поиск по цене" class="span12">
                                        <option value="0"></option>
                                        <option value="1-99" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='1-99'?'selected':''?>>1-99</option>
                                        <option value="100-199" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='100-199'?'selected':''?>>100-199</option>
                                        <option value="200-299" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='200-299'?'selected':''?>>200-299</option>
                                        <option value="300-399" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='300-399'?'selected':''?>>300-399</option>
                                        <option value="400-499" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='400-499'?'selected':''?>>400-499</option>
                                        <option value="500-599" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='500-599'?'selected':''?>>500-599</option>
                                        <option value="600-699" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='600-699'?'selected':''?>>600-699</option>
                                        <option value="700-799" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='700-799'?'selected':''?>>700-799</option>
                                        <option value="800-899" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='800-899'?'selected':''?>>800-899</option>
                                        <option value="900-999" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='900-999'?'selected':''?>>900-999</option>
                                        <option value="1000-10000" <?php echo isset($_REQUEST['price'])&&$_REQUEST['price']=='1000-10000'?'selected':''?>>1000-10000</option>
                                    </select>
                                </div>
                                <div class="span3">
                                    <select name="status_id" id="status_sh" data-placeholder="Поиск по статусу" class="span12">
                                        <option value="0"></option>
                                        <option value="1" <?php echo isset($_REQUEST['status_id'])&&$_REQUEST['status_id']==1?'selected':''; ?>>В наличии</option>
                                        <option value="4" <?php echo isset($_REQUEST['status_id'])&&$_REQUEST['status_id']==4?'selected':''; ?>>Под заказ</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="row-fluid">
            <?php 
                $count = count($products);
                $count_row = ceil($count/6);
                $item = 0;
            ?>
            <div class="span12">
                <div id="container">
                    <?php for($i = 0; $i<$count_row; $i++):?>
                          <?php for($m = 0; $m < 6; $m++):?>
                                    <?php
                                        //цена в магазине
                                        $ship_price = ((($products[$item]['price']+$products[$item]['delivery_price'])/100)*$products[$item]['margin']+$products[$item]['price']+$products[$item]['delivery_price'])*$currency->rate;
                                        //цена со скидкой
                                        $ship_discount = ($ship_price - (($ship_price/100)*$products[$item]['discount']));
                                    ?>
                                    <div class="grid" style="visibility: hidden">
                                      <img product_id="<?php echo $products[$item]['id']; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/products/<?php echo $products[$item]['photo'];?>" alt="<?php echo $products[$item]['name']; ?>" >
                                      <div style="padding: 3px; background: white">
                                          <h5><?php echo $products[$item]['name']; ?></h5>
                                          <p><span class="muted"><?php echo Yii::t('main','Статус: '); ?></span><?php echo $status[$products[$item]['status_id']]; ?></p>
                                          <p><span class="muted"><?php echo Yii::t('main','Цена: '); ?></span><?php echo round($ship_price); ?> <?php echo $currency->short_name;?></p>
                                          <?php if($products[$item]['discount']):?>
                                          <p><span class="muted"><?php echo Yii::t('main','Скидка: '); ?></span><?php echo $products[$item]['discount']; ?> %</p>
                                          <p><span class="muted"><?php echo Yii::t('main','Цена со скидкой: '); ?></span><?php echo round($ship_discount); ?> <?php echo $currency->short_name;?></p>
                                          <?php endif;?>
                                          <p style="text-align: center">
                                              <a href="#" class="btn btn-primary add_to_cart" product_id="<?php echo $products[$item]['id'];?>"><?php echo Yii::t('main', 'Заказать');?></a>
                                          </p>
                                      </div>
                                    </div>
                                    <?php 
                                        if($item == $count-1) break;
                                        $item++;
                                    ?>
                          <?php endfor; ?>
                    <?php endfor;?>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="product" class="modal hide fade"></div>
<?php if(isset($_REQUEST['id'])):?>
<script type="text/javascript">
(function($){
    $('document').ready(function(){
            var url = base_url+'product/frontproduct';
            var product_id = <?php echo $_REQUEST['id'];  ?>;
            $.ajax({
                url:url,
                data:{
                    id:product_id
                },
                success:function(data){
                    $('div#product').html(data);
                    $('#product').modal('show');
                    var prod_url = base_url+'product/productlist/'+product_id;
                    history.pushState({},'',prod_url);
                },
                error:function(data){
                    console.log(data);
                }
            });
    });
})(jQuery)
</script>
<?php endif; ?>
<script type="text/javascript">
(function($){
    $('document').ready(function(){
        $('select').chosen({allow_single_deselect: true});
        $('select').chosen().change(function(){
            $('form[name="filter"]').submit();
        });
	
        //добавление в корзину
        $('.add_to_cart').click(function(){
            var product_id = $(this).attr('product_id')
            alert('Товар добавлен в корзину');
            var url = base_url+'cart/addtocart/'+product_id;
            console.log(url);
            $.ajax({
                url:url,
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
            var url = base_url+'cart/ChangeCount';
            $.ajax({
                url:url,
                data:{
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
        //открывает товар
        $('img[product_id]').click(function(){
            var url = base_url+'product/frontproduct';
            var product_id = $(this).attr('product_id');
            $.ajax({
                url:url,
                data:{
                    id:$(this).attr('product_id')
                },
                success:function(data){
                    $('div#product').html(data);
                    $('#product').modal('show');
                    var prod_url = base_url+'product/productlist/'+product_id;
                    history.pushState({},'',prod_url);
                },
                error:function(data){
                    console.log(data);
                }
            });
        });
        $('#product').on('hidden', function () {
                            history.pushState({},'',base_url+'product/productlist');
                         });
	//blocksit define
	$(window).load( function() {
		
                $('#container').BlocksIt({
			numOfCol: 5,
			offsetX: 8,
			offsetY: 8
		});
                $('.grid').css('visibility','visible');
	});
	
	//window resize
	var currentWidth = 1100;
	$(window).resize(function() {
		var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 660) {
			conWidth = 440;
			col = 2
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 3
		} else if(winWidth < 1100) {
			conWidth = 880;
			col = 4;
		} else {
			conWidth = 1100;
			col = 5;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#container').width(conWidth);
			$('#container').BlocksIt({
				numOfCol: col,
				offsetX: 8,
				offsetY: 8
			});
		}
	});
    });
})(jQuery)
</script>