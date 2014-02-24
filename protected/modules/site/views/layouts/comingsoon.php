<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>tosello.tv - Das Warten hat bald endlich ein Ende</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/comingsoon.css" media="all" />

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->themeManager->baseUrl; ?>/js/custom.js"></script>
</head>
<body>
<div id="page">

	<h1 class="engraved color_text">
        <img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/img/logo.png" />
    </h1>
    <p class="engrave_text"><?php echo Yii::t('global', 'We are working hard to finish our amazing new website. We\'re almost done:')?></p>
    
    
    <div id="defaultCountdown" class="engraved color_text"></div>
    
    
    <div id="content" class="grey rounded shadow">
        
        <div id="right-panel">
        
			<!-- Subscribe Form -->        
        	<h2 class="engraved color_text"><?php echo Yii::t('global', 'GET OUR NEWSLETTER')?></h2>
             <form method="post" action="" id="signupform">
             <input class="email rounded shadow" name="email" id="email" type="text" value="<?php echo Yii::t('global', 'Enter your email address')?>" onfocus="if(this.value=='<?php echo Yii::t('global', 'Enter your email address')?>'){this.value=''};" />
				<input class="submit color_button rounded" type="submit" value="<?php echo Yii::t('global', 'Sign Up')?>" name="submit" id="submit" />
                <p><input type="hidden" name="submitted" id="submitted" value="true" /></p>
            </form>
            <!-- end Subscribe Form -->
            
        </div>
        <!-- end Social Icons -->
        
    </div>
<?php echo $content?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45711100-1', 'tosello.tv');
  ga('send', 'pageview');

</script>
</div>
</body>
</html>
