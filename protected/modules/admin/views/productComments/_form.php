
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
            <?php $nameproduct = Products::model() -> findAll();
 			 $list = CHtml::listData($nameproduct, 'id', 'name');
 		 	echo $form::dropDownList($model,'product_id', $list, array('empty'=> ""));
 		 ?>
            <?php echo $form->error($model,'product_id'); ?>
        </div>
	</div>

    <?php echo $form->hiddenField($model,'type',array('rows'=>6, 'cols'=>50, 'value'=>1)); ?>
    
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

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->