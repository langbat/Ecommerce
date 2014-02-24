
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'messages-shop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'sender'); ?>
        </div>
       	<div class="span9">
            <?php echo $form->dropDownList($model, 'sender', array($model->sender=>$model->senderme->username)); ?>
            <?php echo $form->error($model,'sender'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'receiver'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'receiver', array($model->sender=>$model->receiverme->username)); ?>
            <?php echo $form->error($model,'receiver'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'subject'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>300)); ?>
            <?php echo $form->error($model,'subject'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'message'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'message'); ?>
        </div>
	</div>
<?php /*
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'sent'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'sent'); ?>
            <?php echo $form->error($model,'sent'); ?>
        </div>
	</div>
    
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'status_message'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'status_message'); ?>
            <?php echo $form->error($model,'status_message'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'is_read'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'is_read'); ?>
            <?php echo $form->error($model,'is_read'); ?>
        </div>
	</div>
    */ ?>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->