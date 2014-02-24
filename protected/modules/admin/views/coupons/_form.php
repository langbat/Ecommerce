
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coupons-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'title'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'type'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'type'); ?>
            <?php echo $form->error($model,'type'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'status'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'status'); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'value'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'value'); ?>
            <?php echo $form->error($model,'value'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'total'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'total'); ?>
            <?php echo $form->error($model,'total'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'used'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'used'); ?>
            <?php echo $form->error($model,'used'); ?>
        </div>
	</div>

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
            <?php echo $form->labelEx($model,'from_date'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'from_date'); ?>
            <?php echo $form->error($model,'from_date'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'to_date'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'to_date'); ?>
            <?php echo $form->error($model,'to_date'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->