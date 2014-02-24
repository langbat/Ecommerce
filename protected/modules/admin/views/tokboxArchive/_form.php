
<div class="block-fluid">

<?php
$list_user = Members::model()->findAll(array('select'=>'id,username','condition'=>'role="mod"'));
$user = array();
foreach($list_user as $item){
    $user[$item['id']]=$item['username'];
}
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokbox-archive-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'username'); ?>
        </div>
		<div class="span9">
            <?php echo $form->dropDownList($model, 'user_id',$user); ?>
            <?php //echo $form->textField($model,'user_id'); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>
	</div>

	<div class="row-form clearfix">
		<div class="span3">
            <?php echo $form->labelEx($model,'created'); ?>
        </div>
		<div class="span9">
            <?php
            $model->created = Utils::date_format24h($model->created);
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'created',
                'mode'=>'datetime',
                'options'=>array("dateFormat"=>Yii::app()->locale->getDateFormat('medium_js'), 'ampm' => false),
                'language' => Yii::app()->language=='en'?'':Yii::app()->language
            )); ?>
            <?php echo $form->error($model,'created'); ?>
        </div>
	</div>

	<!--<div class="row-form clearfix">
		<div class="span3">
            <?php /*echo $form->labelEx($model,'archive_id'); */?>
        </div>
		<div class="span9">
            <?php /*echo $form->textField($model,'archive_id',array('size'=>60,'maxlength'=>64)); */?>
            <?php /*echo $form->error($model,'archive_id'); */?>
        </div>
	</div>-->

	<div class="footer tar">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('global','Create') : Yii::t('global','Save'), array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->