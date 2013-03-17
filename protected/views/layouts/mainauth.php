<?php $this->beginContent('//layouts/main'); ?>
<?php $path = Yii::app()->getRequest()->getPathInfo(); ?>
<div class="row-fluid">
    <div class="span9 well">
        <?php echo $content; ?>
    </div>
    <div class="span3">
        <ul class="nav nav-list well">
            <li<?php echo $path=='site/index'?' class="active"':''; ?>><a href="<?php echo $this->createUrl('site/index');?>"><?php echo Yii::t('main', 'Главная');?></a></li>
            <li<?php echo $path=='category/index'?' class="active"':''; ?>><a href="<?php echo $this->createUrl('category/index');?>"><?php echo Yii::t('main', 'Категории');?></a></li>
            <li<?php echo $path=='brand/index'?' class="active"':''; ?>><a href="<?php echo $this->createUrl('brand/index');?>"><?php echo Yii::t('main', 'Бренды');?></a></li>
            <li<?php echo $path=='product/index'?' class="active"':''; ?>><a href="<?php echo $this->createUrl('product/index');?>"><?php echo Yii::t('main', 'Товары');?></a></li>
            <li<?php echo $path=='order/index'?' class="active"':''; ?>><a href="<?php echo $this->createUrl('order/index');?>"><?php echo Yii::t('main', 'Заказы');?></a></li>
        </ul>
    </div>
</div>
<?php $this->endContent(); ?>