
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'user_id'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'user_id', array($model->user_id=>$model->user->username)); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'created'); ?>
        </div>
		<div class="span9">
            <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'created',
            'mode'=>'datetime',
            'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
            'language' => Yii::app()->language=='en'?'':Yii::app()->language
        )); ?>
            <?php echo $form->error($model,'created'); ?>
        </div>
	</div>

    <div class="row-form clearfix">
        <div class="span3">
            <?php echo $form->labelEx($model,'remaining_date'); ?>
        </div>
        <div class="span9">
            <?php $this->widget('CJuiDateTimePicker',array(
            'model'=>$model,
            'attribute'=>'remaining_date',
            'mode'=>'datetime',
            'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
            'language' => Yii::app()->language=='en'?'':Yii::app()->language
        )); ?>
            <?php echo $form->error($model,'remaining_date'); ?>
        </div>
    </div>
	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'amount'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'amount'); ?>
            <?php echo $form->error($model,'amount'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'billing_fullname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'billing_fullname',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'billing_fullname'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'billing_address'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'billing_address',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'billing_address'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_fullname'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_fullname',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'shipping_fullname'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipping_address'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipping_address',array('size'=>60,'maxlength'=>512)); ?>
            <?php echo $form->error($model,'shipping_address'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'shipped'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textField($model,'shipped'); ?>
            <?php echo $form->error($model,'shipped'); ?>
        </div>
	</div>

<?php /*<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'data'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'data'); ?>
        </div>
	</div> */?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'status'); ?>
        </div>
		<div class="span9">
            <?php $status = CHtml::listData(OrderStatus::model()->findAll(), 'id', 'name' );
            foreach ($status as $key=>$value){
                $status[$key] = Yii::t('global', $value);
            } ?>
            <?php //echo $form->textField($model,'status'); ?>
            <?php echo $form->dropDownList($model, 'status', $status); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->