<div class="span3">
    <ul class="nav nav-list well">
        <li<?php echo !isset($_REQUEST['cat_id'])?' class="active"':''; ?>><a href="index.php?r=product/productlist"><?php echo Yii::t('main', 'Все категории');?></a></li>
        <?php foreach($categories as $key=>$category):?>
        <li<?php echo (isset($_REQUEST['cat_id'])&&$_REQUEST['cat_id'] == $category->id)?' class="active"':''; ?>><a href="index.php?r=product/productlist&cat_id=<?php echo $category->id; ?>"><?php echo Yii::t('main', $category->name);?></a></li>
        <?php endforeach;?>
    </ul>
</div>
<?php 
    $count = count($products);
    $count_row = ceil($count/4);
    $item = 0;
?>
<div class="span9 well">
<?php for($i = 0; $i<$count_row; $i++):?>    
    <ul class="thumbnails">
      <?php for($m = 0; $m < 4; $m++):?>
                <?php
                    //цена в магазине
                    $ship_price = ((($products[$item]['price']+$products[$item]['delivery_price'])/100)*$products[$item]['margin']+$products[$item]['price'])*$currency->rate;
                    //цена со скидкой
                    $ship_discount = ($ship_price - (($ship_price/100)*$products[$item]['discount']));
                ?>        
                <li class="span3">
                  <div class="thumbnail">
                    <img product_id="<?php echo $products[$item]['id']; ?>" src="images/products/<?php echo $products[$item]['photo'];?>" alt="<?php echo $products[$item]['name']; ?>" >
                    <h5><?php echo $products[$item]['name']; ?></h5>
                    <p><span class="muted"><?php echo Yii::t('main','Категория: ');?></span><?php echo $products[$item]['category']; ?></p>
                    <p><span class="muted"><?php echo Yii::t('main','Бренд: ');?></span><?php echo $products[$item]['brand']; ?></p>
                    <p><span class="muted"><?php echo Yii::t('main','Статус: '); ?></span><?php echo $status[$products[$item]['status_id']]; ?></p>
                    <p><span class="muted"><?php echo Yii::t('main','Цена: '); ?></span><?php echo round($ship_price, 2); ?> <?php echo $currency->short_name;?></p>
                    <?php if($products[$item]['discount']):?>
                    <p><span class="muted"><?php echo Yii::t('main','Скидка: '); ?></span><?php echo $products[$item]['discount']; ?> %</p>
                    <p><span class="muted"><?php echo Yii::t('main','Цена со скидкой: '); ?></span><?php echo round($ship_discount,2); ?> <?php echo $currency->short_name;?></p>
                    <?php endif;?>
                    <p>
                        <a href="#" class="btn btn-primary add_to_cart" product_id="<?php echo $products[$item]['id'];?>"><?php echo Yii::t('main', 'Заказать');?></a>
                    </p>
                  </div>
                </li>
                <?php 
                    if($item == $count-1) break;
                    $item++;
                ?>
      <?php endfor; ?>
    </ul>
<?php endfor;?>
</div>

<div id="product" class="modal hide fade"></div>