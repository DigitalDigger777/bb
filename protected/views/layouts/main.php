<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo $this->assetsBase; ?>/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $this->assetsBase; ?>/chosen/chosen.css" />
    <script type="text/javascript" src="<?php echo $this->assetsBase; ?>/js/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsBase; ?>/js/bb.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsBase; ?>/tiny_mce/tiny_mce_dev.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsBase; ?>/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $this->assetsBase; ?>/chosen/chosen.jquery.js"></script>    
    <title></title>
</head>
<body style="padding-top: 50px;">
    <div class="container-fluid well">
        <div class="row-fluid">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <a class="brand" href="index.php">BeautyBay</a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span9 well">
                <?php echo $content; ?>
            </div>
            <div class="span3">
                <ul class="nav nav-list well">
                    <li<?php echo !isset($_REQUEST['r'])?' class="active"':''; ?>><a href="index.php"><?php echo Yii::t('main', 'Главная');?></a></li>
                    <li<?php echo isset($_REQUEST['r'])&&$_REQUEST['r']=='category'?' class="active"':''; ?>><a href="index.php?r=category"><?php echo Yii::t('main', 'Категории');?></a></li>
                    <li<?php echo isset($_REQUEST['r'])&&$_REQUEST['r']=='brand'?' class="active"':''; ?>><a href="index.php?r=brand"><?php echo Yii::t('main', 'Бренды');?></a></li>
                    <li<?php echo isset($_REQUEST['r'])&&$_REQUEST['r']=='product'?' class="active"':''; ?>><a href="index.php?r=product"><?php echo Yii::t('main', 'Товары');?></a></li>
                    <li<?php echo isset($_REQUEST['r'])&&$_REQUEST['r']=='order'?' class="active"':''; ?>><a href="index.php?r=order"><?php echo Yii::t('main', 'Заказы');?></a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>