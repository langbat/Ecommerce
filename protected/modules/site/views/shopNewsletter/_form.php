<div class="block-fluid" id="form-shopnewletter">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-newsletter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix" id="row-newletter">
		<div class="span6">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>125, 'placeholder'=>'Name', 'style'=>'width:300px')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix" id="row-newletter">
		<div class="span4">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>125, 'placeholder'=>Yii::t('gloabl', 'Email'), 'style'=>'width:300px')); ?>
        </div>
        <div class="span2">
            <?php echo $form->error($model,'email', array('id'=>'noname')); ?>
        </div>
	</div>
     <?php echo $form->hiddenField($model,'joined', array('value'=>time())); ?>
    <?php echo $form->hiddenField($model,'shop_id', array('value'=>$this->membershop->id)); ?>
    <div class="row-form clearfix" id="row-newletter">
		<div class="span2">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Send') : Yii::t('global','Send'), array('class'=>'btn')); ?>
        </div>
	</div>
	<div class="footer tar">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->