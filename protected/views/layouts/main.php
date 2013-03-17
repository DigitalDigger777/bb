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
                    <a class="brand" href="<?php echo $this->createUrl('/');?>">BeautyBay</a>
                    <?php if(Yii::app()->user->id):?>
                    <ul class="nav pull-right">
                        <!--<li><?php echo Yii::app()->user->username;?></li>-->
                        <li><a href="<?php echo $this->createUrl('site/logout');?>">Выход</a></li>
                    </ul>
                    <?php endif?>
                </div>
            </div>
        </div>
        
        <?php echo $content; ?>
        
    </div>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-22000922-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>	
</body>
</html>