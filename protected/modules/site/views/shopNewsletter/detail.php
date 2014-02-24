<div class="block-fluid" id="form-shopnewletter">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-newsletter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix" id="row-newletter">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span6">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>125)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix" id="row-newletter">
		<div class="span3">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
		<div class="span6">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>125)); ?>
            <?php echo $form->error($model,'email', array('id'=>'noname')); ?>
        </div>
	</div>
     <?php echo $form->hiddenField($model,'joined', array('value'=>time())); ?>
    <?php echo $form->hiddenField($model,'shop_id', array('value'=>$membershop->id)); ?>
    <div class="row-form clearfix" id="row-newletter">
		<div class="span3">
        </div>
		<div class="span6">
            <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Save') : Yii::t('global','Save'), array('class'=>'btn')); ?>
        </div>
	</div>
	<div class="footer tar">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->