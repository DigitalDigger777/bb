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
                    <div class="span12">
                        <p><?php echo Yii::t('main', 'Статус: ').$status[$products[$item]['status_id']]; ?></p>
                        <p><?php echo Yii::t('main', 'Цена: ').$products[$item]['price']; ?></p>
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