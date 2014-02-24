<link rel="stylesheet" href="<?php echo Yii::app()->themeManager->baseUrl; ?>/css/bootstrap.css" />
<div class="post-item post-thumb-hor" style="border: black 1px solid; padding:40px;">

	<h1><?php echo Yii::t('login', 'Lost Password'); ?></h1>
	<p><?php echo Yii::t('login', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
	<p><?php echo Yii::t('login', 'You will receive an email with a password reset link that you will need to click in order to complete the password reset process.'); ?></p>
	
	<?php echo CHtml::form($this->createUrl('login/lostpassword'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>

		<?php if($model->hasErrors()): ?>
			<p class="error">
				<?php echo Yii::t('login', 'Please fix the following input errors.'); //CHtml::errorSummary($model); ?>
			</p>
		<?php endif; ?>
		
		<div class="row-fluid">
			<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Email (*)'); ?> </div>
			<div class="span4"><?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'text tooltipsy validate[required,custom[email]]', 'title' => Yii::t('login', 'Enter your email address') )); ?></div>
			<?php echo CHtml::error($model, 'email', array( 'class' => 'span6 error' )); ?>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'Sercurity Code (*)'); ?> </div>
			<div class="span4" style="margin-bottom:20px;">
				<?php echo CHtml::activeTextField($model, 'verifyCode', array( 'class' => 'text tooltipsy validate[required]', 'title' => Yii::t('login', 'Enter the text displayed in the image below') )); ?>
				<br/><?php $this->widget('CCaptcha', array('buttonLabel'=>'Get a new code', 'buttonOptions'=>array('class'=>'btnRefresh', 'style'=>'margin-left:5px;', 'title'=>'Get a new code'))); ?>
			</div>
			<?php echo CHtml::error($model, 'verifyCode', array( 'class' => 'span6 error' )); ?>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold"></div>
			<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('name'=>'submit', 'style'=>'width:120px; height:30px')); ?></div>
		</div>
		
	<?php echo CHtml::endForm(); ?>

</div>