
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'widgets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span2">
            <?php echo $form->labelEx($model,'title'); ?>
        </div>
		<div class="span4">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
        <div class="span2">
            <?php echo $form->labelEx($model,'language'); ?>
        </div>
		<div class="span4">
            <?php echo Yii::app()->params['languages'][$model->language];?>
        </div>
	</div>
    
    <div class="row-form clearfix">
		
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php echo $form->htmlArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>

	

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->