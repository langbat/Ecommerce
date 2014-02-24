
<div class="block-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schedule-shows-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'start_time'); ?>
        </div>
		<div class="span9">
            <?php $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'start_time',
                'mode'=>'datetime',
                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                'language' => Yii::app()->language=='en'?'':Yii::app()->language
            )); ?>
            <?php echo $form->error($model,'start_time'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'end_time'); ?>
        </div>
		<div class="span9">
            <?php $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'end_time',
                'mode'=>'datetime',
                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => true),
                'language' => Yii::app()->language=='en'?'':Yii::app()->language
            )); ?>
            <?php echo $form->error($model,'end_time'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'product_id'); ?>
        </div>
		<div class="span9">
            <?php $product_name = Products::model()->findAll();
            foreach ($product_name as $key=>$name){
                $product_name1[$name['id']] = $name['id'].' - '.Yii::t('global', $name['name']);
            }  ?>
            <?php
                if(isset($product_id) && $product_id !=0){
                    $model->product_id = $product_id;
                    echo $form->dropDownList($model,'product_id',$product_name1);
                } else {
                    echo $form->dropDownList($model,'product_id',$product_name1,array('prompt'=>Yii::t('global','Select product')));
                }
             ?>
            <?php echo $form->error($model,'product_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">

            <?php echo $form->labelEx($model,'content'); ?>
        </div>
		<div class="span9">
            <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>
	</div>

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->