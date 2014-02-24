
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'product_id'); ?>
        </div>
		<div class="span9">
            <?php echo ProductsShop::model()->findByPk($model->product_id)->name?>
         
        </div>
	</div>
<!--
	<div class="row-form clearfix">
		<div class="span3">
            <?php //echo $form->labelEx($model,'type'); ?>
        </div>
		<div class="span9">
            <?php //echo $form->textField($model,'type'); ?>
            <?php //echo $form->error($model,'type'); ?>
        </div>
	</div>
-->
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'created'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'created',array('readonly'=>'readonly')); ?>
            <?php echo $form->error($model,'created'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->