<div class="span12">

	<h1><?php echo Yii::t('usermessages', 'Send Message to ');?><a href="<?php echo Yii::app()->createUrl('/'.$to_user->id . '-'.$to_user->seoname, array('lang'=>false)); ?>" title="<?php echo $to_user->getDisplayName(); ?>"><?php echo $to_user->getDisplayName(); ?></a></h1>
	
	<?php echo CHtml::form('', 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
	
		<div class="row-fluid">
			<div class="span3 bold"><?php echo Yii::t('subject', 'Subject'); ?> *</div>
			<div class="span4"><input type="text" class="validate[required,minSize[3],maxSize[100]]" name="subject" value=""/></div>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold"><?php echo Yii::t('message', 'Message'); ?> *</div>
			<div class="span4" style="margin-bottom:20px;"><textarea class="validate[required]" name="message" style="width:100%; height:50px;" value=""/></textarea></div>
		</div>
			
		<div class="row-fluid">
			<div class="span3 bold"></div>
			<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn-submit', 'name'=>'submit')); ?></div>	
		</div>
	<?php echo CHtml::endForm(); ?>
	
</div>