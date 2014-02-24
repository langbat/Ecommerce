<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sender'); ?>
		<?php echo $form->textField($model,'sender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiver'); ?>
		<?php echo $form->textField($model,'receiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sent'); ?>
		<?php echo $form->textField($model,'sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_message'); ?>
		<?php echo $form->textField($model,'status_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_read'); ?>
		<?php echo $form->textField($model,'is_read'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->