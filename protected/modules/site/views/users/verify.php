
<div class="table">
	<div class="custompagecontent">
		<h1 class="title"><?php echo Yii::t('global', 'Verify email address'); ?></h1>
		
		<p><?php echo Yii::t('global', 'Please fill all required fields and hit the submit button once your done.'); ?></p>
		
		<?php echo CHtml::form($this->createUrl('users/verify'), 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
			
			<?php if($verierror): ?>
				<p class="error">
					<?php echo $verierror; ?>
				</p>
			<?php endif; ?>
			
			<div class="row-fluid">
				<div class="span3 bold"><label for="veri_email">Email:</label> *</div>
				<div class="span4"><input type="text" name="email" id="veri_email" class="tooltipsy validate[required,custom[email]]" title="<?php echo Yii::t('global', 'Enter your email address'); ?>"/></div>
			</div>
				
			<div class="row-fluid">
				<div class="span3 bold"><label for="veri_code">Code:</label> *</div>
				<div class="span4"><input type="text" name="code" id="veri_code" class="tooltipsy validate[required]" title="<?php echo Yii::t('global', 'Enter your verification code'); ?>"/></div>
			</div>
				
			<div class="row-fluid">
				<div class="span3 bold"></div>
				<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Verify'), array('class'=>'btn-submit', 'name'=>'submit')); ?></div>
			</div>                            
		
		<?php echo CHtml::endForm(); ?>
	
	</div>
</div>