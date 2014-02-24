<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="google-site-verification" content="" />
	
	<title><?php echo ( count( $this->pageTitle ) ) ? implode( ' - ', array_reverse( $this->pageTitle ) ) : $this->pageTitle; ?></title>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl . 'themes/admin/default/css/stylesheets.css'; ?>"/>
	
	<script type='text/javascript' src="<?php echo Yii::app()->homeUrl . 'themes/default/js/jquery-1.7.1.js'; ?>"></script>
	<script type='text/javascript' src="<?php echo Yii::app()->homeUrl . 'themes/default/js/bootstrap-transition.js'; ?>"></script>

</head>
<body>

<?php if($model->hasErrors()): ?>
	<p class="error">
		<?php echo Yii::t('login', 'Sorry, But we can\'t find a member with those login information.'); //CHtml::errorSummary($model); ?>
	</p>
<?php endif; ?>

<div class="loginBlock" id="login" style="display: block;">
	<h1><?php echo Yii::t('login', 'Login'); ?></h1>
	
	<div class="dr"><span></span></div>
	
	<div class="loginForm">
	
		<?php echo CHtml::form($this->createUrl('users/admin'), 'post', array('class'=>'form-horizontal')); ?>
			<div class="control-group">
				<div class="input-prepend">
					<span class="add-on"><span class="icon-envelope"></span></span>
					<input type="text" id="inputEmail" placeholder="<?php echo Yii::t('login', 'Email or Username'); ?>" name="LoginForm[email]" value=""/>
				</div>                
			</div>
			<div class="control-group">
				<div class="input-prepend">
					<span class="add-on"><span class="icon-lock"></span></span>
					<input type="password" id="inputPassword" placeholder="<?php echo Yii::t('login', 'Password'); ?>" name="LoginForm[password]" value=""/>
				</div>
			</div>
			<div class="row-fluid" style="margin-bottom:10px;">
				<div class="span4"></div>
				<div class="span4">
					<?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn btn-block', 'name'=>'submit')); ?>
				</div>
				<div class="span4"></div>
			</div>
		<?php echo CHtml::endForm(); ?>
		
		<div class="dr"><span></span></div>
		
		<div class="controls">
			<div class="row-fluid">
				<div class="span12">
					<?php echo CHtml::link( Yii::t('login', 'Forgot password?'), array('lostpassword'), array('class'=>'btn btn-link btn-block') ); ?>
				</div>
			</div>
		</div>
		
	</div>
</div>

</body>
</html>
