<div class="span12">

	<h1><?php echo Yii::t('usermessages', 'Viewing Message: ') . CHtml::encode($usermessage->subject); ?></h1>
	
	<div class="row-fluid">
		From <?php echo CHtml::link($usermessage->fromuser->getDisplayName(), array('/'.$usermessage->fromuser->id.'-'.$usermessage->fromuser->seoname, 'lang'=>false)); ?>
		to <?php echo CHtml::link($usermessage->touser->getDisplayName(), array('/'.$usermessage->touser->id.'-'.$usermessage->touser->seoname, 'lang'=>false)); ?>
		at <?php echo Yii::app()->dateFormatter->formatDateTime($usermessage->created, 'long', 'short'); ?>
	</div>
	<div class="row-fluid">
		<div  style="padding:20px; border:1px dashed #ccc;"><?php echo CHtml::encode($usermessage->message); ?></div>
	</div>

	<h1><?php echo Yii::t('usermessages', 'Reply:'); ?></h1>
	
	<?php echo CHtml::form('', 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
	
		<input type="hidden" name="to_user" value="<?php
			if($usermessage->from_user == $my->id) echo $usermessage->to_user;
			else echo $usermessage->from_user;
		?>"/>
		
		<div class="row-fluid">
			<div class="span3 bold"><?php echo Yii::t('subject', 'Subject'); ?> *</div>
			<div class="span4"><input type="text" class="validate[required,minSize[3],maxSize[100]]" name="subject" value="RE: <?php echo $usermessage->subject; ?>"/></div>
		</div>
		
		<div class="row-fluid">
			<div class="span3 bold"><?php echo Yii::t('message', 'Message'); ?> *</div>
			<div class="span4" style="margin-bottom:20px;"><textarea class="validate[required]" name="message" style="width:100%; height:50px;" value="<?php echo $usermessage->message; ?>"/></textarea></div>
		</div>
			
		<div class="row-fluid">
			<div class="span3 bold"></div>
			<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'btn-submit', 'name'=>'submit')); ?></div>	
		</div>
	<?php echo CHtml::endForm(); ?>
	
</div>