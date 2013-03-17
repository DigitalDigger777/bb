<?php 
    $count = count($products);
    $count_row = ceil($count/4);
    $item = 0;
?>

<?php for($i = 0; $i<$count_row; $i++):?>
<ul class="thumbnails">
    <?php for($m = 0; $m < 4; $m++):?>
        <li class="span3">
            <div class="thumbnail">
                <img src="images/products/<?php echo $products[$item]['photo'];?>" alt="" />
                <h5><?php echo $products[$item]['name']; ?></h5>
                <div class="row-fluid">
                    <?php
                        //цена в магазине
                        $ship_price = (($products[$item]['price']+$products[$item]['delivery_price'])/100)*$products[$item]['margin']+$products[$item]['price'];
                        //цена со скидкой
                        $ship_discount = $ship_price - ($ship_price/100)*$products[$item]['discount'];
                    ?>
                    <div class="span12">
                        <p><span class="muted"><?php echo Yii::t('main', 'Статус: '); ?></span><?php echo $status[$products[$item]['status_id']]; ?></p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Цена: '); ?></span><?php echo $products[$item]['price']; ?><?php echo $default_currency->short_name; ?></p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Доставка: '); ?></span><?php echo $products[$item]['delivery_price']; ?><?php echo $default_currency->short_name; ?></p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Наценка: '); ?></span><?php echo $products[$item]['margin']; ?>%</p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Цена в магазине: '); ?></span><?php echo round($ship_price,2); ?><?php echo $default_currency->short_name; ?></p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Скидка: '); ?></span><?php echo $products[$item]['discount']; ?>%</p>
                        <p><span class="muted"><?php echo Yii::t('main', 'Цена со скидкой: '); ?></span><?php echo round($ship_discount,2); ?><?php echo $default_currency->short_name; ?></p>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="btn-group pull-right">
                            <a class="btn <?php echo $products[$item]['public']==0?'btn-danger':'btn-primary';?> dropdown-toggle" data-toggle="dropdown" href="#">
                              Действие
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                              <li>
                                  <a href="<?php echo $this->createUrl('product/edit', array('id'=>$products[$item]['id']));?>">Редактировать</a>
                                  <a href="<?php echo $this->createUrl('product/public', array('id'=>$products[$item]['id']));?>"><?php echo $products[$item]['public']?Yii::t('main', 'Снять с публикации'):Yii::t('main', 'Публиковать'); ?></a>
                                  <a href="<?php echo $this->createUrl('product/delete', array('id'=>$products[$item]['id']));?>">Удалить</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php 
            if($item == $count-1) break;
            $item++;
        ?>
    <?php endfor; ?>
</ul>
<?php if($item == $count-1) break; ?>
<?php endfor; ?>