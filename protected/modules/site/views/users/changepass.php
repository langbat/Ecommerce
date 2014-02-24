
<div class="table">
	<div class="custompagecontent">
		<h1 class="title"><?php echo Yii::t('global', 'Change your password'); ?></h1>
		
		<?php echo CHtml::form($this->createUrl('users/changepass'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
			
			<?php if($password->hasErrors()): ?>
				<p class="error">
					<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
				</p>
			<?php endif; ?>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($password, 'password'); ?></div>
				<div class="span4"><?php echo CHtml::activePasswordField($password, 'password', array( 'class' => 'tooltipsy validate[required]', 'title' => Yii::t('global', 'Enter your old password') )); ?></div>
				<?php echo CHtml::error($password, 'password', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($password, 'npassword'); ?></div>
				<div class="span4"><?php echo CHtml::activePasswordField($password, 'npassword', array( 'class' => 'tooltipsy ', 'title' => Yii::t('global', 'Enter your new password ') )); ?></div>
				<?php echo CHtml::error($password, 'npassword', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($password, 'npassword2'); ?></div>
				<div class="span4"><?php echo CHtml::activePasswordField($password, 'npassword2', array( 'class' => 'tooltipsy validate[required,equals[PasswordForm_npassword]', 'title' => Yii::t('global', 'Confirm your new password') )); ?></div>
				<?php echo CHtml::error($password, 'npassword2', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"></div>
				<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Change password'), array('class'=>'btn-submit', 'name'=>'submit')); ?></div>
			</div>                            
		
		<?php echo CHtml::endForm(); ?>
	
	</div>
</div>