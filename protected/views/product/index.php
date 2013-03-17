<div class="row-fluid">
    <div class="span3">
        <ul class="nav nav-pills">
            <li><a href="<?php echo $this->createUrl('product/product');?>">Новый товар</a></li>
        </ul>        
    </div>
    <div class="span9">
        <form action="<?php echo $this->createUrl('product/index');?>" method="POST" id="filter">
            <select name="brand_id" id="brand_id">
                <option value="0">--Не выбрано--</option>
                <?php foreach($brands as $brand):?>
                <option value="<?php echo $brand->id; ?>" <?php echo isset($_REQUEST['brand_id'])&&$brand->id == $_REQUEST['brand_id']?'selected':''; ?>><?php echo $brand->name; ?></option>
                <?php endforeach;?>
            </select>
            <select name="category_id" id="category_id">
                <option value="0">--Не выбрано--</option>
                <?php foreach($categories as $category):?>
                <option value="<?php echo $category->id; ?>" <?php echo isset($_REQUEST['category_id'])&&$category->id == $_REQUEST['category_id']?'selected':''; ?>><?php echo $category->parent_id != 0?' - '.$category->name:$category->name; ?></option>
                <?php endforeach;?>
            </select>
        </form>
    </div>
</div>
<?php 
    $count = count($products);
    $count_row = ceil($count/4);
    $item = 0;
?>
<?php for($i = 0; $i<$count_row; $i++):?>
<ul class="thumbnails">
    <?php for($m = 0; $m < 4; $m++):?>
        <?php if($i == 0&&$m == 0):?>
                <li class="span3">
                    <a class="thumbnail" href="<?php echo $this->createUrl('product/product');?>">
                        <img src="http://placehold.it/200x200" alt="" />
                    </a>
                </li>
                <?php $m++; ?>
        <?php endif; ?>
        <li class="span3">
            <div class="thumbnail">
                <img product_id="<?php echo $products[$item]['id']; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/products/<?php echo $products[$item]['photo'];?>" alt="" />
                <h5><?php echo $products[$item]['name']; ?></h5>
                <div class="row-fluid">
                    <?php
                        //цена в магазине
                        $ship_price = (($products[$item]['price']+$products[$item]['delivery_price'])/100)*$products[$item]['margin']+$products[$item]['price']+$products[$item]['delivery_price'];
                        //цена со скидкой
                        $ship_discount = $ship_price - ($ship_price/100)*$products[$item]['discount'];
                    ?>
                    <!--<?php echo $products[$item]['price'].':'.$products[$item]['delivery_price'].':'.$products[$item]['margin'].':'.$products[$item]['price']?>-->
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
                            <a class="btn <?php echo ($products[$item]['public_cat']== 0||$products[$item]['public'] == 0)?'btn-danger':'btn-primary';?> dropdown-toggle" data-toggle="dropdown" href="#">
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
<script type="text/javascript">
    $('#category_id').chosen();
    $('#brand_id').chosen();
    
    (function($){
        $('document').ready(function(){
            $('#category_id, #brand_id').change(function(){
                $('#filter').submit();
            });
            
            $('img[product_id]').click(function(){
                var url = base_url+'product/edit/'+$(this).attr('product_id');
                window.location = url;
            });
        });
    })(jQuery)
</script>