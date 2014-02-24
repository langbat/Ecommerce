<!-- Start Notifications -->
<?php if( Yii::app()->user->hasFlash('error') ): ?>
	<div class="notification errorshow png_bg">
		<a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
		<div><?php echo Yii::app()->user->getFlash('error'); ?></div>
	</div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash('attention') ): ?>
	<div class="notification attention png_bg">
		<a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
		<div><?php echo Yii::app()->user->getFlash('attention'); ?></div>
	</div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash('information') ): ?>
	<div class="notification information png_bg">
		<a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
		<div><?php echo Yii::app()->user->getFlash('information'); ?></div>
	</div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash('success') ): ?>
	<div class="notification success png_bg">
		<a href="#" class="close"><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/cross_grey_small.png" title="<?php echo Yii::t('global', 'Close this notification'); ?>" alt="close" /></a>
		<div><?php echo Yii::app()->user->getFlash('success'); ?></div>
	</div>
<?php endif; ?>			
<!-- End Notifications -->