
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100,'readonly'=>'true')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'emails'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'emails',array('size'=>60,'maxlength'=>100,'readonly'=>'true')); ?>
            <?php echo $form->error($model,'emails'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'questions'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'questions',array('rows'=>6, 'cols'=>50,'readonly'=>'true')); ?>
            <?php echo $form->error($model,'questions'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'answers'); ?>
        </div>
		<div class="span9">
            <?php echo $form->htmlArea($model,'answers',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'answers'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'datequestion'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'datequestion',array('readonly'=>'true')); ?>
            <?php echo $form->error($model,'datequestion'); ?>
        </div>
	</div>

	

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->