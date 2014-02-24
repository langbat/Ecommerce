
<div class="block-fluid">

<?php
error_reporting(0);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'transactions-form',
    'enableAjaxValidation' => false,
    )); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, 'user_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model, 'user_id'); ?>
            <?php echo $form->error($model, 'user_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, 'amount'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model, 'amount', array('size' => 10,
    'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'amount'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, 'currency'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model, 'currency', array('size' => 3,
    'maxlength' => 3)); ?>
            <?php echo $form->error($model, 'currency'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, 'paymentstatus'); ?>
        </div>
		<div class="span9">
            <?php //echo $form->textField($model,'paymentstatus');
echo $form->dropDownList($model, 'paymentstatus', Lookup::items('PaymentStatus'));
?>
            <?php echo $form->error($model, 'paymentstatus'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model, 'transactiontype'); ?>
        </div>
		<div class="span9">
            <?php //echo $form->textField($model,'transactiontype',array('size'=>10,'maxlength'=>10));
echo $form->dropDownList($model, 'transactiontype', Lookup::items('PaymentType'));
?>
            <?php echo $form->error($model, 'transactiontype'); ?>
        </div>
	</div>
<?php /*
<div class="row-form clearfix">
<div class="span3">
<?php echo $form->labelEx($model,'modified'); ?>
</div>
<div class="span9">
<?php echo $form->textField($model,'modified'); ?>
<?php echo $form->error($model,'modified'); ?>
</div>
</div>

<div class="row-form clearfix">
<div class="span3">
<?php echo $form->labelEx($model,'created'); ?>
</div>
<div class="span3">
<?php 
$this->widget('CJuiDateTimePicker',array(
'model'=>$model,
'attribute'=>'created',
'mode'=>'datetime',
'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true), 
'language' => Yii::app()->language=='en'?'':Yii::app()->language
));
?>
<?php echo $form->error($model,'start_date'); ?>
</div>
</div>
*/ ?>
<?php /*
<div class="row-form clearfix">
<div class="span3">
<?php echo $form->labelEx($model,'payment_transaction'); ?>
</div>
<div class="span9">
<?php echo $form->textArea($model,'payment_transaction',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'payment_transaction'); ?>
</div>
</div>

<div class="row-form clearfix">
<div class="span3">
<?php echo $form->labelEx($model,'options'); ?>
</div>
<div class="span9">
<?php echo $form->textArea($model,'options',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'options'); ?>
</div>
</div>
*/ ?>
	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Create') :Yii::t('global', 'Save'), array('class' => 'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->