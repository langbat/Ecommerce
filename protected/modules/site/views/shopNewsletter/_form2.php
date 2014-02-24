<div class="block-fluid">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-newsletter-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
    
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'name'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>125)); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>125)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
	</div>
    <?php echo $form->hiddenField($model,'joined', array('value'=>time())); ?>
    <?php echo $form->hiddenField($model,'shop_id', array('value'=>$this->userId)); ?>
	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
