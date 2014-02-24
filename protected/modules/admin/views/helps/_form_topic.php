
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lookup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<!--<div class="row-form clearfix">
		<div class="span3">
            <?php /*echo $form->labelEx($model,'code'); */?>
        </div>
		<div class="span9">
            <?php /*echo $form->textField($model,'code'); */?>
            <?php /*echo $form->error($model,'code'); */?>
        </div>
	</div>-->

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'position'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'position'); ?>
            <?php echo $form->error($model,'position'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->