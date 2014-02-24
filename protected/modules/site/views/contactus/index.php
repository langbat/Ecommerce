
<div class="table">
	<div class="custompagecontent">
		<h1 class="title"><?php echo Yii::t('global', 'Contact Us'); ?></h1>
		
		<p><?php echo Yii::t('global', 'Please fill all required fields and hit the submit button once your done.'); ?></p>

		<?php echo CHtml::form('', 'post', array('class'=>'frmcontact', 'id'=>'validation2')); ?>
		
			<?php if($model->hasErrors()): ?>
			<div class="error">
				<?php echo Yii::t('global', 'Please fix the following input errors'); //CHtml::errorSummary($model); ?>
			</div>
			<?php endif; ?>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'name'); ?> *</div>
				<div class="span4"><?php echo CHtml::activeTextField($model, 'name', array( 'class' => 'tooltipsy validate[required]', 'title' => Yii::t('global', 'Please enter your name') )); ?></div>
				<?php echo CHtml::error($model, 'name', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'email'); ?> *</div>
				<div class="span4"><?php echo CHtml::activeTextField($model, 'email', array( 'class' => 'tooltipsy validate[required,custom[email]', 'title' => Yii::t('global', 'Please enter your email address') )); ?></div>
				<?php echo CHtml::error($model, 'email', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'subject'); ?> *</div>
				<div class="span4" style="margin-bottom:10px;"><?php echo CHtml::activeDropDownList($model, 'subject', ContactUs::model()->getTopics(), array( 'class' => 'tooltipsy validate[required]' )); ?></div>
				<?php echo CHtml::error($model, 'subject', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'content'); ?> *</div>
				<div class="span4" style="margin-bottom:20px;"><?php echo CHtml::activeTextArea($model, 'content', array( 'class' => 'tooltipsy validate[required]', 'style'=>'width:98%; height:100px;', 'title' => Yii::t('global', 'Please enter your message') )); ?></div>
				<?php echo CHtml::error($model, 'content', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"><?php echo CHtml::activeLabel($model, 'verifyCode'); ?> *</div>
				<div class="span4" style="margin-bottom:20px;">
					<?php echo CHtml::activeTextField($model, 'verifyCode', array( 'class' => 'tooltipsy validate[required]', 'title' => Yii::t('global', 'Enter the text displayed in the image below') )); ?>
					<br/><?php $this->widget('CCaptcha', array('buttonLabel'=>'Get a new code', 'buttonOptions'=>array('class'=>'btnRefresh', 'style'=>'margin-left:20px;', 'title'=>'Get a new code'))); ?>
				</div>
				<?php echo CHtml::error($model, 'verifyCode', array( 'class' => 'span5 error' )); ?>
			</div>
			
			<div class="row-fluid">
				<div class="span3 bold"></div>
				<div class="span4"><?php echo CHtml::submitButton(Yii::t('global', 'Submit'), array('class'=>'submit-btn', 'name'=>'submit')); ?></div>
			</div>
			
		<?php echo CHtml::endForm(); ?>
		
	</div>
</div>