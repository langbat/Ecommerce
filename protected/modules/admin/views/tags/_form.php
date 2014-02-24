
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'slug'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'slug'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'weight'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'weight'); ?>
            <?php echo $form->error($model,'weight'); ?>
        </div>
	</div>
   <?php /*
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'created'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'created'); ?>
            <?php echo $form->error($model,'created'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'updated'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'updated'); ?>
            <?php echo $form->error($model,'updated'); ?>
        </div>
	</div> */ ?>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->